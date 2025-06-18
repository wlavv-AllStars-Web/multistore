<?php
// src/Adapter/Product/Update/CustomProductDuplicator.php

namespace PrestaShop\Module\AsGroup\Adapter\Product\Update;

use Doctrine\DBAL\Connection;
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
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;
use PrestaShop\PrestaShop\Core\Hook\HookDispatcherInterface;
use PrestaShop\PrestaShop\Core\Util\String\StringModifierInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
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

    public function duplicate(ProductId $productId, ShopConstraint $shopConstraint): ProductId
    {
        echo 'override';
        pre(Tools::getAllValues());

        return parent::duplicate($productId, $shopConstraint);
    }
}
