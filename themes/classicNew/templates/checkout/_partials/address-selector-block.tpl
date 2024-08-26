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
{block name='address_selector_blocks'}
  <div class="accordion" id="{$name|classname}">
  {foreach $addresses as $address}
    <div class="card js-address-item address-item{if $address.id == $selected} selected{/if}"
      id="{$name|classname}-address-{$address.id}">
      <div class="card-header" id="heading{$address.id}" >
        
          <label class="radio-block" onclick="checkIfChecked(this)">
          <span class="custom-radio" data-target="#collapse_{$name|classname}_{$address.id}" 
          data-toggle="collapse" >
            <input
              type="radio"
              name="{$name}"
              value="{$address.id}"
              id="{$address.id}"
              {if $address.id == $selected}checked{/if}
                
            >
            <span></span>
          </span>
          <span class="address-alias h4">{$address.alias}</span>

        </label>
        
      </div>

      <div id="collapse_{$name|classname}_{$address.id}"  class="collapse" aria-labelledby="heading{$address.id}" data-parent="#{$name|classname}">
        <div class="card-body">
          {$address.formatted nofilter}      
        </div>

        <footer class="address-footer">
        {if $interactive}
          <a
            class="edit-address text-muted"
            data-link-action="edit-address"
            href="{url entity='order' params=['id_address' => $address.id, 'editAddress' => $type, 'token' => $token]}"
          >
            <i class="material-icons edit">&#xE254;</i>{l s='Edit' d='Shop.Theme.Actions'}
          </a>
          <a
            class="delete-address text-muted"
            data-link-action="delete-address"
            href="{url entity='order' params=['id_address' => $address.id, 'deleteAddress' => true, 'token' => $token]}"
          >
            <i class="material-icons delete">&#xE872;</i>{l s='Delete' d='Shop.Theme.Actions'}
          </a>
        {/if}
      </footer>

      </div>
    </div>
  {/foreach}
  </div>
{if $interactive}
  <p>
    <button class="ps-hidden-by-js form-control-submit center-block" type="submit">{l s='Save' d='Shop.Theme.Actions'}</button>
  </p>
{/if}


{/block}
<script>


  function checkIfChecked(element){
    // const elementId = element.getAttribute("id")
    const radioButton = element.querySelector("input[type=radio]")
    const isChecked = true;
    radioButton.checked = true;

  }



</script>