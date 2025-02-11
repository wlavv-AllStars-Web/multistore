{*
 * Copyright ETS Software Technology Co., Ltd
 *
 * NOTICE OF LICENSE
 *
 * This file is not open source! Each license that you purchased is only available for 1 website only.
 * If you want to use this file on more websites (or projects), you need to purchase additional licenses.
 * You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future.
 *
 * @author ETS Software Technology Co., Ltd
 * @copyright  ETS Software Technology Co., Ltd
 * @license    Valid for 1 website (or project) for each purchase of license
*}
{* <pre>{$product.attributes|print_r}</pre> *}
{* {if $packProducts}
  {assign var="minFutureStock" value=null}
  {assign var="minStockMsg" value=""}
  {assign var="packQuantity" value=$product.quantity}

  {foreach from=$packProducts item=pack}
    {assign var="futureStock" value=$pack.stock - ($pack.quantity * $packQuantity)}

    {if $minFutureStock === null || $futureStock < $minFutureStock}
        {assign var="minFutureStock" value=$futureStock}
        {assign var="minStockMsg" value=$pack.availableMsg}
        {assign var="id_productLowStock" value=$pack.id_product}
    {/if}
  {/foreach}
{/if} *}
<div class="product-line-grid d-desktop">
  <!--  product left content: image-->
  <div class="product-line-grid-left col-lg-1 col-md-3 col-xs-4">
    <span class="product-image media-middle">
      {if $product.default_image}
          <img src="{$product.default_image.bySize.cart_default.url|escape:'html':'UTF-8'}" alt="{$product.name|escape:'quotes'}" loading="lazy">
      {else}
        <img src="{$urls.no_picture_image.bySize.cart_default.url|escape:'html':'UTF-8'}" loading="lazy" />
      {/if}
    </span>
  </div>

  <!--  product left body: description -->
  <div class="product-line-grid-body col-lg-6 col-md-4 col-xs-8">

    <div class="product-line-info product_info_name col-lg-6">
      <a class="label" href="{$product.url|escape:'html':'UTF-8'}" data-id_customization="{$product.id_customization|intval}">{$product.name|escape:'html':'UTF-8'}</a>
      {if isset($product.attributes) && $product.attributes}
        {foreach from=$product.attributes key="attribute" item="value"}
          <div class="product-line-info attribute">
            <span class="label">{$attribute|escape:'html':'UTF-8'}:</span>
            <span class="value">{$value|escape:'html':'UTF-8'}</span>
          </div>
        {/foreach}
      {/if}
    </div>

    <div class="col-lg-4">
      <div class="cart-container-availability">
        {if $packProducts && $product.pack == 1}
          {assign var="minFutureStock" value=null}
          {assign var="minStockMsg" value=""}
          {assign var="packQuantity" value=$product.quantity}

          {foreach from=$packProducts item=pack}
            {* {$pack.stock} *}
            {assign var="futureStock" value=$pack.stock - ($pack.quantity * $packQuantity)}

            {if $minFutureStock === null || $futureStock < $minFutureStock}
                {assign var="minFutureStock" value=$futureStock}
                {assign var="minStockMsg" value=$pack.availableMsg}
                {assign var="id_productLowStock" value=$pack.id_product}
            {/if}
          {/foreach}
          <script>
          document.addEventListener("DOMContentLoaded", (event) => {
            setTimeout(() => {
            const productLowStock = {$id_productLowStock}
            const productLowStockQuantity = {$minFutureStock}

            // console.log(productLowStock)
            // console.log(productLowStockQuantity)
            // console.log("Value:", productLowStock, "Type:", typeof productLowStock);

            const liParent = document.querySelector('.ap5_pack_product_list_cart_summary li[id_product="'+productLowStock+'"]')

            console.log(liParent)

            const newI = document.createElement("i")
            newI.innerText = "warning"
            newI.classList.add("material-icons")
            newI.style.color = "gold"
            newI.style.cursor = "default"
            newI.title = "{l s="This product is currently out of stock or requires a specific order. Please check ETA mentioned as working days to know approximative shipping date for this item." d="Shop.Theme.Checkout"}"

            liParent.appendChild(newI)
          }, "1000");
         });
          </script>

        <div class="availability-message {if $minFutureStock <= 0}low-stock{else}in-stock{/if}">
          {$minStockMsg}
        </div>
        <div class="availability-tip">
            <a onmouseenter="showTooltip(this)" onmouseleave="removeTooltip(this)">
              <i class="material-icons" style="margin-right: 0;color: #333;">help</i>
            </a>
            <div class="availability-tip-message">
            {if $minFutureStock <= 0}
              {l s="This product is currently out of stock or requires a specific order. Please check ETA mentioned as working days to know approximative shipping date for this item." d="Shop.Theme.Checkout"}
            {else}
              {l s="This product is in stock in our warehouses and will ship the same day if ordered before 12:30 or next weekday if ordered later" d="Shop.Theme.Checkout"}
            {/if}
            </div>
        </div>

        {else}
          <div class="availability-message {if $product.quantity_available <= 0}low-stock{else}in-stock{/if}">
            {$product.availability_message}
          </div>
          <div class="availability-tip">
            <a onmouseenter="showTooltip(this)" onmouseleave="removeTooltip(this)">
              <i class="material-icons" style="margin-right: 0;color: #333;">help</i>
            </a>
            <div class="availability-tip-message">
            {if $product.quantity_available <= 0}
              {l s="This product is currently out of stock or requires a specific order. Please check ETA mentioned as working days to know approximative shipping date for this item." d="Shop.Theme.Checkout"}
            {else}
              {l s="This product is in stock in our warehouses and will ship the same day if ordered before 12:30 or next weekday if ordered later" d="Shop.Theme.Checkout"}
            {/if}
            </div>
          </div>
        {/if}
      </div>
      <script>
        function showTooltip(e) {
          const btnTooltip = e
          const tooltip = e.nextElementSibling

          tooltip.classList.add("show-tip")
        }
        function removeTooltip(e) {
          const btnTooltip = e
          const tooltip = e.nextElementSibling

          tooltip.classList.remove("show-tip")
        }
      </script>
    </div>

    <div class="hidden_mobile product-line-info col-lg-2 product-price h5 {if $product.has_discount}has-discount{/if}">
      {if $product.has_discount}
        <div class="product-discount">
          <span class="regular-price">{$product.regular_price|escape:'html':'UTF-8'}</span>
          {if $product.discount_type === 'percentage'}
            <span class="discount discount-percentage">
                -{$product.discount_percentage_absolute|escape:'html':'UTF-8'}
              </span>
          {else}
            <span class="discount discount-amount">
                -{$product.discount_to_display|escape:'html':'UTF-8'}
              </span>
          {/if}
        </div>
      {/if}
      <div class="current-price">
        <span class="price">{$product.price|escape:'html':'UTF-8'}</span>
        {if $product.unit_price_full}
          <div class="unit-price-cart">{$product.unit_price_full|escape:'html':'UTF-8'}</div>
        {/if}
      </div>
    </div>


    {if is_array($product.customizations) && Ets_onepagecheckout::validateArray($product.customizations) && $product.customizations|count}
      <br>
        {foreach from=$product.customizations item="customization"}
          <a href="#" data-toggle="modal" data-target="#product-customizations-modal-{$customization.id_customization|intval}">{l s='Product customization' mod='ets_onepagecheckout'}</a>
          <div class="modal fade customization-modal" id="product-customizations-modal-{$customization.id_customization|intval}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <h4 class="modal-title">{l s='Product customization' mod='ets_onepagecheckout'}</h4>
                </div>
                <div class="modal-body">
                  {foreach from=$customization.fields item="field"}
                    <div class="product-customization-line row">
                      <div class="col-sm-3 col-xs-4 label">
                            {$field.label|escape:'html':'UTF-8'}
                      </div>
                      <div class="col-sm-9 col-xs-8 value">
                        {if $field.type == 'text'}
                          {if (int)$field.id_module}
                            {$field.text nofilter}
                          {else}
                            {$field.text|escape:'html':'UTF-8'}
                          {/if}
                        {elseif $field.type == 'image'}
                          <img src="{$field.image.small.url|escape:'html':'UTF-8'}">
                        {/if}
                      </div>
                    </div>
                  {/foreach}
                </div>
              </div>
            </div>
          </div>
        {/foreach}
    {/if}
  </div>

  <!--  product left body: description -->
  <div class="product-line-grid-right product-line-actions col-lg-5 col-md-5 col-xs-12">
    <div class="row">
      <div class="col-md-10 col-xs-12 form_info_price_mobile">
        <div class="row">
          <div class="col-xs-4 form_price hidden_desktop" data-title="{l s='Price' mod='ets_onepagecheckout'}">
            <div class="product-line-info product-price h5 {if $product.has_discount}has-discount{/if}">
              {if $product.has_discount}
                <div class="product-discount">
                  <span class="regular-price">{$product.regular_price|escape:'html':'UTF-8'}</span>
                  {if $product.discount_type === 'percentage'}
                    <span class="discount discount-percentage">
                -{$product.discount_percentage_absolute|escape:'html':'UTF-8'}
              </span>
                  {else}
                    <span class="discount discount-amount">
                -{$product.discount_to_display|escape:'html':'UTF-8'}
              </span>
                  {/if}
                </div>
              {/if}
              <div class="current-price">
                <span class="price">{$product.price|escape:'html':'UTF-8'}</span>
                {if $product.unit_price_full}
                  <div class="unit-price-cart">{$product.unit_price_full|escape:'html':'UTF-8'}</div>
                {/if}
              </div>
            </div>
          </div>
          <div class="col-md-6 col-xs-4 qty" data-title="{l s='Qty' mod='ets_onepagecheckout'}">
            {if isset($product.is_gift) && $product.is_gift}
              <span class="gift-quantity">{$product.quantity|intval}</span>
            {else}
              <input
                class="js-cart-line-product-quantity"
                data-down-url="{$product.down_quantity_url|escape:'html':'UTF-8'}&id_country={Tools::getValue('id_country')|escape:'html':'UTF-8'}&id_state={Tools::getValue('id_state')|escape:'html':'UTF-8'}"
                data-up-url="{$product.up_quantity_url|escape:'html':'UTF-8'}&id_country={Tools::getValue('id_country')|escape:'html':'UTF-8'}&id_state={Tools::getValue('id_state')|escape:'html':'UTF-8'}"
                data-update-url="{$product.update_quantity_url|escape:'html':'UTF-8'}&id_country={Tools::getValue('id_country')|escape:'html':'UTF-8'}&id_state={Tools::getValue('id_state')|escape:'html':'UTF-8'}"
                data-product-id="{$product.id_product|intval}"
                type="number"
                value="{$product.quantity|escape:'html':'UTF-8'}"
                name="product-quantity-spin"
                min="{$product.minimal_quantity|escape:'html':'UTF-8'}"
              />
            {/if}
          </div>
          <div class="col-md-6 col-xs-4 form_total_price" data-title="{l s='Total' mod='ets_onepagecheckout'}">
            <span class="product-price">
              <strong>
                {if isset($product.is_gift) && $product.is_gift}
                  <span class="gift">{l s='Gift' mod='ets_onepagecheckout'}</span>
                {else}
                  {$product.total|escape:'html':'UTF-8'}
                {/if}
              </strong>
            </span>
          </div>
        </div>
      </div>
      <div class="col-md-2 col-xs-4 text-xs-right ets_remove_cart">
        <div class="cart-line-product-actions">
          <a
              class                       = "remove-from-cart"
              rel                         = "nofollow"
              href                        = "{$product.remove_from_cart_url|escape:'html':'UTF-8'}"
              data-link-action            = "ets-delete-from-cart"
              data-id-product             = "{$product.id_product|intval}"
              data-id-product-attribute   = "{$product.id_product_attribute|intval}"
              data-id-customization   	  = "{$product.id_customization|intval}"
          >
            {if !isset($product.is_gift) || !$product.is_gift}
                <span class="ets_icon_svg">
                    <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M704 1376v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm-544-992h448l-48-117q-7-9-17-11h-317q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5h-832q-66 0-113-58.5t-47-141.5v-952h-96q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z"/></svg>
                </span>
            {/if}
          </a>
          {hook h='displayCartExtraProductActions' product=$product}
        </div>
      </div>
    </div>
  </div>

  <div class="clearfix"></div>
