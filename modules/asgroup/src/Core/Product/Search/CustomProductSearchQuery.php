<?php
/**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/OSL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/OSL-3.0 Open Software License (OSL 3.0)
 */

namespace PrestaShop\Module\AsGroup\Core\Product\Search;

use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

/**
 * Define the Product Query to execute according the the encoded facets.
 */
class CustomProductSearchQuery extends ProductSearchQuery
{


    private $brand;
    private $model;
    private $type;
    private $version;
    private $compats;
    private $compat;


    public function setCompat($compat)
    {
        $this->compat = $compat;

        return $this;
    }
    
    public function getCompat()
    {
        return $this->compat;
    }

    public function setBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }
    
    public function getBrand($brand)
    {
        $this->brand = $brand;

        return $this;
    }
    public function setModel($model)
    {
        $this->model = $model;

        return $this;
    }

    public function getModel($model)
    {
        $this->model = $model;

        return $this;
    }
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function getType($type)
    {
        $this->type = $type;

        return $this;
    }
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    public function getVersion($version)
    {
        $this->version = $version;

        return $this;
    }
    public function setCompatsProducts($compats)
    {
        $this->compats = $compats;

        return $this;
    }

    public function getCompatsProducts()
    {
        return $this->compats;
    }


}
