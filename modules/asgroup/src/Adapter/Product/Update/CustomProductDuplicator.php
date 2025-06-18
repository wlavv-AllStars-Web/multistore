<?php
// src/Adapter/Product/Update/CustomProductDuplicator.php

namespace PrestaShop\Module\AsGroup\Adapter\Product\Update;

use Doctrine\DBAL\Connection;
use PrestaShop\PrestaShop\Adapter\Product\Update\ProductDuplicator as CoreProductDuplicator;
use PrestaShop\PrestaShop\Adapter\Product\Repository\ProductRepository;
use PrestaShop\PrestaShop\Adapter\Product\Combination\Repository\CombinationRepository;
use PrestaShop\PrestaShop\Adapter\Product\Supplier\Repository\ProductSupplierRepository;
use PrestaShop\PrestaShop\Adapter\Product\SpecificPrice\Repository\SpecificPriceRepository;
use PrestaShop\PrestaShop\Adapter\Product\Stock\Repository\StockAvailableRepository;
use PrestaShop\PrestaShop\Adapter\Product\Stock\Update\ProductStockUpdater;
use PrestaShop\PrestaShop\Adapter\Product\Combination\Update\CombinationStockUpdater;
use PrestaShop\PrestaShop\Adapter\Product\Image\Repository\ProductImageRepository;
use PrestaShop\PrestaShop\Adapter\Product\Image\ProductImagePathFactory;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;
use PrestaShop\PrestaShop\Core\Hook\HookDispatcherInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Contracts\Translation\TranslatorInterface;
use PrestaShop\PrestaShop\Core\Util\String\StringModifierInterface;
use Tools;


class CustomProductDuplicator extends CoreProductDuplicator
{
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
        ProductImagePathFactory $productImageSystemPathFactory
    ) {
        parent::__construct(
            $productRepository,
            $hookDispatcher,
            $translator,
            $stringModifier,
            $connection,
            $dbPrefix,
            $combinationRepository,
            $productSupplierRepository,
            $specificPriceRepository,
            $stockAvailableRepository,
            $productStockUpdater,
            $combinationStockUpdater,
            $productImageRepository,
            $productImageSystemPathFactory
        );
    }

    /**
     * Override the duplicate method to skip image duplication.
     */
    public function duplicate(ProductId $productId, ShopConstraint $shopConstraint): ProductId
    {
        // Custom logic before duplicating the product (e.g., skip image duplication)
        $oldProductId = $productId->getValue();

        // Dispatch before duplication hook
        $this->hookDispatcher->dispatchWithParameters(
            'actionAdminDuplicateBefore',
            ['id_product' => $oldProductId]
        );

        // Call to parent method which will duplicate the product and relations
        $newProduct = parent::duplicate($productId, $shopConstraint);
        $newProductId = (int) $newProduct->id;

        // After duplication, handle relations but skip images
        $this->duplicateRelationsWithoutImages($oldProductId, $newProductId, $shopConstraint, $newProduct->getProductType());

        // Dispatch after duplication hook
        $this->hookDispatcher->dispatchWithParameters(
            'actionAdminDuplicateAfter',
            ['id_product' => $oldProductId, 'id_product_new' => $newProductId]
        );

        // Return the new product ID
        return new ProductId((int) $newProduct->id);
    }

    /**
     * Skip the image duplication in this custom version.
     */
    protected function duplicateImages(int $oldProductId, int $newProductId, array $combinationMatching, ShopConstraint $shopConstraint): void
    {
        // Skip image duplication by doing nothing here
        // You can also log if necessary or add additional checks
        echo 'Images are not being duplicated.';
    }

    /**
     * Handle relations without duplicating images.
     */
    private function duplicateRelationsWithoutImages(
        int $oldProductId, 
        int $newProductId, 
        ShopConstraint $shopConstraint, 
        string $productType
    ): void {
        // Skipping the image duplication part
        $shopIds = array_map(static function (ShopId $shopId) {
            return $shopId->getValue();
        }, $this->productRepository->getShopIdsByConstraint(new ProductId($oldProductId), $shopConstraint));

        // Now we duplicate the relations without images
        $this->duplicateCategories($oldProductId, $newProductId);
        $combinationMatching = $this->duplicateCombinations($oldProductId, $newProductId, $shopIds);
        $this->duplicateSuppliers($oldProductId, $newProductId, $combinationMatching);
        $this->duplicateGroupReduction($oldProductId, $newProductId);
        $this->duplicateRelatedProducts($oldProductId, $newProductId);
        $this->duplicateFeatures($oldProductId, $newProductId);
        $this->duplicateSpecificPrices($oldProductId, $newProductId, $combinationMatching);
        $this->duplicatePackedProducts($oldProductId, $newProductId);
        $this->duplicateCustomizationFields($oldProductId, $newProductId);
        $this->duplicateTags($oldProductId, $newProductId);
        $this->duplicateVirtualProductFiles($oldProductId, $newProductId);

        // Skip image duplication here, hence no call to duplicateImages
        $this->duplicateCarriers($oldProductId, $newProductId, $shopIds);
        $this->duplicateAttachmentAssociation($oldProductId, $newProductId);
        $this->duplicateStock($oldProductId, $newProductId, $shopIds, $productType, $combinationMatching);
    }
}