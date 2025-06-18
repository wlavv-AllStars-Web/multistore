<?php
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

        pre('override');
        //@todo: add database transaction. After/if PR #21740 gets merged
        $oldProductId = $productId->getValue();
        $this->hookDispatcher->dispatchWithParameters(
            'actionAdminDuplicateBefore',
            ['id_product' => $oldProductId]
        );
        $newProduct = $this->duplicateProduct($productId, $shopConstraint);
        $newProductId = (int) $newProduct->id;

        // $this->duplicateRelations($oldProductId, $newProductId, $shopConstraint, $newProduct->getProductType());

        if ($newProduct->hasAttributes()) {
            $this->updateDefaultAttribute($newProductId, $oldProductId);
        }

        $this->hookDispatcher->dispatchWithParameters(
            'actionProductAdd',
            ['id_product_old' => $oldProductId, 'id_product' => $newProductId, 'product' => $newProduct]
        );

        $this->hookDispatcher->dispatchWithParameters(
            'actionAdminDuplicateAfter',
            ['id_product' => $oldProductId, 'id_product_new' => $newProductId]
        );
        //@todo: after ##21740 (transactions PR) is resolved.
        //  Based on if its accepted or not, we need to implement roll back if something went wrong.
        //  If transactions are accepted then we use it, else we manually rewind (delete the duplicate product)
        return new ProductId((int) $newProduct->id);
    }

}
