{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
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
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}

<section class="featured-products clearfix mt-3">
  <h2 class="h2 products-section-title text-uppercase">
    {l s='New products' d='Shop.Theme.Catalog'}
  </h2>
  {include file="catalog/_partials/productlist.tpl" products=$products productClass="col-xs-12 col-sm-6 col-lg-4 col-xl-3"}
  <a class="all-product-link float-xs-left float-md-right h4" href="{$allNewProductsLink}">
    {l s='All new products' d='Shop.Theme.Catalog'}<i class="material-icons" translate="no">&#xE315;</i>
  </a>
</section>

