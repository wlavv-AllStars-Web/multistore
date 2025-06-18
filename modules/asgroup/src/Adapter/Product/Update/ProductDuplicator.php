<?php
// src/Adapter/Product/Update/CustomProductDuplicator.php

namespace PrestaShop\Module\AsGroup\Adapter\Product\Update;

use PrestaShop\PrestaShop\Adapter\Product\Update\ProductDuplicator as CoreProductDuplicator;
use PrestaShop\PrestaShop\Core\Domain\Product\ValueObject\ProductId;
use PrestaShop\PrestaShop\Core\Domain\Shop\ValueObject\ShopConstraint;
use Tools;

class CustomProductDuplicator extends CoreProductDuplicator
{
    public function duplicate(ProductId $productId, ShopConstraint $shopConstraint): ProductId
    {
        // 👇 Your custom logic here
        // if ((int) \Tools::getValue('duplicateimages') === 0) {
        //     // Maybe prevent image duplication or clear them after duplication
        //     // You can also override the internal `duplicateImages` method conditionally
        // }
        echo 'override';
        pre(Tools::getAllValues());

        // Call parent method
        return parent::duplicate($productId, $shopConstraint);
    }
}
