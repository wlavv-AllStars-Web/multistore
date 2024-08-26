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
{extends file=$layout}

{block name='header'}
  {include file='../_partials/header.tpl'}
{/block}

{block name='content'}
  <section id="content">
    <div class="row row-checkout">
      {* <div class="cart-grid-body col-xs-12 col-lg-12"> *}
        {* {block name='cart_summary'} *}
          {* {include file='checkout/_partials/cart-summary.tpl' cart=$cart} *}
          {* {include file='checkout/cart.tpl'}
        {/block}
      </div> *}
      <div class="cart-grid-right col-xs-12 col-lg-12">
      {block name='cart_summary'}
        {include file='checkout/_partials/cart-summary.tpl' cart=$cart}
      {/block}

    {* {hook h='displayReassurance'} *}
      </div>
      {* {block name='continue_shopping'}
        <a class="label" onclick="window.history.go(-1); return false;" style="margin-left: 4rem;margin-right:1rem;font-size:1.1rem;color:#0273EB;" onMouseOver="this.style.color='#0273EB'" onMouseOut="this.style.color='#0273EB'">
          <i class="material-icons">chevron_left</i>{l s='Continue shopping' d='Shop.Theme.Actions'}
        </a>
      {/block} *}
    
      {* <div class="cart-grid-body col-xs-12 col-lg-12">
        {block name='checkout_process'}
          {render file='checkout/checkout-process.tpl' ui=$checkout_process}
        {/block}
      </div> *}
      {* <pre>{$urls.pages|print_r}</pre> *}
      {foreach from=$customer.addresses item=item key=key name=name}
        {assign var=address value=$item}
      {/foreach}

  
      <div class="col-lg-12 px-0">
        <div class="billing_address col-lg-6 px-0">
          <h3 class="page-subheading col-lg-12" style="border: 0px solid #123;margin:2rem 0;">Billing address</h3>
          <form>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="firstnameb">First Name</label>
              <input type="text" class="form-control" id="firstnameb"  disabled value="{$customer.firstname}">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="lastnameb">Last Name</label>
              <input type="text" class="form-control" id="lastnameb"  disabled  value="{$customer.lastname}">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="emailb">Email</label>
              <input type="email" class="form-control" id="emailb"  disabled  value="{$customer.email}">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="emailb">Address</label>
              <input type="email" class="form-control" id="emailb"  disabled  value="{$address.address1}">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="emailb"> Company name </label>
              <input type="email" class="form-control" id="emailb"  disabled  value="{$address.company}">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="emailb"> Address (Line 2) </label>
              <input type="email" class="form-control" id="emailb"  disabled  value="{$address.address2}">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="emailb"> Vat number </label>
              <input type="email" class="form-control" id="emailb" disabled  value="{$address.vat_number}">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="emailb"> Zip/Postal code </label>
              <input type="email" class="form-control" id="emailb" disabled  value="{$address.postcode}">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="emailb">Country</label>
              <input type="email" class="form-control" id="emailb"  disabled  value="{$address.country}">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="emailb">City</label>
              <input type="email" class="form-control" id="emailb"  disabled  value="{$address.city}">
            </div>
            <div class="form-group col-lg-12 col-md-7 col-xs-12">
              <a class="btn btn-primary" href="{$urls.pages.contact}" style="width: 100%;color:#0273EB;border:2px solid #0273EB;background:#fff;font-weight:bold;">Contact us to update</a>
            </div>
          </form>
        </div>

        <div class="deliver_address col-lg-6">
          <div class="form-group col-lg-12 col-md-7 col-xs-12 px-0" style="margin:2rem 0 28px 0;">
                <input class="form-check-input" type="checkbox" id="deliverAddress" onchange="toggleAddress(this)">
                <label class="form-check-label" for="deliverAddress" style="font-size: 16px;">
                Deliver to a different address?
                </label>
          </div>
          <form id="form_deliver_address" style="display: none;">
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="firstname">First Name</label>
              <input type="text" class="form-control" id="firstname" name="firstname" value="">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="lastname">Last Name</label>
              <input type="text" class="form-control" id="lastname" name="lastname" value="">
            </div>
            <div class="form-group col-lg-12 col-md-7 col-xs-12">
              <label for="company"> Company name </label>
              <input type="text" class="form-control" id="company" name="company">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="address1">Address</label>
              <input type="text" class="form-control" id="address1" name="address1">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="address2"> Address (Line 2) </label>
              <input type="text" class="form-control" id="address2" name="address2">
            </div>
            <div class="form-group col-lg-6 col-md-6">
              <label for="country">{l s='Country' d='Shop.Theme.Career'}<span style="color:#ee302e;">*</span></label>
              <select id="country" class="form-control" name="country">
                <option selected>{l s='Please Select...' d='Shop.Theme.Career'}</option>
                {foreach $countries as $country}
                  <option value="{$country['name']}">{substr($country["name"],0,24)}{(strlen($country["name"])>25)?'...':''}</option>
                {/foreach}
              </select>
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="phone"> Phone (with country code) </label>
              <input type="number" class="form-control" id="phone" name="phone">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="city">City</label>
              <input type="text" class="form-control" id="city" name="city">
            </div>
            <div class="form-group col-lg-6 col-md-7 col-xs-12">
              <label for="postalcode"> Zip/Postal code </label>
              <input type="email" class="form-control" id="postalcode" name="postalcode">
            </div>
            <div class="form-group col-lg-12">
              <label for="other">{l s='Additional information' d='Shop.Theme.FormBecomedealer'}</label>
              <textarea class="form-control" id="other" rows="2" name="other"></textarea>
            </div>
          </form>
        </div>
        
      </div>
      <div class="col-lg-12" style="display:flex;justify-content:center;align-items:center;flex-direction:column;margin:2rem 0;">
        <div class="accept_privacy_policy">
          <div class="form-group col-lg-12 col-md-7 col-xs-12 px-0" style="margin:2rem 0 28px 0;">
            <input class="form-check-input" type="checkbox" id="acceptPrivacy" onchange="togglePayment(this)">
            <label class="form-check-label" for="acceptPrivacy" style="font-size: 16px;">
            I declare that I have read and accept the privacy policies in force. To view the privacy policies, please click on: <a style="color:#0273EB;" href="{$link->getCMSLink(7)}">Privacy policies</a>
            </label>
          </div>
        </div>
        <div id="payment_checkout" class=" col-lg-12" style="text-align: center;margin:2rem 0;display:none;">
            <h3 style="margin-bottom: 2rem;text-transform:uppercase;">Select your payment method</h3>
            <div class="col-lg-12" style="display: flex;justify-content:center;gap:8rem;">
              
                <div id="wired_transfer_option" onclick="setWireTransfer();" style="text-align: center; width: fit-content;border-radius: 5px;cursor: pointer;"> 
                  <img src="https://www.all-stars-distribution.com/img/payment-bankwire-color.png?t=112">
                  <h5 style="font-weight: bolder;margin:0.5rem 0;">Bank transfer (0% fees)</h5> 
                  <div style="display: none;" class="radio" id="uniform-wired_transfer_option_input">
                    <span class="checked">
                      <input id="wired_transfer_option_input" type="radio" name="payment_method" value="bankwire" checked="checked" style="display: none;">
                    </span>
                  </div>
                </div>
              
                <div id="credit_card_option" onclick="setCreditCard();" style="text-align: center; width: fit-content; border-radius: 5px;cursor: pointer;border-bottom: 4px solid #FFF;"> 
                  <img src="https://www.all-stars-distribution.com//modules/ogone/views/img/default_user_logo.png?t=113">
                  <h5 style="font-weight: bolder;margin:0.5rem 0;">Credit card (+1% fees)</h5> 
                  <div style="display: none;" class="radio" id="uniform-credit_card_option_input">
                    <span>
                      <input id="credit_card_option_input" type="radio" name="payment_method" value="creditcard" style="display: none;">
                    </span>
                  </div>
                </div>
              
            </div>
        </div>
      </div>
      
      {hook h="payment" mod="bankwire"}




      
    </div>
  </section>
  <script>
    
    function setWireTransfer(){
        
        // $('#wired_transfer_option_input').attr('checked', 'checked');
        // $('#credit_card_option_input').attr('checked', null);
        // $('#credit_card_option').css('border', '4px solid white');
        // $('#wired_transfer_option').css('border-bottom', '4px solid #0273EB');
        // $('#confirm_button').css('display', 'block');
        document.querySelector("#bankwire_link").click();
    }

    // function setCreditCard(){
        
    //     $('#credit_card_option_input').attr('checked', 'checked');
    //     $('#wired_transfer_option_input').attr('checked', null);
    //     $('#credit_card_option').css('border-bottom', '4px solid #0273EB');
    //     $('#wired_transfer_option').css('border-bottom', '4px solid white');
    //     $('#confirm_button').css('display', 'block');
        
    //     $('#bankwire_link').click();

    // }
    
  </script>
{/block}

{block name='footer'}
  {include file='../_partials/footer.tpl'}
{/block}
