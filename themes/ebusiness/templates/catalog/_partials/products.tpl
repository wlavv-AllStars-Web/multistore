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
  {if $page.body_classes['category-Wheels']}
      <div class="bg-sidenavCarSpecs"></div>
      <div id="sidenavCarSpecs" class="sidenav">
        <div style="width:100%;display:flex;justify-content:end;padding: .5rem 0;">
          <button type="button" class="btn-primary" onclick="closeNavCarSpecs()" aria-label="Close" style="border-radius: .25rem;">
            <i class="fa-solid fa-xmark fa-xl"></i>
          </button>
        </div>
        <div id="car-select-filters" style="padding: .5rem;background-color: #fff;">
          <div style="color: black; font-weight: bolder; font-size: 18px;padding: 20px 0;text-wrap: nowrap;">{l s='SELECT YOUR CAR CONFIGURATION' d='Shop.Theme.ProductList'}</div>
          <div style="padding: 10px; ">
            <select id="carBrandWheels" class="form-control" style="text-align: center;height:auto;" onchange="callForModelData()">
                <option value="0"> {l s='BRAND' d='Shop.Theme.ProductList'} </option>
                {foreach $car_brands AS $key => $car_brand}
                  <option value="{$key}"> {$car_brand} </option>
                {/foreach}
            </select>
          </div>
          <div style="padding: 10px;">
            <select id="carModelWheels" class="form-control"  style="text-align: center;height:auto;" onchange="callForYearData()" disabled="disabled"> <option> {l s='MODEL' d='Shop.Theme.ProductList'} </option> </select>
          </div>
          <div style="padding: 10px;">
            <select id="carYearWheels" class="form-control"  style="text-align: center;height:auto;" onchange="callForModificationsData()" disabled="disabled"> <option> {l s='YEAR' d='Shop.Theme.ProductList'} </option> </select>
          </div>
          <div style="padding: 10px;">
            <select id="carModificationsWheels" class="form-control"  style="text-align: center;height:auto;" disabled="disabled"> <option> {l s='MODIFICATIONS' d='Shop.Theme.ProductList'} </option> </select>
          </div>
          {* <div style="padding: 10px;display: none;" id="carSpecs"></div> *}
        </div>
        <div style="padding: .5rem 0;display: none !important;" id="carSpecs"></div>
      </div>


    <style>
      #sidenavCarSpecs{
        background-color: #fff;
        border-right: 4px solid var(--asm-color);
        padding: 1rem 0rem;
        opacity: 0;
        box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;
      }

      .bg-sidenavCarSpecs{
        width: 100dvw;
        height: 100dvh;
        position: fixed;
        top: 0;
        left: 0;
        background: rgba(0,0,0,.4);
        z-index: 9999;
        backdrop-filter: blur(2px);
        display: none;
      }

      #car-select-filters{
        border-radius: .25rem;
      }

      #car-select-filters select{
        border: 1px solid #d0d0d0;
        border-radius: .15rem;
        padding: .25rem 1rem;
        font-size: 1rem;
        color: #111;
      }
      #car-select-filters select:hover:not(:disabled){
        cursor: pointer;
        border: 1px solid #b1b1b1;
      }
      #car-select-filters select:disabled{
        opacity: .4;
      }

      #car-select-filters select option {
        font-size: 1rem;
      }

      #carSpecs tbody tr{
        background-color: #e7e7e7 !important;
      }

      #carSpecs tbody tr:hover{
        background-color: #555 !important;
        cursor: pointer;
        color: #fff !important;
        transition: .35s;
      }

      #carSpecs tbody tr:hover i{
        color: #fff !important;
      }

      #carSpecs tbody tr:last-child{
        border-bottom: 0 !important;
      }
    </style>
  {/if}
  <div class="products row" id="productList" style="margin-right: auto;min-height: 38dvh;">
    {if isset($filter_1) && isset($filter_3)}
      <article id="current_car_settings" class=" js-product-miniature d-flex justify-content-center col-lg-3" data-id-product="{$product.id_product}" data-id-product-attribute="{$product.id_product_attribute}" itemscope itemtype="http://schema.org/Product" style="background: #282828;display:flex;flex-direction: column;padding:2rem 1rem !important;border-radius:0.25rem;margin-bottom: 2rem;">
        <div style="width: 300px;height:120px;display:flex;flex-direction:column;justify-content:center;align-items:center;position:relative;background:transparent;">
          <img class="img-responsive" src="/img/homepage/models/{$filter_1}_{$filter_3}.png" style="margin: 0 auto;max-width: 300px; position: relative; top: -5px;pointer-events: none;">
        </div>
        <div class="current-car-content">
          <div class="addToMyCarsButton" style="position: relative; top: -5px;cursor: pointer; color: dodgerblue;font-weight:600;"
          onclick="addToMyCars({$filter_1},{$filter_2},{$filter_3},{$filter_4},{$customer.is_logged},'{$ukoo_name_1}', '{$ukoo_name_2}', '{$ukoo_name_3}', '{$ukoo_name_4}')">
            {l s='Click to receive informations about new products for this car' d='Shop.Theme.ProductList'}
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

    {if $page.page_name == 'new-products'}
      <article id="banner-news" class="d-flex justify-content-center col-lg-3 col-md-4  col-sm-6 col-xs-12">
        <div class="banner-news-img">
          <img src="https://www.all-stars-motorsport.com/img/app_icons/news_icon_en.webp" />
        </div>
        {* <div class="banner-news-title">
          <h1>Novidades</h1>
        </div> *}
      </article>
    {/if}

    {if $page.body_classes['category-Wheels']}
      <article id="banner-wheels" class="d-flex justify-content-center col-lg-3">
        <div class="banner-wheels-container" style="display: flex;flex-direction:column;justify-content:space-between;">
          {* <div class="banner-wheels-title" style="display:flex;justify-content:center;padding:.5rem 1rem;background: #ddd;">
            <h1 id="wheels-title" style="margin-bottom: 0;font-weight:600;">WHEELS</h1>
          </div> *}
          <div class="flip-card">
            <div class="flip-card-inner">
              {* <div class="flip-card-front" onclick="$('.flip-card-inner').css('transform', 'rotateY(180deg)');"> *}
              <div class="flip-card-front" onclick="openNavCarSpecs()">
                <div style="flex-direction:column;justify-content:space-between;">
                  <div class="wheels-selectors">
                    <img id="wheels-image" class="img-responsive" src="https://www.all-stars-motorsport.com/img/app_icons/wheels_en.webp" style="margin: 0 auto;max-width: 250px; position: relative; top: -5px;pointer-events: none;padding: 20px;">
                  </div>
                  <div class="wheels-btn" style="display:flex;justify-content:center;padding:.5rem 1rem;background: #222;">
                    <span style="color: #fff;font-weight:600;">{l s='NEED HELP WITH YOUR WHEELS DETAILS?' d='Shop.Theme.ProductList'}</span>
                  </div>
                </div>
              </div>
              <div class="flip-card-back">
                  <div id="car-select-filters" style="padding: 20px;background-color: #efefef;border: 1px solid #000;box-shadow: 0px 4px 4px #777;">
                    <div style="color: black; font-weight: bolder; font-size: 22px;padding: 20px 0;">{l s='SELECT YOUR CAR CONFIGURATION' d='Shop.Theme.ProductList'}</div>
                    <div style="padding: 10px; ">
                      <select id="carBrandWheels" class="form-control" style="font-size: 18px; color: #000; width: 80%;text-align: center;" onchange="callForModelData()">
                          <option value="0"> {l s='BRAND' d='Shop.Theme.ProductList'} </option>
                          {foreach $car_brands AS $key => $car_brand}
                            <option value="{$key}"> {$car_brand} </option>
                          {/foreach}
                      </select>
                    </div>
                    <div style="padding: 10px;">
                      <select id="carModelWheels" class="form-control"  style="font-size: 18px; color: #000; width: 80%;text-align: center;" onchange="callForYearData()" disabled="disabled"> <option> {l s='MODEL' d='Shop.Theme.ProductList'} </option> </select>
                    </div>
                    <div style="padding: 10px;">
                      <select id="carYearWheels" class="form-control"  style="font-size: 18px; color: #000; width: 80%;text-align: center;" onchange="callForModificationsData()" disabled="disabled"> <option> {l s='YEAR' d='Shop.Theme.ProductList'} </option> </select>
                    </div>
                    <div style="padding: 10px;">
                      <select id="carModificationsWheels" class="form-control"  style="font-size: 18px; color: #000; width: 80%;text-align: center;" disabled="disabled"> <option> {l s='MODIFICATIONS' d='Shop.Theme.ProductList'} </option> </select>
                    </div>
                    {* <div style="padding: 10px;display: none;" id="carSpecs"></div> *}
                    <div style="height: 25px; width: 100%; background-color: #efefef;"></div>
                  </div>
                  {* <div style="padding: 10px;display: none !important;" id="carSpecs"></div> *}
              </div>
            </div>
          </div>

        </div>
      </article>

      <script>
        function callForModelData(){
            
            let brand = $('#carBrandWheels').val();
            
            document.getElementById('carModelWheels').value='';
            document.getElementById('carYearWheels').value='';
            document.getElementById('carModificationsWheels').value='';

            $('#carSpecs').css('display', 'none !important');
      
            
            let slug = '?wheelsFilter=1&type=model&brand=' + brand + '&id=carModelWheels&function=callForYearData';
            let data = callWheelsAjax(slug, 'carModelWheels');
        }

        
        function callForYearData(){
                    
            let brand = $('#carBrandWheels').val();
            let model = $('#carModelWheels').val();
            
            document.getElementById('carYearWheels').value='';
            document.getElementById('carModificationsWheels').value='';
            
            $('#carSpecs').css('display', 'none !important');

            let slug = '?wheelsFilter=1&type=year&brand=' + brand + '&model=' + model + '&id=carYearWheels&function=callForModificationsData';
            let data = callWheelsAjax(slug, 'carYearWheels');

        }
                
        function callForModificationsData(){
            
            let brand = $('#carBrandWheels').val();
            let model = $('#carModelWheels').val();
            let year  = $('#carYearWheels').val();
            
            document.getElementById('carModificationsWheels').value='';
            
            $('#carSpecs').css('display', 'none !important');

            let slug = '?wheelsFilter=1&type=modifications&brand=' + brand + '&model=' + model + '&year=' + year + '&id=carModificationsWheels&function=callForInfoData';
            let data = callWheelsAjax(slug, 'carModificationsWheels');
        }
                
        function callForInfoData(){
            
            let brand = $('#carBrandWheels').val();
            let model = $('#carModelWheels').val();
            let year  = $('#carYearWheels').val();
            let modification  = $('#carModificationsWheels').val();

            $('#carSpecs').css('display', 'none !important');
            

            let slug = '?wheelsFilter=1&type=info&brand=' + brand + '&model=' + model + '&year=' + year + '&modification=' + modification + '&id=carInfoWheels&function=info';
            let data = callWheelsAjax(slug, 'carSpecs');
        }
        
        function callWheelsAjax(slug, id){
            
            $.ajax({
                url: '/227-wheels' + slug,
                type: "POST",
                success: function (data) {
                  // console.log(data)
                  if(id == 'carSpecs'){
                    openNavCarSpecs()
                    // document.querySelector("#car-select-filters").style.display = 'none'
                  }
                  $('#' + id).replaceWith(data);
                  $('#' + id).focus();
                }
            });
            
            return 'NOTHING!';
        }
        
        function setFilterFromSelector(slug){
            location.href = '?filters=' + slug;
        }
      </script>

    {/if}

    {* <pre>{$page|print_r}</pre> *}

    {if $no_products}
      <div style="
        display: flex;
        flex: 1;
        justify-content: center;
        align-items: center;
        font-size: 2rem;
        color: #222;
        text-transform: capitalize;
        margin-bottom: 30px;
      ">
        <div class="container-not-found-filters" style="text-align: center;">
          <i class="material-icons" style="font-size: 3rem;color: var(--asm-color);">error_outline</i>
          <h1 style="font-weight: 600;font-size: 2rem;">{l s='No Result Found' d='Shop.Theme.ProductList'}</h1>
          <span style="font-size: 1.25rem;color: #555;">{l s='We can\'t find any item matching your search' d='Shop.Theme.ProductList'}</span>
        </div>
      </div>
    {else}
      {foreach from=$listing.products item="product"}
          {* <pre>{$product|print_r}</pre> *}
          {block name='product_miniature'}
              {include file='catalog/_partials/miniatures/product.tpl' product=$product}
          {/block}
      {/foreach}
    {/if}


  {* <pre>{$listing|print_r}</pre> *}

  </div>

{* {assign var=initialPage value=$listing.pagination.pages[1]['url']}
{assign var=totalPages value=$listing.pagination.pages_count} *}

  {if !$no_products}
  {block name='pagination'}
    {include file='themes/ebusiness/templates/_partials/pagination.tpl' pagination=$listing.pagination}
  {/block}
  {/if}

</div>
{* <script type="text/javascript" src="{$urls.base_url}modules/pm_advancedpack/views/js/pack-17.js"></script> *}
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


