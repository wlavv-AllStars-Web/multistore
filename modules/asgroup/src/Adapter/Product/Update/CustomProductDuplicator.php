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
use PrestaShop\PrestaShop\Adapter\Product\Repository\ProductSupplierRepository as RepositoryProductSupplierRepository;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;
use PrestaShop\PrestaShop\Core\Hook\HookDispatcherInterface;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Contracts\Translation\TranslatorInterface;
use PrestaShop\PrestaShop\Core\Util\String\StringModifierInterface;
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

    public function __construct(
        ProductRepository $productRepository,
        HookDispatcherInterface $hookDispatcher,
        TranslatorInterface $translator,
        StringModifierInterface $stringModifier,
        Connection $connection,
        string $dbPrefix,
        CombinationRepository $combinationRepository,
        RepositoryProductSupplierRepository $productSupplierRepository,
        SpecificPriceRepository $specificPriceRepository,
        StockAvailableRepository $stockAvailableRepository,
        ProductStockUpdater $productStockUpdater,
        CombinationStockUpdater $combinationStockUpdater,
        ProductImageRepository $productImageRepository,
        ProductImagePathFactory $productImageSystemPathFactory
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
