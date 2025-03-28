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
use PrestaShop\PrestaShop\Adapter\NewProducts\NewProductsProductSearchProvider;
use PrestaShop\PrestaShop\Core\Product\Search\Pagination;
use PrestaShop\PrestaShop\Core\Product\Search\ProductSearchQuery;
use PrestaShop\PrestaShop\Core\Product\Search\SortOrder;

class NewProductsControllerCore extends ProductListingFrontController
{
    public $auth=false;
    public $authRedirection = 'my-account';

    /** @var string */
    public $php_self = 'new-products';

    public function __construct()
    {
        parent::__construct();

        // Check if the shop ID is 3
        if ($this->context->shop->id == 3) {
            $this->auth = true;
            $this->authRedirection = 'my-account';
        }
    }

    public function getCanonicalURL(): string
    {
        return $this->buildPaginatedUrl($this->context->link->getPageLink('new-products'));
    }

    /**
     * {@inheritdoc}
     */
    public function initContent()
    {
        parent::initContent();

        if($this->context->shop->id == 2) {
            // $this->assignProductList();
            // $ukooObj = new UkooCompat();
            // $ukooData = $ukooObj->hookDisplayCompat(null);
            $manufacturerOBJ = new Manufacturer();
            $manufacturers = $manufacturerOBJ->getManufacturers();

            // pre($manufacturers);

            // $getData = Tools::getAllValues();

            $this->context->smarty->assign([
                // 'category' => $categoryVar,
                'manufacturers'        => $manufacturers,
                // 'p' => $getData['p'],
                // 'ukoodata'             => $ukooData,
            ]);
        }

        $this->doProductSearch('catalog/listing/new-products', ['entity' => 'new-products']);
    }

    /**
     * @return ProductSearchQuery
     */
    protected function getProductSearchQuery()
    {
        $query = new ProductSearchQuery();
        $query
            ->setQueryType('new-products')
            ->setSortOrder(new SortOrder('product', 'date_add', 'desc'));

        return $query;
    }

    /**
     * @return NewProductsProductSearchProvider
     */
    protected function getDefaultProductSearchProvider()
    {
        return new NewProductsProductSearchProvider(
            $this->getTranslator()
        );
    }

    public function getListingLabel()
    {
        return $this->trans(
            'New products',
            [],
            'Shop.Theme.Catalog'
        );
    }

    public function getBreadcrumbLinks()
    {
        $breadcrumb = parent::getBreadcrumbLinks();

        $breadcrumb['links'][] = [
            'title' => $this->trans('New products', [], 'Shop.Theme.Catalog'),
            'url' => $this->context->link->getPageLink('new-products'),
        ];

        return $breadcrumb;
    }
}