</div>


<div class="product-line-grid d-mobile" style="padding: 1rem;">

  <div class="col-xs-4" style="display: flex; flex-direction:column;gap:2rem;">
    <!--  product left content: image-->
    <div class="product-line-grid-left" style="width: 100%;">
      <span class="product-image media-middle">
        {if $product.default_image}
            <img src="{$product.default_image.bySize.cart_default.url|escape:'html':'UTF-8'}" alt="{$product.name|escape:'quotes'}" loading="lazy">
        {else}
          <img src="{$urls.no_picture_image.bySize.cart_default.url|escape:'html':'UTF-8'}" loading="lazy" />
        {/if}
      </span>
    </div>

    <div class="text-center">
      <div class="cart-container-availability">
        <div class="availability-message">
          {$product.availability_message}
        </div>
        <div class="availability-tip">
          <a data-toggle="tooltip" onclick="clickTooltip(this)">
            <i class="material-icons" style="margin-right: 0;color: #333;">help</i>
          </a>
          <div class="availability-tip-message">
          {if $product.quantity_available <= 0}
            {l s="This product is currently out of stock or requires a specific order. Please check ETA mentioned as working days to know approximative shipping date for this item." d="Shop.Theme.Checkout"}
          {else}
            {l s="This product is in stock in our warehouses and will ship the same day if ordered before 12:30 or next weekday if ordered later" d="Shop.Theme.Checkout"}
          {/if}
          </div>
        </div>
      </div>
      <script>
        function clickTooltip(e) {
          const btnTooltip = e
          const tooltip = e.nextElementSibling

          tooltip.classList.toggle("show-tip")
        }
      </script>
    </div>

    <div class="text-center">
      <div class="cart-line-product-actions">
        <a
            class                       = "remove-from-cart"
            rel                         = "nofollow"
            href                        = "{$product.remove_from_cart_url|escape:'html':'UTF-8'}"
            data-link-action            = "ets-delete-from-cart"
            data-id-product             = "{$product.id_product|intval}"
            data-id-product-attribute   = "{$product.id_product_attribute|intval}"
            data-id-customization   	  = "{$product.id_customization|intval}"
        >
          {if !isset($product.is_gift) || !$product.is_gift}
              <span class="ets_icon_svg">
                  <svg viewBox="0 0 1792 1792" xmlns="http://www.w3.org/2000/svg"><path d="M704 1376v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm256 0v-704q0-14-9-23t-23-9h-64q-14 0-23 9t-9 23v704q0 14 9 23t23 9h64q14 0 23-9t9-23zm-544-992h448l-48-117q-7-9-17-11h-317q-10 2-17 11zm928 32v64q0 14-9 23t-23 9h-96v948q0 83-47 143.5t-113 60.5h-832q-66 0-113-58.5t-47-141.5v-952h-96q-14 0-23-9t-9-23v-64q0-14 9-23t23-9h309l70-167q15-37 54-63t79-26h320q40 0 79 26t54 63l70 167h309q14 0 23 9t9 23z"/></svg>
              </span>
          {/if}
        </a>
        {hook h='displayCartExtraProductActions' product=$product}
      </div>
    </div>

  </div>

  <div class="col-xs-8">

    <!--  product left body: description -->
    <div class="product-line-grid-body" style="width: 100%;">

      <div class="product-line-info product_info_name" style="text-align: center !important;">
        <a class="label" href="{$product.url|escape:'html':'UTF-8'}" data-id_customization="{$product.id_customization|intval}" style="text-align: center !important;">{$product.name|escape:'html':'UTF-8'}</a>
        {if isset($product.attributes) && $product.attributes}
          {foreach from=$product.attributes key="attribute" item="value"}
            <div class="product-line-info attribute">
              <span class="label">{$attribute|escape:'html':'UTF-8'}:</span>
              <span class="value">{$value|escape:'html':'UTF-8'}</span>
            </div>
          {/foreach}
        {/if}
      </div>



      <div class="hidden_mobile product-line-info col-lg-2 product-price h5 {if $product.has_discount}has-discount{/if}">
        {if $product.has_discount}
          <div class="product-discount">
            <span class="regular-price">{$product.regular_price|escape:'html':'UTF-8'}</span>
            {if $product.discount_type === 'percentage'}
              <span class="discount discount-percentage">
                  -{$product.discount_percentage_absolute|escape:'html':'UTF-8'}
                </span>
            {else}
              <span class="discount discount-amount">
                  -{$product.discount_to_display|escape:'html':'UTF-8'}
                </span>
            {/if}
          </div>
        {/if}
        <div class="current-price">
          <span class="price">{$product.price|escape:'html':'UTF-8'}</span>
          {if $product.unit_price_full}
            <div class="unit-price-cart">{$product.unit_price_full|escape:'html':'UTF-8'}</div>
          {/if}
        </div>
      </div>


      {if is_array($product.customizations) && Ets_onepagecheckout::validateArray($product.customizations) && $product.customizations|count}
        <br>
          {foreach from=$product.customizations item="customization"}
            <a href="#" data-toggle="modal" data-target="#product-customizations-modal-{$customization.id_customization|intval}">{l s='Product customization' mod='ets_onepagecheckout'}</a>
            <div class="modal fade customization-modal" id="product-customizations-modal-{$customization.id_customization|intval}" tabindex="-1" role="dialog" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title">{l s='Product customization' mod='ets_onepagecheckout'}</h4>
                  </div>
                  <div class="modal-body">
                    {foreach from=$customization.fields item="field"}
                      <div class="product-customization-line row">
                        <div class="col-sm-3 col-xs-4 label">
                              {$field.label|escape:'html':'UTF-8'}
                        </div>
                        <div class="col-sm-9 col-xs-8 value">
                          {if $field.type == 'text'}
                            {if (int)$field.id_module}
                              {$field.text nofilter}
                            {else}
                              {$field.text|escape:'html':'UTF-8'}
                            {/if}
                          {elseif $field.type == 'image'}
                            <img src="{$field.image.small.url|escape:'html':'UTF-8'}">
                          {/if}
                        </div>
                      </div>
                    {/foreach}
                  </div>
                </div>
              </div>
            </div>
          {/foreach}
      {/if}
    </div>

    <!--  product left body: description -->
    <div class="product-line-grid-right product-line-actions" style="padding: 0;">
      <div class="row" style="width: 100%;">
        <div class="form_info_price_mobile">
          <div class="row" style="width: 100%;">
            <div class="form_price hidden_desktop" data-title="" style="width: 100%;border:0;display:flex;flex-direction:column;">
              <span style="font-size: 1rem;font-weight: 600;color: #333;">{l s='Price' mod='ets_onepagecheckout'}</span>
              <div class="product-line-info product-price h5 {if $product.has_discount}has-discount{/if}">
                {if $product.has_discount}
                  <div class="product-discount">
                    <span class="regular-price">{$product.regular_price|escape:'html':'UTF-8'}</span>
                    {if $product.discount_type === 'percentage'}
                      <span class="discount discount-percentage">
                  -{$product.discount_percentage_absolute|escape:'html':'UTF-8'}
                </span>
                    {else}
                      <span class="discount discount-amount">
                  -{$product.discount_to_display|escape:'html':'UTF-8'}
                </span>
                    {/if}
                  </div>
                {/if}
                <div class="current-price">
                  <span class="price">{$product.price|escape:'html':'UTF-8'}</span>
                  {if $product.unit_price_full}
                    <div class="unit-price-cart">{$product.unit_price_full|escape:'html':'UTF-8'}</div>
                  {/if}
                </div>
              </div>
            </div>
            <div class="qty" style="width: 100%;border:0;display:flex;flex-direction:column;gap:.5rem;">
                  <span style="font-size: 1rem;font-weight: 600;color: #333;">{l s='Qty' mod='ets_onepagecheckout'}</span>
              {if isset($product.is_gift) && $product.is_gift}
                <span class="gift-quantity">{$product.quantity|intval}</span>
              {else}
                <input
                class="js-cart-line-product-quantity"
                data-down-url="{$product.down_quantity_url}"
                data-up-url="{$product.up_quantity_url}"
                data-update-url="{$product.update_quantity_url}"
                data-product-id="{$product.id_product}"
                type="number"
                inputmode="numeric"
                pattern="[0-9]*"
                value="{$product.quantity}"
                name="product-quantity-spin"
                aria-label="{l s='%productName% product quantity field' sprintf=['%productName%' => $product.name] d='Shop.Theme.Checkout'}"
                />
              {/if}
            </div>
            <div class="form_total_price" style="width: 100%;border:0;margin-top:1rem;">
              <span style="font-size: 1rem;font-weight: 600;color: #333;">{l s='Total' mod='ets_onepagecheckout'}:</span>
              <span class="product-price" style="font-weight: 500;font-size:1rem;">
                <span>
                  {if isset($product.is_gift) && $product.is_gift}
                    <span class="gift">{l s='Gift' mod='ets_onepagecheckout'}</span>
                  {else}
                    {$product.total|escape:'html':'UTF-8'}
                  {/if}
                </span>
              </span>
            </div>
          </div>
        </div>

      </div>
    </div>

  </div>

  

  <div class="clearfix"></div>
</div>