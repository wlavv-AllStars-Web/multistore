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
 <script src="https://unpkg.com/infinite-scroll@4/dist/infinite-scroll.pkgd.min.js"></script>
{* {debug} *}
<div id="js-product-list">
  <div class="products row" id="productList" style="margin-right: auto;">
    {if isset($filter_1) && isset($filter_3)}
      <article id="current_car_settings" class=" js-product-miniature d-flex justify-content-center col-lg-3" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product" style="background: #282828;display:flex;flex-direction: column;padding:2rem 1rem !important;border-radius:0.25rem;margin-bottom: 2rem;">
        <div style="width: 300px;height:120px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:relative;background:transparent;">
          <img class="img-responsive" src="/img/homepage/models/{$filter_1}_{$filter_3}.png" style="margin: 0 auto;max-width: 300px; position: relative; top: -5px;pointer-events: none;">
        </div>
        <div class="current-car-content">
          <div class="addToMyCarsButton" style="position: relative; top: -5px;cursor: pointer; color: dodgerblue;font-weight:600;"
          onclick="addToMyCars({$filter_1},{$filter_2},{$filter_3},{$filter_4},{$customer.is_logged},'{$ukoo_name_1}', '{$ukoo_name_2}', '{$ukoo_name_3}', '{$ukoo_name_4}')">
            Click to receive informations about new products for this car
          </div>
          <div class="mobile">
            <span><img src="/img/homepage/brands/{$filter_1}.png" style="width: 40px;"/></span>
            <span>|</span>
            <span style="color: var(--asm-color) !important;">{$ukoo_name_2}</span>
            <span>|</span>
            <span>{$ukoo_name_3}</span>
          </div>
          <div class="desktop details-info-car-dektop">
            <div>{$ukoo_name_1} | {$ukoo_name_2} </div>
            <div style="margin-top: 11px;"> {$ukoo_name_3} | {$ukoo_name_4} </div>
          </div>
        </div>
      </article>
    {/if}

    {foreach from=$listing.products item="product"}
        {* <pre>{$product|print_r}</pre> *}
        {block name='product_miniature'}
            {include file='catalog/_partials/miniatures/product.tpl' product=$product}
        {/block}
    {/foreach}


  {* <pre>{$listing|print_r}</pre> *}

  </div>

{* {assign var=initialPage value=$listing.pagination.pages[1]['url']}
{assign var=totalPages value=$listing.pagination.pages_count} *}


  {block name='pagination'}
    {include file='themes/ebusiness/templates/_partials/pagination.tpl' pagination=$listing.pagination}
  {/block}

</div>
<script>

// var initialPageUrl = "{$initialPage}";

// window.addEventListener('unload', function() {
//   var currentUrl = window.location.href;
//   if (currentUrl.includes('?page=')) {
//         // Remove the ?page= parameter from the URL
//         var updatedUrl = currentUrl.replace(/\?page=\d+/i, '');
        
//         // Update the URL without reloading the page
//         window.location.href = updatedUrl
//     }

// });



//     document.addEventListener('DOMContentLoaded', function () {


//     var pageNumber = 2; // Assuming the next page is 2 initially
//     var brand = ''; // Initialize brand variable

//     // Extract brand information from the current URL
//     var currentUrl = window.location.href;
//     var brandMatch = currentUrl.match(/\/en\/brand\/([^\/]+)/);
//     if (brandMatch && brandMatch[1]) {
//         brand = brandMatch[1];
//     }

//     var isLoading = false;
//     var totalPageCount = {$totalPages};

//     var loadingSpinner = document.getElementById('loadingSpinner');
//     var nomoreproductsDiv = document.getElementById('nomoreproducts');
//     nomoreproductsDiv.style.display = 'none'

//     var infiniteScroll = new InfiniteScroll('#productList', {
//         path: function () {
//             return '/en/brand/' + brand + '?page=' + pageNumber;
//         },
//         append: '.product-miniature',
//         status: '.page-load-status',
//         hideNav: '.pagination',
//         loadOnScroll: false,
//     });

//     infiniteScroll.on('request', function (path, settings) {
//       // console.log('Requesting page:', path);
      
//         if (pageNumber > totalPageCount) {
//             // Stop loading more pages if current page exceeds the total number of pages
//             infiniteScroll.destroy();
//             nomoreproductsDiv.style.display = 'flex'
//             nomoreproductsDiv.style.justifyContent = 'center'

//             document.getElementById('loadMoreBtn').remove()
//             return;
//         }
//         isLoading = true;
//         loadingSpinner.style.display = 'block';
// });

// infiniteScroll.on('load', function (response, path, items) {
//     // console.log('Page loaded:', path);
//     isLoading = false;
//     loadingSpinner.style.display = 'none';
//     pageNumber++;
// });

// infiniteScroll.on('append', function (response, path, items) {
//     // console.log('Append content:', items);
//     // Handle the response, update pageNumber, or perform any other logic

//     if (!response || pageNumber >= totalPageCount) {
//             infiniteScroll.options.loadOnScroll = false;
//         }
// });


//     document.getElementById('loadMoreBtn').addEventListener('click', function () {
//         // Manually trigger Infinite Scroll when the button is clicked
//         // console.log('Requesting page:', '/en/brand/' + brand + '/ajaxLoadMoreProducts?page=' + pageNumber);
        
//         infiniteScroll.loadNextPage();
//     });
// });


function addToMyCars(id_brand, id_model, id_type, id_version, logged, brand, model, type, version){
        
        let id_customer=0;
        let email='';
        
        if(logged == 1){
            id_customer = {intval($customer.id)};
            email = "{$customer.email}";
        } else {
            email = prompt("{l s='Please enter your email.'}");

            if (email != null) {
                // Additional logic can be placed here if needed
            } else {
                alert("{l s='You did not enter an email. Please try again!'}");
                return; // Exit the function if no email is entered
            } 
        }

        // alert("{$_SERVER['DOCUMENT_ROOT']}/js/asm/front/carNewsletter/carNewsletter.php")
        
        if(email.length > 0){
            $.ajax({
                url: "{$_SERVER['DOCUMENT_ROOT']}/asm/front/carNewsletter/carNewsletter.php",
                type: 'POST',
                data: {
                    'id_brand': id_brand,
                    'id_model': id_model,
                    'id_type': id_type,
                    'id_version': id_version,
                    'email': email,
                    'id_customer': id_customer,
                    'brand': brand,
                    'model': model,
                    'type': type,
                    'version': version,
                    'iso_code': "{Context::getContext()->language->iso_code}"
                },
                dataType: 'json',
                success: function (data) {
                    $('.addToMyCarsButton').remove();
                }
            });
        }
        
    }
</script>


