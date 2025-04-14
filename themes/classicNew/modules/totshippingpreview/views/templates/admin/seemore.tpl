<!--/**
 * NOTICE OF LICENSE
 *
 * This file is licenced under the Software License Agreement.
 * With the purchase or the installation of the software in your application
 * you accept the licence agreement.
 *
 * You must not modify, adapt or create derivative works of this source code
 *
 *  @author    202-ecommerce
 *  @copyright 2010-2016 202-ecommerce
 *  @license   LICENSE.txt
 */
-->
    <h3 class="tab_description" style="text-align:center;">{l s='These modules might interest you' mod='totshippingpreview'}</h3>
    <p style=" padding: 0 20px 10px 20px;text-align:center;">{l s='Choose another module developed by 202 for your e-commerce store is to choose a perfect integration of all the essential functionalities to manage your stocks.' mod='totshippingpreview'}</p>
    <div class="row clearfix">
        <div class="col-sm-6 col-xs-12">
            <fieldset class="bg_table">
              <div class="panel-body">
                <div class="totshippingpreviewcsv_img">
                  <img src="{$_path|escape:'htmlall':'UTF-8'}/views/img/seemore/Icon_outofstock.png" alt="Sample Image">
                </div>
                <div class="totshippingpreviewcsv_text2">
                  <h4>{l s='Product out of stock' mod='totshippingpreview'}</h4>
                  <p>
                  {l s='Discover the #1 solution that allows you to learn which out-of-stock products are your clients most interested in.' mod='totshippingpreview'}
                  </p>
                </div>
                <div class="totshippingpreviewcsv_button">                 
                  <center>
                     {if $module1}
                    <a href="{$link_additional_module1|escape:'htmlall':'UTF-8'}" class="btn btn-default button configure" role="button" target="_blank">
                     {l s='Configuring' mod='totshippingpreview'}</a>
                     {else}
                    <a href="{$link_additional_module1|escape:'htmlall':'UTF-8'}" class="btn btn-default button discover" role="button" target="_blank">
                     {l s='Discover on Addons' mod='totshippingpreview'}</a>
                     {/if}
                  </center>
                 </div>
               </div>
            </fieldset>
        </div>
        <div class="col-sm-6 col-xs-12">
            <fieldset class="bg_table">
              <div class="panel-body">
                <div class="totshippingpreviewcsv_img">
                  <img src="{$_path|escape:'htmlall':'UTF-8'}/views/img/seemore/Icon_loyalty.jpg" alt="Sample Image">
                </div>
                <div class="totshippingpreviewcsv_text2">
                  <h4>{l s='Advanced Loyalty Program' mod='totshippingpreview'}</h4>
                  <p>
                  {l s='This is the best module for customer rewards points! Customize the number of points awarded for each product or each client : add, modify or delete points manually.' mod='totshippingpreview'}</a>
                  </p>
                </div>
                <div class="totshippingpreviewcsv_button">                  
                   <center>
                   {if $module2}
                   <a href="{$link_additional_module2|escape:'htmlall':'UTF-8'}" class="btn btn-default button configure" role="button" target="_blank">
                   {l s='Configuring' mod='totshippingpreview'}</a>
                   {else}
                   <a href="{$link_additional_module2|escape:'htmlall':'UTF-8'}" class="btn btn-default button discover" role="button" target="_blank">
                   {l s='Discover on Addons' mod='totshippingpreview'}</a>
                   {/if}
                   </center>
                </div>
              </div>
            </fieldset>
        </div>
    </div>
    <div class="row clearfix">
        <div class="col-sm-6 col-xs-12">
            <fieldset class="bg_table">
              <div class="panel-body">
                <div class="totshippingpreviewcsv_img">
                      <img src="{$_path|escape:'htmlall':'UTF-8'}/views/img/seemore/storedelivery.png" alt="Sample Image">
                </div>
                <div class="totshippingpreviewcsv_text2">
                    <h4>{l s='Store Delivery: In-store Availability, Pickup at Store' mod='totshippingpreview'}</h4>
                    <p>
                     {l s='This module will enable your customers to check the in-store availability of a product and pick up their purchase at a point of sale.' mod='totshippingpreview'}
                    </p>
                </div>
                <div class="totshippingpreviewcsv_button">
                    <center>
                     {if $module3}
                     <a href="{$link_additional_module3|escape:'htmlall':'UTF-8'}" class="btn btn-default button configure" role="button" target="_blank">
                     {l s='Configuring' mod='totshippingpreview'}</a>
                     {else}
                     <a href="{$link_additional_module3|escape:'htmlall':'UTF-8'}" class="btn btn-default button discover" role="button" target="_blank">
                     {l s='Discover on Addons' mod='totshippingpreview'}</a>
                     {/if}
                     </center>
                 </div>
              </div>
            </fieldset>
        </div>
        <div class="col-sm-6 col-xs-12">
            <fieldset class="bg_table">
              <div class="panel-body">
                  <div class="totshippingpreviewcsv_img">
                      <img src="{$_path|escape:'htmlall':'UTF-8'}/views/img/seemore/smart_delivery.png" alt="Sample Image"> 
                  </div>
                  <div class="totshippingpreviewcsv_text2">
                      <h4>{l s='SmartDelivery' mod='totshippingpreview'}</h4>
                      <p>
                       {l s='This module is the best solution to delivery logistics! Manage delivery rounds with SmartDelivery: create vehicles, areas, max number of deliveries and delivery slots for your customers to book available deliveries, then optimize delivery trips.' mod='totshippingpreview'}
                      </p>
                  </div>
                  <div class="totshippingpreviewcsv_button">
                      <center>
                       {if $module4}
                        <a href="{$link_additional_module4|escape:'htmlall':'UTF-8'}" class="btn btn-default button configure" role="button" target="_blank">
                       {l s='Configuring' mod='totshippingpreview'}</a>
                       {else}
                        <a href="{$link_additional_module4|escape:'htmlall':'UTF-8'}" class="btn btn-default button discover" role="button" target="_blank">
                       {l s='Discover on Addons' mod='totshippingpreview'}</a>
                       {/if}
                       </center>
                   </div>
               </div>
            </fieldset>
        </div>
    </div>
<script type="text/javascript">

{literal}

function equalHeight(group) {
    tallest = 0;
    group.each(function() {
        $(this).css("height", "");       
        thisHeight = $(this).height();
        if(thisHeight > tallest) {
            tallest = thisHeight;
        }
    });
    group.height(tallest);
}

$(window).ready(function() {

    $("#seemore").click( function() {
        setTimeout(function(){equalHeight($(".totshippingpreviewcsv_text2"));}, 200);
    });

    $(window).resize(function() {
        setTimeout(function() {
             equalHeight($(".totshippingpreviewcsv_text2"));
        }, 120);
    });

    $('.discover').hover(
      function() {
        $(this).css('background-color', '#78B580');
      },
      function() {
        $(this).css('background-color', '#78D07D');
      }
    );
    $('.configure').hover(
      function() {
        $(this).css('background-color', '#6C868E');
      },
      function() {
        $(this).css('background-color', '#66cc33');
      }
    );
});


{/literal}
</script>