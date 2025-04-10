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
<script src="https://www.google.com/recaptcha/api.js" ></script>

  <div class="banner_contact" style="position: relative;">
    <img class="contact_Banner" src="/img/eurmuscle/cmsBanners/Banners-contact.webp" />
    <h2 class="" style="position: absolute;bottom:1rem;color: #fff;">{l s="CONTACTS" d="Shop.Theme.Cms"}</h2>
  </div>
  
  <script>
    document.addEventListener("DOMContentLoaded", (event) => {
      const screenSize = screen.width;
      const banner_contact = document.querySelector(".banner_contact");
      const img_banner_contact = document.querySelector(".contact_Banner");

      const wrapper = document.getElementById("wrapper")

      if(screenSize > 390){
        banner_contact.classList.remove("banner_contact_mobile");
        banner_contact.classList.add("banner_contact_desk");
        wrapper.classList.add("wrapper_desktop");
        img_banner_contact.setAttribute("src", "/img/eurmuscle/cmsBanners/Banners-contact.webp")

      }else{
        banner_contact.classList.remove("banner_contact_desk");
        banner_contact.classList.add("banner_contact_mobile");
        wrapper.classList.add("wrapper_mobile");
        img_banner_contact.setAttribute("src", "/img/eurmuscle/cmsBanners/Banners-contactMobile.webp")
      }
    });
  </script>
<section class="contact-form">
  <form action="{$urls.pages.contact}" method="post" {if $contact.allow_file_upload}enctype="multipart/form-data"{/if}>
    {if $notifications}
      <div class="col-xs-12 alert {if $notifications.nw_error}alert-danger{else}alert-success{/if}">
        <ul>
          {foreach $notifications.messages as $notif}
            <li>{$notif}</li>
          {/foreach}
        </ul>
      </div>
    {/if}

    {if !$notifications || $notifications.nw_error}
      <section class="form-fields">

        {* <div class="form-group row">
          <div class="col-md-9 col-md-offset-3">
            <h3>{l s='Contact us' d='Shop.Theme.Global'}</h3>
          </div>
        </div> *}

        <div class="form-group row" style="display: none;">
          <label class="col-md-3 form-control-label" for="id_contact">{l s='Subject' d='Shop.Forms.Labels'}</label>
          <div class="col-md-12 col-sm-12">
            <select name="id_contact" id="id_contact" class="form-control form-control-select">
              {foreach from=$contact.contacts item=contact_elt}
                <option value="{$contact_elt.id_contact}">{$contact_elt.name}</option>
              {/foreach}
            </select>
          </div>
        </div>

        <div class="form-group  col-lg-4">
          <label class="col-md-12 form-control-label" for="firstname">{l s='Name' d='Shop.Forms.Labels'}</label>
          <div class="col-md-12 col-sm-12">
            <input
              id="firstname"
              class="form-control"
              name="firstname"
              type="text"
              value="{$contact.firstname}"
              placeholder="{l s='Your Name' d='Shop.Forms.Help'}"
            >
          </div>
        </div>

        <div class="form-group  col-lg-4">
          <label class="col-md-12 form-control-label" for="phone">{l s='Phone' d='Shop.Forms.Labels'}</label>
          <div class="col-md-12 col-sm-12">
            <input
              id="phone"
              class="form-control"
              name="phone"
              type="text"
              value="{$contact.phone}"
              placeholder="{l s='000 000 000' d='Shop.Forms.Help'}"
            >
          </div>
        </div>

        <div class="form-group  col-lg-4">
          <label class="col-md-12 form-control-label" for="email">{l s='Email address' d='Shop.Forms.Labels'}</label>
          <div class="col-md-12 col-sm-12">
            <input
              id="email"
              class="form-control"
              name="from"
              type="email"
              value="{$contact.email}"
              placeholder="{l s='your@email.com' d='Shop.Forms.Help'}"
            >
          </div>
        </div>

        {if $contact.orders}
          <div class="form-group  col-lg-4">
            <label class="col-md-12 form-control-label" for="id-order">{l s='Order reference' d='Shop.Forms.Labels'}</label>
            <div class="col-md-12 col-sm-12">
              <select id="id-order" name="id_order" class="form-control form-control-select">
                <option value="">{l s='Select reference' d='Shop.Forms.Help'}</option>
                {foreach from=$contact.orders item=order}
                  <option value="{$order.id_order}">{$order.reference}</option>
                {/foreach}
              </select>
            </div>
            <span class="col-md-2 form-control-comment">
              {l s='optional' d='Shop.Forms.Help'}
            </span>
          </div>
        {else}

        {/if}

        {* {if $contact.allow_file_upload}
          <div class="form-group row">
            <label class="col-md-2 form-control-label" for="file-upload">{l s='Attachment' d='Shop.Forms.Labels'}</label>
            <div class="col-md-6">
              <input id="file-upload" type="file" name="fileUpload" class="filestyle" data-buttonText="{l s='Choose file' d='Shop.Theme.Actions'}">
            </div>
            <span class="col-md-3 form-control-comment">
              {l s='optional' d='Shop.Forms.Help'}
            </span>
          </div>
        {/if} *}

        <div class="form-group  col-lg-8">
          <label class="col-md-12 form-control-label" for="contactform-message">{l s='Message' d='Shop.Forms.Labels'}</label>
          <div class="col-md-12 col-sm-12">
            <textarea
              id="contactform-message"
              class="form-control"
              name="message"
              placeholder="{l s='How can we help?' d='Shop.Forms.Help'}"
              rows="3"
            >{if $contact.message}{$contact.message}{/if}</textarea>
          </div>
        </div>

        {if isset($id_module)}
          <div class="form-group  col-lg-12">
            <div class="offset-md-3">
              {hook h='displayGDPRConsent' id_module=$id_module}
            </div>
          </div>
        {/if}

      </section>

      <footer class="form-footer text-sm-right col-lg-12 px-2">
        <style>
          input[name=url] {
            display: none !important;
          }
        </style>
        <input type="text" name="url" value=""/>
        <input type="hidden" name="token" value="{$token}" />
        {* <input class="btn btn-primary" type="submit" name="submitMessage" value="{l s='Send' d='Shop.Theme.Actions'}"> *}

        <div style="width: fit-content; height: fit-content; position: relative; padding: .5rem !important;">
          <button class="g-recaptcha btn btn-primary" 
          name="submitMessage"
          data-sitekey="6LePv_oqAAAAAJz5p1N-VGJBZNuC6ok9jw0z7CRj" 
          data-callback='onSubmit' 
          data-action='submit'>{l s='SEND' d='Shop.Theme.Actions'}</button>
          
        </div>

      <script defer="defer">
        function onSubmit(token) {
            document.querySelector(".contact-form form").submit();
          }
      </script>
      </footer>
    {/if}

  </form>
</section>
