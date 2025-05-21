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
{* {assign var="language_id" value=Context::getContext->language}
<pre>{$language_id|print_r}</pre> *}
<section class="contact-form" style="width:100%;max-width:1440px;">
{if $confirmation}
  <div class="alert-success">
    <ul style="display: flex;justify-content: center;align-items: center;margin:0;padding:1rem;">
      <li>{l s="Thank you for your message. It has been sent." d="Shop.Theme.ContactForm"}</li>
    </ul>
  </div>
{/if}
  <div align="center" style="background-color: #d3d3d3;">
    <img alt="contact" src="/img/eurorider/cms/contact_{$language.iso_code}.jpg" class="img-responsive" style="margin:0 auto;width:100%">
    {* <div style="max-width: 1200px;padding-top: 23px;font-height: 600; color:#000; font-size:16px;margin: 20px auto 40px auto;padding-inline:1rem">
      {l s='In order to provide optimal customer service in 4 languages that ensures fast and efficient follow-up of our contacts, our communications are exclusively carried out by email. We do not use telephone lines or social networks.' d='Shop.Theme.Global'}
    </div> *}

    <form action="{$urls.pages.contact}" method="post" {if $contact.allow_file_upload}enctype="multipart/form-data"{/if} style="max-width: 1440px;">
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

          <div class="form-group row">
            <div class="col-md-9 col-md-offset-3">
              <h3></h3>
            </div>
          </div>

          {* <div class="form-group row">
            <label class="col-md-3 form-control-label" for="id_contact">{l s='Subject' d='Shop.Forms.Labels'}</label>
            <div class="col-md-6">
              <select name="id_contact" id="id_contact" class="form-control form-control-select">
                {foreach from=$contact.contacts item=contact_elt}
                  <option value="{$contact_elt.id_contact}">{$contact_elt.name}</option>
                {/foreach}
              </select>
            </div>
          </div> *}

          {if $contact.orders}
            <div class="form-group row col-12 col-lg-4">
              <label class="col-md-12 form-control-label"
                for="id-order">{l s='Order reference' d='Shop.Forms.Labels'}</label>
              <div class="col-md-12">
                <select id="id-order" name="id_order" class="form-control form-control-select">
                  <option value="">{l s='Select reference' d='Shop.Forms.Help'}</option>
                  {foreach from=$contact.orders item=order}
                    <option value="{$order.id_order}">{$order.reference}</option>
                  {/foreach}
                </select>
              </div>
              <div class="col-12" style="display: flex;align-items: center;gap: 5px;justify-content:flex-start;padding-top:0.5rem;">
                <input type="checkbox" id="messageCheckBox" name="messageCheckBox" />
                <label for="messageCheckBox" style="margin-bottom: 0;">{l s='My contact does not refer to any order' d='Shop.Forms.Labels'}<sup>*</sup></label>
              </div>
              <span class="col-md-3 form-control-comment">
                {l s='optional' d='Shop.Forms.Help'}
              </span>
            </div>
          {else}
            <div class="form-group col-12 col-lg-4">
                <label class="col-md-12 form-control-label" for="reference">{l s='Order Reference' d='Shop.Forms.Labels'}<sup>*</sup></label>
                <div class="col-md-12">
                  <input id="reference" class="form-control" name="reference" type="text" value="{!!$contact.orders}"
                    placeholder="(ex: WNDGVVZLX)">
                </div>
                <div class="col-12" style="display: flex;align-items: center;gap: 5px;justify-content:flex-start;padding-top:0.5rem;">
                  <input type="checkbox" id="messageCheckBox" name="messageCheckBox" />
                  <label for="messageCheckBox" style="margin-bottom: 0;">{l s='My contact does not refer to any order' d='Shop.Forms.Labels'}<sup>*</sup></label>
                </div>
            </div>
          {/if}
          
          

          <div class="form-group  col-12 col-lg-4">
            <label class="col-md-12 form-control-label" for="name">{l s='Name' d='Shop.Forms.Labels'}<sup>*</sup></label>
            <div class="col-md-12">
              <input id="name" class="form-control" name="name" type="text" value=""
                placeholder="{l s='Name' d='Shop.Forms.Labels'}">
            </div>
          </div>

          {if $contact.email}
          <div class="form-group   col-12 col-lg-4">
            <label class="col-md-12 form-control-label" for="email">{l s='Email address' d='Shop.Forms.Labels'}<sup>*</sup></label>
            <div class="col-md-12">
              <input id="email" class="form-control" name="from" type="email" value="{$contact.email}"
                placeholder="{l s='your@email.com' d='Shop.Forms.Help'}">
            </div>
          </div>
          {else}
          <div class="form-group   col-12 col-lg-4">
            <label class="col-md-12 form-control-label" for="email">{l s='Email address' d='Shop.Forms.Labels'}<sup>*</sup></label>
            <div class="col-md-12">
              <input id="email" class="form-control" name="from" type="email" 
                placeholder="{l s='your@email.com' d='Shop.Forms.Help'}">
            </div>
          </div>
          {/if}
          

          {if $contact.allow_file_upload}
            <div class="form-group row col-12 col-lg-4">
              <label class="col-md-12 form-control-label" for="file-upload">{l s='Attachment' d='Shop.Forms.Labels'}</label>
              <div class="col-md-12">
                <input id="file-upload" type="file" name="fileUpload" class="filestyle"
                  data-buttonText="{l s='Choose file' d='Shop.Theme.Actions'}">
              </div>
              <span class="col-md-3 form-control-comment">
                {l s='optional' d='Shop.Forms.Help'}
              </span>
            </div>
          {/if}
            
          

          <div class="form-group row col-12">
            <label class="col-md-12 form-control-label"
              for="contactform-message" >{l s='Message' d='Shop.Forms.Labels'}</label>
            <div class="col-md-12">
              <textarea id="contactform-message" class="form-control" name="message"
                placeholder="{l s='How can we help?' d='Shop.Forms.Help'}"
                rows="3">{if $contact.message}{$contact.message}{/if}</textarea>
            </div>
            <span class="col-md-12" style="font-size: small;text-align:start;color:#333;">{l s='(max 500 chars)'}</span>
          </div>

          {if isset($id_module)}
            <div class="form-group row">
              <div class="offset-md-3">
                {hook h='displayGDPRConsent' id_module=$id_module}
              </div>
            </div>
          {/if}

        </section>

        <footer class="form-footer text-sm-left" style="padding-inline: 15px;display:flex;justify-content:space-between;">
          <style>
            input[name=url] {
              display: none !important;
            }
          </style>
          <input type="text" name="url" value="" />
          <input type="hidden" name="token" value="{$token}" />


          <div style="width: fit-content; height: fit-content; position: relative; padding: .5rem !important;">
            <button class="g-recaptcha btn btn-primary" 
            name="submitMessage"
            data-sitekey="6LePv_oqAAAAAJz5p1N-VGJBZNuC6ok9jw0z7CRj" 
            data-callback='onSubmit' 
            data-action='submit'>{l s='SEND' d='Shop.Theme.Actions'}</button>
            
          </div>

          <script>
            function onSubmit(token) {
                document.querySelector(".contact-form form").submit();
              }
          </script>

          {* <div class="whatsapp-contancts">
            <div style="display:flex;align-items:center;justify-content:end;">
              <div style="display:flex;align-items:center;justify-content:center;margin-right:1rem;">
                  <img src="https://www.all-stars-motorsport.com/img/whatsapp_search.png" style="width: 50px; height: 50px;padding:3px;margin-left:1rem;" alt="Whatsapp">
              <!--    <h3 style="margin: 0;font-weight:bolder;"><span style="color: #007a12;">Whatsapp</span></h3> -->
              </div>
              
              <div style="padding: 0 1rem;display:flex;">
                  <a class="social-icon-whatsapp-number" style="margin-right: 8px;display:flex;align-items:center;gap:0.5rem;padding: 0.5rem 8px;" href="https://wa.me/+351912201753" target="_blank">
                      <img src="https://www.all-stars-motorsport.com/img/en_flag_emails.jpg" width="34" height="auto" style="border-radius:5px;" alt="Whatsapp">
                      <p class="number_whatsapp_header" style="width:fit-content;margin:0;font-weight:bold;color: #282828;font-size:1rem;margin-left:1rem;text-decoration: 2px underline #282828;">+351 912 201 753</p>
                  </a>
                  
                  <a class="social-icon-whatsapp-number" style="margin-right: 8px;display:flex;align-items:center;gap:0.5rem;padding: 0.5rem 8px;" href="https://wa.me/+34691161570" target="_blank">
                      <img src="https://www.all-stars-motorsport.com/img/es_flag_emails.jpg" width="34" height="auto" style="border-radius:5px;" alt="Whatsapp">
                      <p class="number_whatsapp_header" style="width:fit-content;margin:0;font-weight:bold;color: #282828;font-size:1rem;margin-left:1rem;text-decoration: 2px underline #282828;">+34 691 16 15 70</p>
                  </a>
                  
                  <a class="social-icon-whatsapp-number" style="margin-right: 8px;display:flex;align-items:center;gap:0.5rem;padding: 0.5rem 8px;" href="https://wa.me/+330651871788" target="_blank">
                      
                      <img src="https://www.all-stars-motorsport.com/img/fr_flag_emails.jpg" width="34" height="auto" style="border-radius:5px;" alt="Whatsapp">
                      <p class="number_whatsapp_header" style="width:fit-content;margin:0;font-weight:bold;color: #282828;font-size:1rem;margin-left:1rem;text-decoration: 2px underline #282828;">+33 0651871788</p>
                  </a>
              </div>
            </div>
          </div> *}

          {* <div class=" whatsapp-mobile mobile">
            <div>
              <a class="social-icon-whatsapp-number" style="margin-right: 8px;display:flex;align-items:center;gap:0.5rem;padding: 0.5rem 8px;" href="https://wa.me/+351912201753" target="_blank">
                  <img src="https://www.all-stars-motorsport.com/img/en_flag_emails.jpg" width="34" height="auto" style="border-radius:5px;" alt="Whatsapp">
                  <p class="number_whatsapp_header" style="width:fit-content;margin:0;font-weight:bold;color: #282828;font-size:1rem;margin-left:1rem;text-decoration: 2px underline #282828;">+351 912 201 753</p>
              </a>
              
              <a class="social-icon-whatsapp-number" style="margin-right: 8px;display:flex;align-items:center;gap:0.5rem;padding: 0.5rem 8px;" href="https://wa.me/+34691161570" target="_blank">
                  <img src="https://www.all-stars-motorsport.com/img/es_flag_emails.jpg" width="34" height="auto" style="border-radius:5px;" alt="Whatsapp">
                  <p class="number_whatsapp_header" style="width:fit-content;margin:0;font-weight:bold;color: #282828;font-size:1rem;margin-left:1rem;text-decoration: 2px underline #282828;">+34 691 16 15 70</p>
              </a>
              
              <a class="social-icon-whatsapp-number" style="margin-right: 8px;display:flex;align-items:center;gap:0.5rem;padding: 0.5rem 8px;" href="https://wa.me/+330651871788" target="_blank">
                  
                  <img src="https://www.all-stars-motorsport.com/img/fr_flag_emails.jpg" width="34" height="auto" style="border-radius:5px;" alt="Whatsapp">
                  <p class="number_whatsapp_header" style="width:fit-content;margin:0;font-weight:bold;color: #282828;font-size:1rem;margin-left:1rem;text-decoration: 2px underline #282828;">+33 0651871788</p>
              </a>
            </div>
          </div> *}

        </footer>
      {/if}

    </form>
  </div>
