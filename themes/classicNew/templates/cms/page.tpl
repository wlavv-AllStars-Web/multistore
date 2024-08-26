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
{extends file='page.tpl'}

{block name='page_title'}
  {$cms.meta_title}
{/block}

{block name='page_content_container'}
  <section id="content" class="page-content page-cms page-cms-{$cms.id}">

    {block name='cms_content'}
      {if $cms.id == 52}
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        <div class="cms_specificRequest">
        <div class="banner_cms"><img class="img-desktop"
            src="/img/eurmuscle/cmsBanners/Banners-specific.webp" width="1440" alt="Banners-contact.webp" /> <img
            class="img-mobile" src="/img/eurmuscle/cmsBanners/Banners-specificMobile.webp" alt="Banners-contact.webp" />
          <h2 style="font-size: 5rem; color: #fff;">{l s='SPECIFIC REQUEST' d='Shop.Forms.SpecificRequest'}</h2>
        </div>
        <form class="form_specificRequest needs-validation" method="post" novalidate>
            <input type="hidden" name="action_job" value="form_specificRequest"/>
            <div class="form-row">
              <h5 class="col-md-12">{l s='Personal Information' d='Shop.Forms.SpecificRequest'}</h5>
              <div class="col-md-4 mb-3">
                <label for="validationCustom01">{l s='First name' d='Shop.Forms.SpecificRequest'}</label>
                <input type="text" class="form-control" id="validationCustom01" name="firstname" placeholder="First name"  value="{$customer.firstname}" required>
                <div class="invalid-feedback">
                    {l s='Please insert your a valid first name.' d='Shop.Forms.SpecificRequest'}
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationCustom02">{l s='Last name' d='Shop.Forms.SpecificRequest'}</label>
                <input type="text" class="form-control" id="validationCustom02" name="lastname" placeholder="Last name"  value="{$customer.lastname}" required>
                <div class="invalid-feedback">
                    {l s='Please insert your a valid last name.' d='Shop.Forms.SpecificRequest'}
                </div>
              </div>
              <div class="col-md-4 mb-3">
                <label for="validationCustomEmail">Email</label>
                <div class="input-group">
                  <input type="email" class="form-control" id="validationCustomEmail" name="email" placeholder="Email" aria-describedby="inputGroupPrepend" value="{$customer.email}" required>
                  <div class="invalid-feedback">
                    {l s='Please insert a valid email.' d='Shop.Forms.SpecificRequest'}
                  </div>
                </div>
              </div>
            </div>
            <div class="form-row mt-3">
              <h5 class="col-md-12">{l s='Car Information' d='Shop.Forms.SpecificRequest'}</h5>
              <div class="col-md-3 mb-3">
                <label for="validationCustom03">{l s='Brand' d='Shop.Forms.SpecificRequest'}</label>
                <input type="text" class="form-control" name="brand" id="validationCustom03" placeholder="Brand" required>
                <div class="invalid-feedback">
                  {l s='Please provide a valid Brand.' d='Shop.Forms.SpecificRequest'}
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationCustom04">{l s='Model' d='Shop.Forms.SpecificRequest'}</label>
                <input type="text" class="form-control" name="model" id="validationCustom04" placeholder="Model" required>
                <div class="invalid-feedback">
                  {l s='Please provide a valid Model.' d='Shop.Forms.SpecificRequest'}
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationCustom05">{l s='Type' d='Shop.Forms.SpecificRequest'}</label>
                <input type="text" class="form-control" name="type" id="validationCustom05" placeholder="Type" required>
                <div class="invalid-feedback">
                  {l s='Please provide a valid Type.' d='Shop.Forms.SpecificRequest'}
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationCustom06">{l s='Version' d='Shop.Forms.SpecificRequest'}</label>
                <input type="text" class="form-control" name="version" id="validationCustom06" placeholder="Version" required>
                <div class="invalid-feedback">
                  {l s='Please provide a valid Version.' d='Shop.Forms.SpecificRequest'}
                </div>
              </div>
            </div>
            <div class="form-row mt-3">
              <h5 class="col-md-12">{l s='Product Information' d='Shop.Forms.SpecificRequest'}</h5>
              <div class="col-md-3 mb-3">
                <label for="validationCustom07">{l s='Product Brand' d='Shop.Forms.SpecificRequest'}</label>
                <input type="text" class="form-control" name="product_brand" id="validationCustom07" placeholder="Product Brand" >
                <div class="invalid-feedback">
                  {l s='Please provide a valid Product Brand.' d='Shop.Forms.SpecificRequest'}
                </div>
              </div>
              <div class="col-md-3 mb-3">
                <label for="validationCustom08">{l s='Product Type' d='Shop.Forms.SpecificRequest'}</label>
                <input type="text" class="form-control" name="product_type" id="validationCustom08" placeholder="Product Type" >
                <div class="invalid-feedback">
                  {l s='Please provide a valid Model.' d='Shop.Forms.SpecificRequest'}
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="col-md-6 mb-3">
                <label for="validationCustom09">{l s='Additional Information' d='Shop.Forms.SpecificRequest'}</label>
                <textarea class="form-control" name="aditional_info" id="validationCustom09" rows="3"></textarea>
                <div class="invalid-feedback">
                  {l s='Please provide a valid Brand.' d='Shop.Forms.SpecificRequest'}
                </div>
              </div>
            </div>

            <div class="form-group">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="invalidCheck" required>
                <label class="form-check-label" for="invalidCheck">
                  {l s='Agree to terms and conditions' d='Shop.Forms.SpecificRequest'}
                </label>
                <div class="invalid-feedback">
                  {l s='You must agree before submitting.' d='Shop.Forms.SpecificRequest'}
                </div>
              </div>
            </div>
            <button class="btn btn-submit-specific" type="submit">{l s='Submit' d='Shop.Forms.SpecificRequest'}</button>
          </form>
        </div>

        <script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();


</script>
      {else}
        {$cms.content nofilter}
      {/if}
    {/block}

    {block name='hook_cms_dispute_information'}
      {hook h='displayCMSDisputeInformation'}
    {/block}

    {block name='hook_cms_print_button'}
      {hook h='displayCMSPrintButton'}
    {/block}

  </section>
{/block}