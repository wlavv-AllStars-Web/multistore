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
use PrestaShop\PrestaShop\Core\Hook\HookDispatcherInterface;
use PrestaShop\PrestaShop\Core\Util\String\StringModifierInterface;
use Symfony\Component\Filesystem\Filesystem;
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
                // Custom logic before duplicating the product (e.g., check duplicate images flag)
        if ((int) Tools::getValue('duplicateimages') === 0) {
            // If duplicateimages is set to 0, you can modify or skip image duplication
            // For example, you could set a flag or skip calling the duplicateImages method
            echo 'Images will not be duplicated.';
        }

        // Call the parent method to ensure normal duplication behavior
        $newProductId = parent::duplicate($productId, $shopConstraint);

        // Optionally, after duplication, check the images flag and handle accordingly
        if ((int) Tools::getValue('duplicateimages') === 1) {
            // If duplicateimages is set to 1, duplicate the images
            $this->duplicateImages($productId->getValue(), $newProductId->getValue(), [], $shopConstraint);
        }

        // Return the new product ID
        return $newProductId;
    }

    private function getRowsFromTable(string $table, array $conditions, string $errorMessage): array
    {
        // Construct SQL query with conditions
        $sql = 'SELECT * FROM `' . _DB_PREFIX_ . $table . '` WHERE ' . implode(' AND ', array_map(function ($key, $value) {
            return '`' . $key . '` = ' . (int) $value;
        }, array_keys($conditions), $conditions));

        // Execute the query and fetch results
        $result = Db::getInstance()->executeS($sql);

        if (!$result) {
            throw new CannotDuplicateProductException($errorMessage);
        }

        return $result;
    }

    private function duplicateImages(int $oldProductId, int $newProductId, array $combinationMatching, ShopConstraint $shopConstraint): void
    {

        if ((int) Tools::getValue('duplicateimages') === 1) {
            // Use the new getRowsFromTable method
            $oldImages = $this->getRowsFromTable('image', ['id_product' => $oldProductId], CannotDuplicateProductException::FAILED_DUPLICATE_IMAGES);
            $imagesMapping = [];
            $fs = new Filesystem();

            foreach ($oldImages as $oldImage) {
                $oldImageId = new ImageId((int) $oldImage['id_image']);
                $newImage = $this->productImageRepository->duplicate($oldImageId, new ProductId($newProductId), $shopConstraint);

                if (null === $newImage) {
                    continue;
                }

                $newImageId = new ImageId((int) $newImage->id);
                $imageTypes = $this->productImageRepository->getProductImageTypes();

                foreach ($imageTypes as $imageType) {
                    $fs->copy(
                        $this->productImageSystemPathFactory->getPathByType($oldImageId, $imageType->name),
                        $this->productImageSystemPathFactory->getPathByType($newImageId, $imageType->name)
                    );
                }

                $oldOriginalPath = $this->productImageSystemPathFactory->getPath($oldImageId);
                $newOriginalPath = $this->productImageSystemPathFactory->getPath($newImageId);
                $fs->copy($oldOriginalPath, $newOriginalPath);

                $originalFileTypePath = dirname($oldOriginalPath) . '/fileType';
                if (file_exists($originalFileTypePath)) {
                    $fs->copy($originalFileTypePath, dirname($newOriginalPath) . '/fileType');
                }

                $imagesMapping[$oldImageId->getValue()] = $newImageId->getValue();
            }

            $oldCombinationImages = $this->getRowsFromTable('product_attribute_image', ['id_image' => array_keys($imagesMapping)], CannotDuplicateProductException::FAILED_DUPLICATE_IMAGES);
            $newCombinationImages = [];

            foreach ($oldCombinationImages as $oldCombinationImage) {
                $newCombinationImages[] = [
                    'id_image' => $imagesMapping[(int) $oldCombinationImage['id_image']],
                    'id_product_attribute' => $combinationMatching[(int) $oldCombinationImage['id_product_attribute']],
                ];
            }

            $this->bulkInsert('product_attribute_image', $newCombinationImages, CannotDuplicateProductException::FAILED_DUPLICATE_IMAGES);
        } else {
            echo 'Images are not being duplicated.';
        }
    }
}
