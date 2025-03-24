{**
 * 2007-2016 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
 {* <pre>{$product|print_r}</pre> *}
{if $product.out_of_stock == 0}
  <div class="form_product_outofstock_container">
      <p>{l s='The ETA for this product is currently around 30 days, so it is temporarily unavailable for sale. To be informed as soon as the product is available, please enter your email below:' d='Shop.Theme.Catalog'}</p>
      <div class="form-fields d-flex justify-content-center">
        <input type="hidden" name="id_product" value="{$product.id_product}">
        <input type="hidden" name="id_product_attribute" value="{$product.id_product_attribute}">
        <input type="hidden" name="product_reference" value="{$product.reference}">
        <input type="hidden" name="customerLang" value="{$language.id}">
        <input class="form-control col-lg-6" type="email" name="email_customer" id="email_customer" placeholder="{l s='Enter your email' d="Shop.Theme.Catalog"}" required>
        <button type="submit" class="btn btn-primary col-lg-3" id="submit_request">
          {l s='Submit request' d='Shop.Theme.Catalog'}
        </button>
      </div>
      <div class="container-form-outofstock-response mt-2">
      
      </div>
  </div>

  <script>
  $(document).ready(function () {
    $('#submit_request').on('click', function (e) {
      e.preventDefault();

      var productId = $('input[name="id_product"]').val();
      var productAttributeId = $('input[name="id_product_attribute"]').val();
      var productReference = $('input[name="product_reference"]').val();
      var customerLang = $('input[name="customerLang"]').val();
      var emailCustomer = $('#email_customer').val();

      if (!emailCustomer) {
        alert('Please enter your email.');
        return;
      }

      $.ajax({
        type: 'POST',
        url: prestashop.urls.pages.cart, // Change this if using a different controller
        data: {
          ajax: true,
          action: 'outOfStockNotification', // Define this action in your controller
          id_product: productId,
          id_product_attribute: productAttributeId,
          productReference: productReference,
          customerLang: customerLang,
          email_customer: emailCustomer
        },
        dataType: 'json',
        success: function (response) {
          if (response.success) {
            $('.container-form-outofstock-response').html('<div class="alert alert-success" role="alert"> {l s="Email successfully added" d="Shop.Theme.Catalog"} </div>');
          } else {
            $('.container-form-outofstock-response').html('<div class="alert alert-danger" role="alert"> {l s="An unexpected error occurred. Please try again later." d="Shop.Theme.Catalog"} </div>');
          }
        },
        error: function () {
          $('.container-form-outofstock-response').html('<div class="alert alert-danger" role="alert"> {l s="An unexpected error occurred. Please try again later." d="Shop.Theme.Catalog"} </div>');
        }
      });
    });
  });
</script>

{else}

<div class="product-add-to-cart">
  {if !$configuration.is_catalog}
    <span class="control-label">{l s='Quantity' d='Shop.Theme.Catalog'}</span>
    {block name='product_quantity'}
      <div class="product-quantity clearfix">
        <div class="qty">
          <input
            type="text"
            name="qty"
            id="quantity_wanted"
            inputmode="numeric"
            pattern="[0-9]*"
            {if $product.quantity_wanted}
            value="{$product.quantity_wanted}"
            min="{$product.minimal_quantity}"
            {else}
            value="1"
            min="1"
            {/if}
            class="input-group"
            aria-label="{l s='Quantity' d='Shop.Theme.Actions'}"
            style="font-size: 16px;"
          >
        </div>
        <div class="add">
          <button 
            class="btn btn-primary" 
            data-button-action="add-to-cart" 
            type="submit"
            {if !$product.add_to_cart_url}
              disabled
            {/if}
            style="height: 100%;"
            >
            {*<i class="material-icons shopping-cart">&#xE547;</i>*}
            {* <i class="fa fa-shopping-cart"></i> *}
            <i class="material-icons">shopping_cart</i>
            {l s='Add to cart' d='Shop.Theme.Actions'}
          </button>
          
          {* {block name='product_availability'}
            <span id="product-availability">
              {if $product.show_availability && $product.availability_message}
                {if $product.availability == 'available'}
                  <i class="material-icons product-available">check</i>
                {elseif $product.availability == 'last_remaining_items'}
                  <i class="material-icons product-last-items">&#xE002;</i>
                {else}
                  <i class="material-icons product-unavailable">block</i>
                {/if}
                {$product.availability_message}
              {/if}
            </span>
          {/block} *}
        </div>
        {hook h='displayProductActions'  product=$product}
      </div>
      <div class="clearfix"></div>
    {/block}

    {block name='product_minimal_quantity'}
      <p class="product-minimal-quantity">
        {if $product.minimal_quantity > 1}
          {l
          s='The minimum purchase order quantity for the product is %quantity%.'
          d='Shop.Theme.Checkout'
          sprintf=['%quantity%' => $product.minimal_quantity]
          }
        {/if}
      </p>
    {/block}
  {/if}
</div>
{/if}


<!-- end -->