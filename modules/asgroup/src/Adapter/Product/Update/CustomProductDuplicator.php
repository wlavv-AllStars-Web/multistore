<?php
// src/Adapter/Product/Update/CustomProductDuplicator.php

namespace PrestaShop\Module\AsGroup\Adapter\Product\Update;

use Doctrine\DBAL\Connection;
use PrestaShop\PrestaShop\Adapter\Db;
use PrestaShop\PrestaShop\Adapter\Product\Update\ProductDuplicator as CoreProductDuplicator;
use PrestaShop\PrestaShop\Adapter\Product\Repository\ProductRepository;
use PrestaShop\PrestaShop\Adapter\Product\Combination\Repository\CombinationRepository;
use PrestaShop\PrestaShop\Adapter\Product\Repository\ProductSupplierRepository;
use PrestaShop\PrestaShop\Adapter\Product\SpecificPrice\Repository\SpecificPriceRepository;
use PrestaShop\PrestaShop\Adapter\Product\Stock\Repository\StockAvailableRepository;
use PrestaShop\PrestaShop\Adapter\Product\Stock\Update\ProductStockUpdater;
use PrestaShop\PrestaShop\Adapter\Product\Combination\Update\CombinationStockUpdater;
use PrestaShop\PrestaShop\Adapter\Product\Image\Repository\ProductImageRepository;
use PrestaShop\PrestaShop\Adapter\Product\Image\ProductImagePathFactory;
use PrestaShop\PrestaShop\Core\Domain\Product\Exception\CannotDuplicateProductException;
use PrestaShop\PrestaShop\Core\Domain\Product\Image\ValueObject\ImageId;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopId;
use PrestaShop\PrestaShop\Core\Hook\HookDispatcherInterface;
use PrestaShop\PrestaShop\Core\Util\String\StringModifierInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Contracts\Translation\TranslatorInterface;
use Tools;


class CustomProductDuplicator extends CoreProductDuplicator
{
      /**
     * @var ProductRepository
     */
    private $productRepository;

    /**
     * @var HookDispatcherInterface
     */
    private $hookDispatcher;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var StringModifierInterface
     */
    private $stringModifier;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var string
     */
    private $dbPrefix;

    /**
     * @var CombinationRepository
     */
    private $combinationRepository;

    /**
     * @var ProductSupplierRepository
     */
    private $productSupplierRepository;

    /**
     * @var SpecificPriceRepository
     */
    private $specificPriceRepository;

    /**
     * @var StockAvailableRepository
     */
    private $stockAvailableRepository;

    /**
     * @var ProductStockUpdater
     */
    private $productStockUpdater;

    /**
     * @var CombinationStockUpdater
     */
    private $combinationStockUpdater;

    /**
     * @var ProductImageRepository
     */
    private $productImageRepository;

    /**
     * @var ProductImagePathFactory
     */
    private $productImageSystemPathFactory;
    private $coreDuplicator;

    public function __construct(
        ProductRepository $productRepository,
        HookDispatcherInterface $hookDispatcher,
        TranslatorInterface $translator,
        StringModifierInterface $stringModifier,
        Connection $connection,
        string $dbPrefix,
        CombinationRepository $combinationRepository,
        ProductSupplierRepository $productSupplierRepository,
        SpecificPriceRepository $specificPriceRepository,
        StockAvailableRepository $stockAvailableRepository,
        ProductStockUpdater $productStockUpdater,
        CombinationStockUpdater $combinationStockUpdater,
        ProductImageRepository $productImageRepository,
        ProductImagePathFactory $productImageSystemPathFactory,
        CoreProductDuplicator $coreDuplicator
    ) {
        $this->productRepository = $productRepository;
        $this->hookDispatcher = $hookDispatcher;
        $this->translator = $translator;
        $this->stringModifier = $stringModifier;
        $this->connection = $connection;
        $this->dbPrefix = $dbPrefix;
        $this->combinationRepository = $combinationRepository;
        $this->productSupplierRepository = $productSupplierRepository;
        $this->specificPriceRepository = $specificPriceRepository;
        $this->stockAvailableRepository = $stockAvailableRepository;
        $this->productStockUpdater = $productStockUpdater;
        $this->combinationStockUpdater = $combinationStockUpdater;
        $this->productImageRepository = $productImageRepository;
        $this->productImageSystemPathFactory = $productImageSystemPathFactory;
    }

public function duplicate(ProductId $productId, ShopConstraint $shopConstraint): ProductId
{
    $oldProductId = $productId->getValue();

    $this->hookDispatcher->dispatchWithParameters(
        'actionAdminDuplicateBefore',
        ['id_product' => $oldProductId]
    );

    $newProduct = CoreProductDuplicator::duplicateProduct($productId, $shopConstraint);
    $newProductId = (int) $newProduct->id;

    $this->duplicateRelations($oldProductId, $newProductId, $shopConstraint, $newProduct->getProductType());

    if ($newProduct->hasAttributes()) {
        CoreProductDuplicator::updateDefaultAttribute($newProductId, $oldProductId);
    }

    $this->hookDispatcher->dispatchWithParameters(
        'actionProductAdd',
        ['id_product_old' => $oldProductId, 'id_product' => $newProductId, 'product' => $newProduct]
    );

    $this->hookDispatcher->dispatchWithParameters(
        'actionAdminDuplicateAfter',
        ['id_product' => $oldProductId, 'id_product_new' => $newProductId]
    );

    return new ProductId($newProductId);
}

private function duplicateRelations(int $oldProductId, int $newProductId, ShopConstraint $shopConstraint, string $productType): void
{
    $shopIds = array_map(static function (ShopId $shopId) {
        return $shopId->getValue();
    }, $this->productRepository->getShopIdsByConstraint(new ProductId($oldProductId), $shopConstraint));

    CoreProductDuplicator::duplicateCategories($oldProductId, $newProductId);
    $combinationMatching = CoreProductDuplicator::duplicateCombinations($oldProductId, $newProductId, $shopIds);
    CoreProductDuplicator::duplicateSuppliers($oldProductId, $newProductId, $combinationMatching);
    CoreProductDuplicator::duplicateGroupReduction($oldProductId, $newProductId);
    CoreProductDuplicator::duplicateRelatedProducts($oldProductId, $newProductId);
    CoreProductDuplicator::duplicateFeatures($oldProductId, $newProductId);
    CoreProductDuplicator::duplicateSpecificPrices($oldProductId, $newProductId, $combinationMatching);
    CoreProductDuplicator::duplicatePackedProducts($oldProductId, $newProductId);
    CoreProductDuplicator::duplicateCustomizationFields($oldProductId, $newProductId);
    CoreProductDuplicator::duplicateTags($oldProductId, $newProductId);
    CoreProductDuplicator::duplicateVirtualProductFiles($oldProductId, $newProductId);

    // ✅ Conditionally duplicate images
    if ((int) \Tools::getValue('duplicateimages') === 1) {
        CoreProductDuplicator::duplicateImages($oldProductId, $newProductId, $combinationMatching, $shopConstraint);
    }

    CoreProductDuplicator::duplicateCarriers($oldProductId, $newProductId, $shopIds);
    CoreProductDuplicator::duplicateAttachmentAssociation($oldProductId, $newProductId);
    CoreProductDuplicator::duplicateStock($oldProductId, $newProductId, $shopIds, $productType, $combinationMatching);
}
}