</section>

<style>
  #main {
    width: 100% !important;
    background: #FFFFFF;
  }

  #contact #content {
    margin: 1rem 0;
    background: #FFFFFF;
  }
  #contact .breadcrumb_wrapper{
    padding: 0;
  }
  #contact .breadcrumb_wrapper .breadcrumb{
    margin: 0;
  }
  .contact-form {
    background: none repeat scroll 0 0 #FFFFFF;
    color: #d9d9d9;
    float: left;
    width: 100%;
  }

  .contact-form .form-fields {
    display: flex;
    flex-wrap: wrap;
  }


  .contact-form .form-group > * {
    padding-inline: 0;
  }

  .card {
    border: 0px;
  }

  .contact-form .form-control {
    color: #333333;
    border-radius: 4px;
  }

  .form-control-label{
    font-weight: bold;
    font-size: small;
    color: #333333 !important;
    text-align: start;

  }
  .form-control-label[for="contactform-message"]{
    position: relative;
    
  }
  .form-control-label[for="contactform-message"]::after{
    content: '*';
    color: var(--color-red);
    position: absolute;
  }

  .contact-form .btn[type="submit"]:hover{
    background: var(--color-red) !important;
    color: white !important;
  }

  .contact-form .btn[type="submit"]:hover ~ i{
    color: white !important;
  }

@media screen and (min-width:769px) {
  .contact-form .btn[type="submit"]{
    height: 34px;
  }
}  

/* mobile */
@media screen and (max-width:768px){
  #contact #content {
    margin:0;
    background: #FFFFFF;
  }

  #contact #main {
    padding: 0;
  }

  #contact .container {
    margin-inline: 0;
  }

  #contact .breadcrumb_wrapper{
    display: none;
  }

  .contact-form .btn[type="submit"]{
    width: 200px;
    height: 44px;
  }

  #contact .footer_after {
    display: block;
  }


  #contact #messageCheckBox {
    width: 1.25rem;
    height: 1.25rem;
  }
}

</style>