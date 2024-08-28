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
{* {assign var="language_id" value=Context::getContext->language}
<pre>{$language_id|print_r}</pre> *}
{block name='page_content'}


<section class="contact-form" style="width:100%;max-width:1440px;">

{if isset($confirmation)}
    <div class="confirmation-msg">
        <p class="alert alert-success">{l s='Your message has been successfully sent to our team.'}</p>
    </div>

{elseif isset($alreadySent)}
    
    <div class="confirmation-msg">
        <p class="alert alert-warning">{l s='Your message has already been sent.'}</p>
    </div>
{/if}

  <div style="background-color: #fff;">
    {* <img alt="contact" src="/img/asd/Content_pages/contact/contact_{$language.iso_code}.webp" class="img-responsive" style="margin:0 auto;width:100%"> *}

    <div style="display:flex;">
        <ul class="nav nav-tabs" id="menu-client" role="tablist" style="display: flex;align-items:center;background-color: #f7f7f7; border: 1px solid #d8d8d8; height: 55px;margin-top: 20px;">
            <li class="nav-item">
                <a class="nav-link" title="{l s="Orders history" d="Shop.Theme.Statistics"}" id="order_history-tab"  onclick="openShippingtab('{$urls.pages.my_account}','order_history')"role="tab" aria-controls="order_history" aria-selected="false" style="padding:0.5rem 1rem;" ><i class="fa fa-list-ol website_blue font-size-40"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="statistics-tab" title="{l s="Statistics" d="Shop.Theme.Statistics"}"   onclick="openShippingtab('{$urls.pages.my_account}','statistics')" role="tab" aria-controls="statistics" aria-selected="false" style="padding:0.5rem 1rem;" ><i class="fa-solid fa-chart-column"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shipping-tab" title="{l s="Shipping Rates" d="Shop.Theme.Statistics"}"   onclick="openShippingtab('{$urls.pages.my_account}','shipping')" role="tab" aria-controls="shipping" aria-selected="false" style="padding:0.5rem 1rem;" ><i class="fa fa-truck website_blue font-size-40"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" title="{l s="Profile" d="Shop.Theme.Statistics"}"  onclick="openShippingtab('{$urls.pages.my_account}','profile')" role="tab" aria-controls="profile" aria-selected="false" style="padding:0.5rem 1rem;"  ><i class="fa fa-user website_blue font-size-40"></i></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="warranty-tab" title="{l s="Warranty" d="Shop.Theme.Statistics"}"  onclick="openShippingtab('{$urls.pages.my_account}','warranty')"  role="tab" aria-controls="warranty" aria-selected="false" style="padding:0.5rem 12px;" ><img src="/img/asd/warranty_icon.svg" width="37" /></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="contact-tab" title="{l s="Contact" d="Shop.Theme.Statistics"}"  href="" role="" aria-controls="contact" aria-selected="false" style="padding:0.5rem 9px;" ><img src="/img/asd/email_icon.svg" width="43" /></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="notification-tab" title="{l s="Notifications" d="Shop.Theme.Statistics"}"  onclick="openShippingtab('{$urls.pages.my_account}','notification')" role="tab" aria-controls="notification" aria-selected="false" style="padding:0.5rem 1rem;" ><i class="fa-solid fa-bell"></i></a>
            </li>
            {* <li class="nav-item" style="display:flex;justify-content: end;flex:1;">
                <a class="nav-link" id="logout-tab"  href="/?mylogout="><i class="fa-solid fa-lock-open"></i></a>
            </li> *}
        </ul>
    </div>

    <form action="{$request_uri}" method="post" class="contact-form-box" enctype="multipart/form-data" style="max-width:1350px; margin:2rem auto; background-color:#fff; box-shadow: none;">
        <div class="spacer-20"></div>
        <input type="hidden" value="2" name="id_contact">
		<div>
			<div id="contact-form-group" class="col-lg-12 px-0">
				<div class="name_field col-lg-3 pl-0">
					<div class="form-group">
                        <label for="firstname">{l s='Name' d="Shop.Theme.Contactform"}<sup>*</sup></label>
                        {* {if isset($customerThread.extrafield)}
                        <input class="form-control grey" type="text" id="extrafield" name="extrafield" value="{$customerThread.extrafield|escape:'htmlall':'UTF-8'}" readonly="readonly" maxlength="40" style="max-width: 100%;padding:0.5rem 1rem;"/>
                        {else} *}
                        <input class="is_required form-control grey validate" type="text" id="firstname" name="firstname" data-validate="isName" value="" maxlength="40" style="max-width: 100%;padding:0.5rem 1rem;"/>
                        {* {/if} *}
					</div>
				</div>
				<div class="lastname_field col-lg-3">
					<div class="form-group">
                        <label for="lastname">{l s='Last Name' d="Shop.Theme.Contactform"}<sup>*</sup></label>
                        {* {if isset($customerThread.extrafield)}
                        <input class="form-control grey" type="text" id="extrafield" name="extrafield" value="{$customerThread.extrafield|escape:'htmlall':'UTF-8'}" readonly="readonly" maxlength="40" style="max-width: 100%;padding:0.5rem 1rem;"/>
                        {else} *}
                        <input class="is_required form-control grey validate" type="text" id="lastname" name="lastname" data-validate="isName" value="" maxlength="40" style="max-width: 100%;padding:0.5rem 1rem;"/>
                        {* {/if} *}
					</div>
				</div>
				<div class="order_field" style="display: none;">
					<div class="form-group" style="max-width: 100%" >
						<label for="email">{l s='Order reference'}</label>
						<input  style="max-width: 100%;padding:0.5rem 1rem;" class="form-control grey" type="text" placeholder="(ex: WNDGVVZLX)" name="id_order" id="id_order" value="{if isset($customerThread.id_order) && $customerThread.id_order|intval > 0}{$customerThread.id_order|intval}{else}{if isset($smarty.post.id_order) && !empty($smarty.post.id_order)}{$smarty.post.id_order|escape:'html':'UTF-8'}{/if}{/if}" />
					</div>
				</div>
				<div class="email_field col-lg-6 pr-0">
					<p class="form-group"  style="max-width: 100%;">
						<label for="email">{l s='Email address' d="Shop.Theme.Contactform"}<sup>*</sup></label>
						{if isset($customerThread.email)}
							<input class="form-control grey" type="text" id="email" name="from" value="{$customerThread.email|escape:'html':'UTF-8'}" readonly="readonly" style="max-width: 100%;padding:0.5rem 1rem;"/>
						{else}
							<input class="form-control grey validate" type="text" id="email" name="from" data-validate="isEmail" value="{$email|escape:'html':'UTF-8'}" maxlength="40" style="max-width: 100%;padding:0.5rem 1rem;"/>
						{/if}
					</p>
				</div>
				
				<div style="height: 2px; width: 100%; display: inline-block"></div>
				<div class="form-group col-lg-12 px-0" >
					<label for="message">{l s='Message' d="Shop.Theme.Contactform"}<sup>*</sup></label>
					<textarea class="form-control" id="message" name="message" maxlength="500" style="padding:0.5rem 1rem;">{if isset($message)}{$message|escape:'html':'UTF-8'|stripslashes}{/if}</textarea>
					<span>{l s='(max 500 chars)' d="Shop.Theme.Contactform"}</span>
				</div>
			</div>
			<div class="submit col-lg-12 px-0">
				<button type="submit" name="submitMessage" id="submitMessage" class="btn btn-default btn-md">
					<span> {l s='Send' d="Shop.Theme.Contactform"} <i class="fa fa-chevron-right right"></i> </span>
				</button>
			</div>
		</div>
	</form>
  </div>
</section>
<style>
  #main {
    width: 100% !important;
    background: #FFFFFF;
  }

  .contact-form .form-control {
    color: #333333;
  }

  .contact-form .form-group{
    margin-bottom: 0;
  }

  .contact-form .btn[type="submit"]{
    background: #0273eb;
    border: 1px solid #0273eb;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1rem;
  }

  .contact-form .btn[type="submit"]:hover{
    color: #0273eb !important;
    background: #FFFFFF !important;
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
{/block}