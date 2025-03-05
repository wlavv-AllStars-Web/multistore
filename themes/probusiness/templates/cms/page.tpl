{*
* 2007-2022 ETS-Soft
*
* NOTICE OF LICENSE
*
* This file is not open source! Each license that you purchased is only available for 1 wesite only.
* If you want to use this file on more websites (or projects), you need to purchase additional licenses. 
* You are not allowed to redistribute, resell, lease, license, sub-license or offer our resources to any third party.
* 
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs, please contact us for extra customization service at an affordable price
*
*  @author ETS-Soft <etssoft.jsc@gmail.com>
*  @copyright  2007-2022 ETS-Soft
*  @license    Valid for 1 website (or project) for each purchase of license
*  International Registered Trademark & Property of ETS-Soft
*}
{extends file='page.tpl'}

{block name='page_title'}
  {$cms.meta_title|escape:'html':'UTF-8'}
{/block}

{block name='page_content_container'}
 <script src="https://www.google.com/recaptcha/api.js" ></script>
  <section id="content" class="page-content page-cms page-cms-{$cms.id|escape:'html':'UTF-8'}">

    {if isset($email_sent) && ($email_sent == 1)}
      <div class="spacer-20"></div>
      <div class="alert alert-success" role="alert" style="max-width: 1350px;margin: 0 auto;text-align: center;">
          {l s='Your enquiry  has been successfully sent and a sales representative will respond to you shortly' d='Shop.Theme.FormBecomedealer'}
      </div>
    {/if}
    {if isset($email_sent) && ($email_sent == 2)}
        <div class="spacer-20"></div>
        <div class="alert alert-success" role="alert" style="max-width: 1350px;margin: 0 auto;text-align: center;">
            {l s='Your request has been successfully sent and a human resources representative will respond to you shortly' d='Shop.Theme.FormBecomedealer'}!
        </div>
    {/if}

    {if isset($form_error) && ($form_error > 0 )}
        <div class="spacer-20"></div>
        <div class="alert alert-warning" role="alert" style="max-width: 1350px;margin: 0 auto;text-align: center;">
            {if $form_error == 1 }     {l s='error_message_1' d="Shop.Theme.ErrorsForm" js='1'}
            {elseif $form_error == 2 } {l s='error_message_2' d='Shop.Theme.ErrorsForm'  js='1'}
            {elseif $form_error == 3 } {l s='error_message_3' d='Shop.Theme.ErrorsForm'  js='1'}
            {elseif $form_error == 4 } {l s='error_message_4' d='Shop.Theme.ErrorsForm' js='1'}
            {elseif $form_error == 5 } {l s='error_message_5' d='Shop.Theme.ErrorsForm'  js='1'}
            {elseif $form_error == 6 } {l s='error_message_6' d='Shop.Theme.ErrorsForm' js='1'}
            {/if}
        </div>
    {/if}

    {assign var="fill_all" value="{l s='Please fill all required field!' d="Shop.Theme.ErrorsForm" js='1'}"}
    {assign var="error_1" value="{l s='error_message_1' d="Shop.Theme.ErrorsForm" js='1'}"}
    {assign var="error_2" value="{l s='error_message_2' d='Shop.Theme.ErrorsForm'  js='1'}"}
    {assign var="error_3" value="{l s='error_message_3' d='Shop.Theme.ErrorsForm'  js='1'}"}
    {assign var="error_4" value="{l s='error_message_4' d='Shop.Theme.ErrorsForm' js='1'}"}
    {assign var="error_5" value="{l s='error_message_5' d='Shop.Theme.ErrorsForm'  js='1'}"}
    {assign var="error_6" value="{l s='error_message_6' d='Shop.Theme.ErrorsForm' js='1'}"}


    {block name='cms_content'}
      {if $cms.id === 8}
        <div id="cms_container_8">
          <div><img class="about_banner p-img" src="/img/asd/Content_pages/aboutus/top_image_short.webp" alt="top_image_short" /></div>
          <div class="profile_container_cms">
          <div class="profile_style">{l s='Profile' d='Shop.Theme.About'}</div>
          <div class="profile_container_text" id="profile_container_text">{l s='Supplying over 30 top of the line brands to automotive performance professionals worldwide, All Stars Distribution is one of the largest European wholesalers of performance and design parts. Dedicated to serving shops, tuners, e-dealers and other resellers, All Stars Distribution is committed to employing the best of inventory management and distribution practices to get our customers the performance parts they need to satisfy their customers.' d='Shop.Theme.About'}</div>
          <div id="profile_container_text1 hidden-md-up" class="card_view_more">{l s='View More' d='Shop.Theme.About'}</div>
          </div>
          <div>
            <img class="aboutImageBadge" src="/img/asd/Content_pages/aboutus/badge_lg.webp" alt="badge_lg"/>
          </div>
          <div>
            <img class="about_content_img"  alt="about image"/>
            <img class="about_content_img2" loading="lazy" alt="about image2"/>
            <img class="about_content_img3" loading="lazy" alt="about image3"/>
            <img class="about_content_img4" loading="lazy" alt="about image4"/>
            <img class="about_content_img5" loading="lazy" alt="about image5"/>
            <img class="about_content_img6" loading="lazy" alt="about image6"/>
            <img class="about_content_img7" loading="lazy" alt="about image7"/>
          </div>
        </div>


        <script>
            function updateAboutImage() {
              const aboutBanner = document.querySelector(".about_banner");
              const aboutImage = document.querySelector(".about_content_img");
              const aboutImageBadge = document.querySelector(".aboutImageBadge");
              const aboutImage2 = document.querySelector(".about_content_img2");
              const aboutImage3 = document.querySelector(".about_content_img3");
              const aboutImage4 = document.querySelector(".about_content_img4");
              const aboutImage5 = document.querySelector(".about_content_img5");
              const aboutImage6 = document.querySelector(".about_content_img6");
              const aboutImage7 = document.querySelector(".about_content_img7");
              const screenWidth = window.screen.width;
              const languageCode = "{$language.iso_code}"; // Assuming this is available in your template

              if (screenWidth > 1140) {
                aboutBanner.setAttribute("src",'/img/asd/Content_pages/aboutus/top_image_short.webp')
                aboutBanner.setAttribute("width",'1350')
                aboutBanner.setAttribute("height",'300')
                aboutImage2.style.display = "none";
                aboutImage3.style.display = "none";
                aboutImage4.style.display = "none";
                aboutImage5.style.display = "none";
                aboutImage6.style.display = "none";
                aboutImage7.style.display = "none";
                aboutImageBadge.setAttribute("src",'/img/asd/Content_pages/aboutus/badge_lg.webp')
                aboutImageBadge.setAttribute("width",'1700')
                aboutImageBadge.setAttribute("height",'196')
                aboutImage.setAttribute("src", '/img/asd/Content_pages/aboutus/lg_'+languageCode+'.webp');
                aboutImage.setAttribute("width", "1700");
                aboutImage.setAttribute("height", "7627");
              } else if (screenWidth > 575) {
                aboutBanner.setAttribute("src",'/img/asd/Content_pages/aboutus/top_image_short.webp')
                aboutBanner.setAttribute("width",'1139')
                aboutBanner.setAttribute("height",'196')
                aboutImage2.style.display = "none";
                aboutImage3.style.display = "none";
                aboutImage4.style.display = "none";
                aboutImage5.style.display = "none";
                aboutImage6.style.display = "none";
                aboutImage7.style.display = "none";
                aboutImageBadge.setAttribute("src",'/img/asd/Content_pages/aboutus/badge_sm.webp')
                aboutImageBadge.setAttribute("width",'1139')
                aboutImageBadge.setAttribute("height",'196')
                aboutImage.setAttribute("src", '/img/asd/Content_pages/aboutus/sm_'+languageCode+'.webp');
                aboutImage.setAttribute("width", "1139");
                aboutImage.setAttribute("height", "11086");
              } else {
                aboutBanner.setAttribute("src",'/img/asd/Content_pages/aboutus/top_image_short_xs.webp')
                aboutBanner.setAttribute("width",'567')
                aboutBanner.setAttribute("height",'107')
                aboutImage2.style.display = "block";
                aboutImage3.style.display = "block";
                aboutImage4.style.display = "block";
                aboutImage5.style.display = "block";
                aboutImage6.style.display = "block";
                aboutImage7.style.display = "block";
                aboutImageBadge.setAttribute("src",'/img/asd/Content_pages/aboutus/badge_xs.webp')
                aboutImageBadge.setAttribute("width",'567')
                aboutImageBadge.setAttribute("height",'107')
                aboutImageBadge.style.padding = "0.5rem";
                aboutImage.setAttribute("src", '/img/asd/Content_pages/aboutus/xs_'+languageCode+'1.webp');
                aboutImage.setAttribute("width", "575");
                aboutImage.setAttribute("height", "762");
                aboutImage2.setAttribute("src", '/img/asd/Content_pages/aboutus/xs_'+languageCode+'2.webp');
                aboutImage2.setAttribute("width", "575");
                aboutImage2.setAttribute("height", "763");
                aboutImage3.setAttribute("src", '/img/asd/Content_pages/aboutus/xs_'+languageCode+'3.webp');
                aboutImage3.setAttribute("width", "575");
                aboutImage3.setAttribute("height", "763");
                aboutImage4.setAttribute("src", '/img/asd/Content_pages/aboutus/xs_'+languageCode+'4.webp');
                aboutImage4.setAttribute("width", "575");
                aboutImage4.setAttribute("height", "763");
                aboutImage5.setAttribute("src", '/img/asd/Content_pages/aboutus/xs_'+languageCode+'5.webp');
                aboutImage5.setAttribute("width", "575");
                aboutImage5.setAttribute("height", "763");
                aboutImage6.setAttribute("src", '/img/asd/Content_pages/aboutus/xs_'+languageCode+'6.webp');
                aboutImage6.setAttribute("width", "575");
                aboutImage6.setAttribute("height", "763");
                aboutImage7.setAttribute("src", '/img/asd/Content_pages/aboutus/xs_'+languageCode+'7.webp');
                aboutImage7.setAttribute("width", "575");
                aboutImage7.setAttribute("height", "763");
              }
            }
            updateAboutImage();
            // document.addEventListener("DOMContentLoaded", updateLegalImage);
            window.addEventListener("resize", updateAboutImage);
        </script>
      {else if $cms.id === 14}

        
        

        <div id="cms_container_14">
          <div>
            <img class="banner_becomedealer p-img" data-src="/img/asd/dealers/headers/bdealer_{$language.iso_code}.webp" alt="banner_becomedealer" width="1350" height="300" />
          </div>
          <div class="choose_us_btn">
            <h5 class="cms_shadow_button">{l s='Why choose us ?' d='Shop.Theme.BecomeDealer'}</h5>
          </div>
          <p class="become_dealer_text">
          {l s='European leader in the Automotive Distribution Industry, All Stars Distribution supplies daily hundreds specialized professionals around the world. ' d='Shop.Theme.BecomeDealer'}
          <br>
          <br>
          {l s="Betting on long-term partnership, we're very selective and approve new accounts only for companies matching with our requirements" d='Shop.Theme.BecomeDealer'}
          </p>
          <div class="requirements_container">
            <h1 class="requirements">{l s='> NEW ACCOUNT REQUIREMENTS <' d='Shop.Theme.BecomeDealer'}</h1>
          </div>
          <div class="become_cards">
            <div class="become_card_requirement">
              <div class="card_title">{l s='Business' d='Shop.Theme.BecomeDealer'}</div>
              <div class="card_content">
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Storefront' d='Shop.Theme.BecomeDealer'}</div>
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Workshop' d='Shop.Theme.BecomeDealer'}</div>
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Tuner' d='Shop.Theme.BecomeDealer'}</div>
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='E-dealer' d='Shop.Theme.BecomeDealer'}</div>
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Trader' d='Shop.Theme.BecomeDealer'}</div>
              </div>
            </div>
            <div class="become_card_requirement">
              <div class="card_title">{l s='Admin' d='Shop.Theme.BecomeDealer'}</div>
              <div class="card_content">
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Valid VAT number' d='Shop.Theme.BecomeDealer'}</div>
                <div class="card_content_option option_plus"><i class="fa-solid fa-plus"></i></div>
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Valid business license' d='Shop.Theme.BecomeDealer'}</div>
                <div class="card_content_option option_plus"><i class="fa-solid fa-plus"></i></div>
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Valid bank account' d='Shop.Theme.BecomeDealer'}</div>
              </div>
            </div>
            <div class="become_card_requirement">
              <div class="card_title">{l s='Visibility' d='Shop.Theme.BecomeDealer'}</div>
              <div class="card_content">
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Active website' d='Shop.Theme.BecomeDealer'}</div>
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Active social media' d='Shop.Theme.BecomeDealer'}</div>
              </div>
            </div>
            <div class="become_card_requirement">
              <div class="card_title">{l s='Activity' d='Shop.Theme.BecomeDealer'}</div>
              <div class="card_content">
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Aftermarket parts' d='Shop.Theme.BecomeDealer'}</div>
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Performance parts' d='Shop.Theme.BecomeDealer'}</div>
                <div class="card_content_option"><i class="fa-solid fa-check"></i>{l s='Tuning / building' d='Shop.Theme.BecomeDealer'}</div>
              </div>
            </div>
          </div>

          <div class="form-become-dealer" style="margin: 5rem 0;">
            <h1><span style="color: #0273EB;">></span> {l s='Fill out the become a dealer enquiry form' d='Shop.Theme.BecomeDealer'} <span style="color: #0273EB;"><</span></h1>
            
            <form action="/{$language.iso_code}/content/14-become-a-dealer" method="post" name="become_dealer_form" style="display:flex;flex-direction:column;">
              <input type="hidden" id="type" name="type" value="becomedealer" >
              <div class="form-row">
                <div class="form-group col-lg-2 col-md-4 col-sm-12 col-xs-12">
                  <label for="name">{l s='Name' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="name" name="name" required> 
                </div>
                <div class="form-group col-lg-2 col-md-4 col-sm-12 col-xs-12">
                  <label for="surname">{l s='Surname' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="surname" name="surname" required>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <label for="company">{l s='Company' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="company" name="company" required>
                </div>
                <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <label for="company_tva">{l s='VAT Number (if applicable)' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="company_tva" name="company_tva" required>
                </div>
              
                <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <label for="email">{l s='Email' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group col-lg-8 col-md-4 col-sm-12 col-xs-12">
                  <label for="adresse_line_1">{l s='Address' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="adresse_line_1"  name="adresse_line_1" required>
                </div>
              
                <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <label for="phone">{l s='Phone' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <input type="tel" class="form-control" id="phone"  name="phone" required>
                </div>
                <div class="form-group col-lg-8 col-md-4 col-sm-12 col-xs-12">
                  <label for="adresse_line_2">{l s='Address 2' d='Shop.Theme.FormBecomedealer'}</label>
                  <input type="text" class="form-control" id="adresse_line_2"  name="adresse_line_2" >
                </div>
              
                <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <label for="site">{l s='Website' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="site"  name="site" required>
                </div>
                <div class="form-group col-lg-6 col-md-4 col-sm-12 col-xs-12">
                  <label for="city">{l s='City' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="city" name="city" required>
                </div>
                <div class="form-group col-lg-2 col-md-4 col-sm-12 col-xs-12">
                  <label for="postal_code">{l s='Zip Code' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="postal_code" name="postal_code" required>
                </div>
              
                <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12">
                  <label for="social">{l s='Social Media Link' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <input type="text" class="form-control" id="social" name="social" required>
                </div>
                <div class="form-group col-lg-8 col-md-4 col-sm-12 col-xs-12">
                  <label for="country">{l s='Country' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></label>
                  <select id="country" class="form-control" name="country" required style="color: #000;">
                    <option selected>{l s='Please Select...' d='Shop.Theme.FormBecomedealer'}</option>
                    {foreach $countries as $country}
                      <option value="{$country['name']}">{substr($country["name"],0,24)}{(strlen($country["name"])>25)?'...':''}</option>
                    {/foreach}
                  </select>
                </div>
              </div>

            <div class="form-row">
              <div class="form-group col-lg-4 col-md-6 col-sm-12">
                <div class="title-suppliers">{l s='Business Type (Check all that apply)' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></div>
                <div class="col-sm-12 check-form" required>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck1" name="business_type[]" value="Storefront">
                    <label class="form-check-label" for="gridCheck1">
                      {l s='Storefront' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck2" name="business_type[]" value="Installer">
                    <label class="form-check-label" for="gridCheck2">
                    {l s='Installer' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck3" name="business_type[]" value="E-dealer">
                    <label class="form-check-label" for="gridCheck3">
                    {l s='E-dealer' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck4" name="business_type[]" value="Dyno Shop">
                    <label class="form-check-label" for="gridCheck4">
                    {l s='Dyno Shop' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck5" name="business_type[]" value="Market Place Seller">
                    <label class="form-check-label" for="gridCheck5">
                    {l s='Market Place Seller' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck6" name="business_type[]" value="Wholesaler">
                    <label class="form-check-label" for="gridCheck6">
                    {l s='Wholesaler' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck7" name="business_type[]" value="Other">
                    <label class="form-check-label" for="gridCheck7">
                    {l s='Other' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                </div>
              </div>
              <div class="form-group col-lg-2 col-md-6 col-sm-12 col-xs-12">
                <div class="title-suppliers">{l s='Main Market' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></div>
                <div class="col-sm-12 check-form">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck8" name="main_market[]" value="Euro">
                    <label class="form-check-label" for="gridCheck8">
                    {l s='Euro' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck9" name="main_market[]" value="JDM">
                    <label class="form-check-label" for="gridCheck9">
                    {l s='JDM' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck10" name="main_market[]" value="Muscle">
                    <label class="form-check-label" for="gridCheck10">
                    {l s='Muscle' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck11" name="main_market[]" value="Classics">
                    <label class="form-check-label" for="gridCheck11">
                    {l s='Classics' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck12" name="main_market[]" value="Offroad">
                    <label class="form-check-label" for="gridCheck12">
                    {l s='Offroad' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck13" name="main_market[]" value="Diesel">
                    <label class="form-check-label" for="gridCheck13">
                    {l s='Diesel' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="gridCheck14" name="main_market[]" value="Other">
                    <label class="form-check-label" for="gridCheck14">
                    {l s='Other' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  
                </div>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                <div class="title-suppliers">{l s='Annual sales volume' d='Shop.Theme.FormBecomedealer'}</div>
                <div class="col-sm-10 check-form">
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Under 100K" name="annual_sales[]" checked>
                    <label class="form-check-label" for="gridRadios1">
                    {l s='Under 100K€' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="100K to 500K€" name="annual_sales[]">
                    <label class="form-check-label" for="gridRadios2">
                    {l s='100K to 500K€' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios3" value="500K€ to 1M€" name="annual_sales[]">
                    <label class="form-check-label" for="gridRadios3">
                    {l s='500K€ to 1M€' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios4" value="1M€ +" name="annual_sales[]">
                    <label class="form-check-label" for="gridRadios4">
                    {l s='1M€ +' d='Shop.Theme.FormBecomedealer'}
                    </label>
                  </div>
                </div>
              </div>

              <div class="form-group col-lg-3 col-md-6 col-sm-12">
                  <div class="col-md-12 title-suppliers current_suplier">{l s='Main current suppliers' d='Shop.Theme.FormBecomedealer'}<span style="color: red;">*</span></div>
                  <div class="form-group col-md-12 current_suplier">
                    <input type="text" class="form-control" id="inputAddress2" placeholder="{l s='Current Supplier 1' d='Shop.Theme.FormBecomedealer'}" name="supplier_1" required>
                  </div>
                  <div class="form-group col-md-12 current_suplier">
                    <input type="text" class="form-control" id="inputAddress2" placeholder="{l s='Current Supplier 2' d='Shop.Theme.FormBecomedealer'}" name="supplier_2">
                  </div>
                  <div class="form-group col-md-12 current_suplier">
                    <input type="text" class="form-control" id="inputAddress2" placeholder="{l s='Current Supplier 3' d='Shop.Theme.FormBecomedealer'}" name="supplier_3">
                  </div>
              </div>
              </div>

            <div class="form-row col-lg-12" style="display: flex;flex-wrap:wrap;">
              <div class="form-group col-lg-4 col-md-6 col-sm-12">
                <label for="exampleFormControlTextarea1">{l s='Comment' d='Shop.Theme.FormBecomedealer'}</label>
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="observations"></textarea>
              </div>
              <div class="form-group col-lg-4 col-md-6 col-sm-12 signature">
                <div style="display: flex;align-items:center;justify-content:space-between;">
                  <label for="canvas4">{l s='Signature' d='Shop.Theme.FormBecomedealer'}</label>
                  <div class="btn" id="clearButton">{l s='Reset' d='Shop.Theme.FormBecomedealer'}</div>
                </div>
                <canvas id="canvas4" width=400 height=140></canvas>
              </div>
              <div class="form-group col-lg-4 col-md-6 col-sm-12 col-xs-12">
              
                <label for="important_notice" style="font-size: 16px;color: red;padding:0 10px;text-transform:uppercase;font-weight:400;line-height:22px;">{l s='Important notice:' d='Shop.Theme.FormBecomedealer'}</label>
                <div id="important_notice">
                {l s='By my signature, I certify the information I provided on and in connection with this form is true and correct to the best of my knowledge. I also understand that any false statements or deliberate omissions on this form may subject me to legal actions for fraudulent misrepresentation.' d='Shop.Theme.FormBecomedealer'}
                  
                </div>
              </div>
            
              <div class="form-group col-lg-12 col-md-6 col-sm-12" style="display: flex;justify-content:center;align-items:center;">
               <!--<button type="submit" class="btn btn-primary" onclick="validateForm()">{l s='Submit' d='Shop.Theme.FormBecomedealer'}</button>-->
              <button class="g-recaptcha btn btn-primary" 
                 name="submitMessage"
                 data-sitekey="6LdZXeoqAAAAAIjzGbbS_j_IgN8BrFxojdpbF3us" 
                 data-callback='validateForm' 
                 data-action='submit'>{l s='Submit' d='Shop.Theme.FormBecomedealer'}</button> 
              </div>
            </div>
            </form>
          </div>


        </div>
        <script src="/themes/probusiness/assets/js/signature_pad.umd.min.js"></script>
        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var signaturePad4 = new SignaturePad(document.querySelector("#canvas4"));

            document.getElementById('clearButton').addEventListener('click', function() {
                signaturePad4.clear();
            });
          

          });
        </script>
         <script>
         function updatedealerImage() {
           const dealerImage = document.querySelector(".banner_becomedealer");
           const screenWidth = window.screen.width;
           const languageCode = "{$language.iso_code}"; // Assuming this is available in your template

           if (screenWidth > 1140) {
            dealerImage.setAttribute("src", '/img/asd/dealers/headers/bdealer_{$language.iso_code}.webp');
            dealerImage.setAttribute("width", "1700");
            dealerImage.setAttribute("height", "7747");
           } else if (screenWidth > 575) {
             dealerImage.setAttribute("src", '/img/asd/dealers/headers/bdealer_{$language.iso_code}.webp');
             dealerImage.setAttribute("width", "575");
             dealerImage.setAttribute("height", "122");
           } else {
             dealerImage.setAttribute("src", '/img/asd/dealers/headers/bdealer_{$language.iso_code}.webp');
             dealerImage.setAttribute("width", "394");
             dealerImage.setAttribute("height", "90");
           }
         }
         updatedealerImage();
         // document.addEventListener("DOMContentLoaded", updateLegalImage);
         window.addEventListener("resize", updatedealerImage);
     </script>


      {else if  $cms.id === 15}


        <div id="cms_container_15">
          <div class="banner_supplier">
            <img class="desktop" src="/img/asd/dealers/headers/bsupplier_{$language.iso_code}.webp"  alt="banner become supplier" width="1350" height="300" />
            <img class="mobile p-img" src="/img/asd/dealers/headers/bsupplier_{$language.iso_code}.webp"  alt="banner become supplier" width="394" height="90" />
          </div>

          <p class="become_supplier_text">
          {l s='European leader in performance auto parts distribution, All Stars Distribution bets on long-term relationships with world-class suppliers.' d='Shop.Theme.Becomesupplier'} 
          <br>
          <br>
          {l s='In order to offer our customers the best products and services, we are extremely selective when choosing our suppliers or our products and intend to work only with manufacturers sharing our values and our ethic.' d='Shop.Theme.Becomesupplier'}
          </p>
          <div class="commitments_container">
            <h1 class="commitments ">{l s='> Our 4 key commitments <' d='Shop.Theme.Becomesupplier'}</h1>
          </div>
          <div class="become_cards">
            <div class="become_card_requirement">
              <div class="card_title">{l s='Communication' d='Shop.Theme.Becomesupplier'}</div>
              <div class="card_content">
                <div class="card-text">
                {l s='Key element of a business relationship, we attach great importance to the quality of our communication with our customers. The quick and clear transmission of informations is an asset that we must maintain and apply on a daily basis with our suppliers.' d='Shop.Theme.Becomesupplier'}
                </div>
              </div>
            </div>
            <div class="become_card_requirement">
              <div class="card_title">{l s='Technology' d='Shop.Theme.Becomesupplier'}</div>
              <div class="card_content">
                <div class="card-text">
                {l s='Management and control tools development is an extremely important part of our daily work, so we expect our suppliers to have the same interest and the same commitment to technological research and development.' d='Shop.Theme.Becomesupplier'}
                </div>
              </div>
            </div>
            <div class="become_card_requirement">
              <div class="card_title">{l s='Marketing' d='Shop.Theme.Becomesupplier'}</div>
              <div class="card_content">
                <div class="card-text">
                {l s='Investing big money and time in developing the visibility and the fame of the brands we distribute, we expect our suppliers to be part of our efforts, supporting our projects and being involved in their own brand promotion.' d='Shop.Theme.Becomesupplier'}
                </div>
              </div>
            </div>
            <div class="become_card_requirement">
              <div class="card_title">{l s='Deontology' d='Shop.Theme.Becomesupplier'}</div>
              <div class="card_content">
                <div class="card-text">
                {l s='In order to preserve a fair market for all players in the industry, All Stars Distribution has no relationship with marketplaces or gray market players. Above all, we want our suppliers to be partners and not competitors for our customers and therefore expect our suppliers to show the same respect for this ethics.' d='Shop.Theme.Becomesupplier'}
                </div>
              </div>
            </div>
          </div>


          <div class="form-become-supplier">
            <h1><span style="color: #0273EB;">></span> {l s='Submit an enquiry' d='Shop.Theme.Becomesupplier'} <span style="color: #0273EB;"><</span></h1>
            
            <form action="/{$language.iso_code}/content/15-become-a-supplier" method="post" name="become_dealer_form">
            <input type="hidden" id="type" name="type" value="becomesupplier">
              <div class="form-row">

                <div class="col-lg-6 col-md-12  col-sm-12 col-xs-12">
                    <div class="form-group col-md-6 col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="company">{l s='Company' d='Shop.Theme.FormBecomesupplier'}<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="company" required name="company">
                      </div>
                      <div class="form-group">
                        <label for="phone">{l s='Phone' d='Shop.Theme.FormBecomesupplier'}<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="phone" required name="phone">
                      </div>
                      <div class="form-group">
                        <label for="site">{l s='Website' d='Shop.Theme.FormBecomesupplier'}<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="site" name="site" required>
                      </div>
                      <div class="form-group">
                        <label for="social">{l s='Social media' d='Shop.Theme.FormBecomesupplier'}<span style="color: red;">*</span></label>
                        <input type="text" class="form-control" id="social" name="social" required>
                      </div>
                    </div>
                    <div class="form-group col-md-6  col-sm-12 col-xs-12">
                      <div class="form-group">
                        <label for="email">{l s='Email' d='Shop.Theme.FormBecomesupplier'}<span style="color: red;">*</span></label>
                        <input type="email" class="form-control" id="email" name="email" required>
                      </div>
                      <div class="form-group">
                        <label for="observations">{l s='Comment' d='Shop.Theme.FormBecomesupplier'}</label>
                        <textarea class="form-control" id="observations" rows="5" name="observations"></textarea>
                      </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12  col-sm-12 col-xs-12">
                  <div class="form-group col-md-12  col-sm-12 col-xs-12">
                    <label for="adresse_line_1">{l s='Address' d='Shop.Theme.FormBecomesupplier'}<span style="color: red;">*</span></label>
                    <input type="text" class="form-control" id="adresse_line_1" name="adresse_line_1" required>
                  </div>
                  <div class="form-group col-md-12  col-sm-12 col-xs-12">
                    <label for="adresse_line_2">{l s='Address line 2' d='Shop.Theme.FormBecomesupplier'}</label>
                    <input type="text" class="form-control" id="adresse_line_2" name="adresse_line_2">
                  </div>
                  <div class="form-group col-md-12  col-sm-12 col-xs-12 rm-b">
                    <div class="form-group col-md-8  col-sm-12 col-xs-12 city">
                      <label for="city">{l s='City' d='Shop.Theme.FormBecomesupplier'}<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" id="city" name="city" required>
                    </div>
                    <div class="form-group col-md-4  col-sm-12 col-xs-12 zip_code">
                      <label for="postal_code">{l s='Zip Code' d='Shop.Theme.FormBecomesupplier'}<span style="color: red;">*</span></label>
                      <input type="text" class="form-control" id="postal_code" required name="postal_code">
                    </div>
                  </div>
                  <div class="form-group col-md-12  col-sm-12 col-xs-12">
                    <label for="inputState">{l s='Country' d='Shop.Theme.FormBecomesupplier'}<span style="color: red;">*</span></label>
                    <select id="country" class="form-control" required name="country">
                      <option selected>{l s='Please Select...' d='Shop.Theme.FormBecomesupplier'}</option>
                      {foreach $countries as $country}
                        <option value="{$country['name']}">{substr($country["name"],0,24)}{(strlen($country["name"])>25)?'...':''}</option>
                      {/foreach}
                    </select>
                  </div>
                </div>
              </div>

            


              <div class="form-row">
                <div class="form-group col-md-12  col-sm-12 col-xs-12" style="display: flex;justify-content:center;">
                  <button type="submit" class="btn btn-primary">{l s='Submit' d='Shop.Theme.FormBecomesupplier'}</button>
                </div>
              </div>
            </form>
          </div>


        </div>
      {elseif $cms.id === 7}
        <div class="cms-privacy">
          <div class="privacy-banner">
            <img class="p-img" src="/img/asd/Content_pages/privacy/ppolicy_{$language.iso_code}.webp" alt="privacy_banner" width="1350" height="300"/>
          </div>
          <div class="privacy-content">
            {* <h1>{l s='Privacy policy' d='Shop.Theme.Privacy'}</h1> *}
            <p>{l s='We respect your privacy and are committed to protecting it through our compliance with this privacy policy (“Policy”). This Policy describes the types of information we may collect from you or that you may provide (“Personal Information”) on the all-stars-distribution.com website (“Website” or “Service”) and any of its related products and services (collectively, “Services”), and our practices for collecting, using, maintaining, protecting, and disclosing that Personal Information. It also describes the choices available to you regarding our use of your Personal Information and how you can access and update it.' d='Shop.Theme.Privacy'}</p>
            <p>{l s='This Policy is a legally binding agreement between you (“User”, “you” or “your”) and All Stars Distribution Lda (“All Stars Distribution Lda”, “we”, “us” or “our”). If you are entering into this agreement on behalf of a business or other legal entity, you represent that you have the authority to bind such entity to this agreement, in which case the terms “User”, “you” or “your” shall refer to such entity. If you do not have such authority, or if you do not agree with the terms of this agreement, you must not accept this agreement and may not access and use the Website and Services. By accessing and using the Website and Services, you acknowledge that you have read, understood, and agree to be bound by the terms of this Policy. This Policy does not apply to the practices of companies that we do not own or control, or to individuals that we do not employ or manage.' d='Shop.Theme.Privacy'}</p>
            <h2 class="table-contents">{l s='Table of contents' d='Shop.Theme.Privacy'}</h2>
            <ul class="contents-list">
                <li>  <a href="#Collection">{l s='Collection of personal information' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#children">{l s='Privacy of children' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#collected">{l s='Use and processing of collected information' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Payment"  onclick="anchorLink(this)">{l s='Payment processing' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Managing">{l s='Managing information' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Disclosure">{l s='Disclosure of information' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Retention">{l s='Retention of information' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Transfer">{l s='Transfer of information' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#protection">{l s='Data protection rights under the GDPR' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#rights">{l s='How to exercise your rights' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Cookies">{l s='Cookies' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#analytics">{l s='Data analytics' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#signals">{l s='Do Not Track signals' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Social">{l s='Social media features' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Email">{l s='Email marketing' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Links">{l s='Links to other resources' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Information">{l s='Information security' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Data-breach">{l s='Data breach' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Changes">{l s='Changes and amendments' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Acceptance">{l s='Acceptance of this policy' d='Shop.Theme.Privacy'}</a></li>
                <li>  <a href="#Contacting">{l s='Contacting us' d='Shop.Theme.Privacy'}</a></li>
            </ul>

            <h1 id="Collection">{l s='Collection of personal information' d='Shop.Theme.Privacy'}</h1>
            <p>{l s='You can access and use the Website and Services without telling us who you are or revealing any information by which someone could identify you as a specific, identifiable individual. If, however, you wish to use some of the features offered on the Website, you may be asked to provide certain Personal Information (for example, your name and e-mail address).' d='Shop.Theme.Privacy'}</p>

            <p>{l s='We receive and store any information you knowingly provide to us when you create an account, make a purchase, or fill any forms on the Website. When required, this information may include the following:' d='Shop.Theme.Privacy'}</p>

            <p>{l s='Account details (such as user name, unique user ID, password, etc)' d='Shop.Theme.Privacy'}<br>
              {l s='Contact information (such as email address, phone number, etc)' d='Shop.Theme.Privacy'}<br>
              {l s='Basic personal information (such as name, country of residence, etc)' d='Shop.Theme.Privacy'}<br>
              {l s='Payment information (such as credit card details, bank details, etc)' d='Shop.Theme.Privacy'}<br>

              {l s='You can choose not to provide us with your Personal Information, but then you may not be able to take advantage of some of the features on the Website. Users who are uncertain about what information is mandatory are welcome to contact us.' d='Shop.Theme.Privacy'}
              
            </p>

            <h1 id="children">{l s='Privacy of children' d='Shop.Theme.Privacy'}</h1>

            <p>{l s='We do not knowingly collect any Personal Information from children under the age of 18. If you are under the age of 18, please do not submit any Personal Information through the Website and Services. If you have reason to believe that a child under the age of 18 has provided Personal Information to us through the Website and Services, please contact us to request that we delete that child’s Personal Information from our Services.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='We encourage parents and legal guardians to monitor their children’s Internet usage and to help enforce this Policy by instructing their children never to provide Personal Information through the Website and Services without their permission. We also ask that all parents and legal guardians overseeing the care of children take the necessary precautions to ensure that their children are instructed to never give out Personal Information when online without their permission.' d='Shop.Theme.Privacy'}</p>

            <h1 id="collected">{l s='Use and processing of collected information' d='Shop.Theme.Privacy'}</h1>

            <p>{l s='We act as a data controller and a data processor in terms of the GDPR when handling Personal Information, unless we have entered into a data processing agreement with you in which case you would be the data controller and we would be the data processor.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='Our role may also differ depending on the specific situation involving Personal Information. We act in the capacity of a data controller when we ask you to submit your Personal Information that is necessary to ensure your access and use of the Website and Services. In such instances, we are a data controller because we determine the purposes and means of the processing of Personal Information and we comply with data controllers’ obligations set forth in the GDPR.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='We act in the capacity of a data processor in situations when you submit Personal Information through the Website and Services. We do not own, control, or make decisions about the submitted Personal Information, and such Personal Information is processed only in accordance with your instructions. In such instances, the User providing Personal Information acts as a data controller in terms of the GDPR.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='In order to make the Website and Services available to you, or to meet a legal obligation, we may need to collect and use certain Personal Information. If you do not provide the information that we request, we may not be able to provide you with the requested products or services. Any of the information we collect from you may be used for the following purposes:' d='Shop.Theme.Privacy'}</p><br>
            <ul style="padding-left: 1rem;">
              <li>
              <p>- {l s='Create and manage user accounts' d='Shop.Theme.Privacy'}</p>
              </li>
              <li>
              <p>- {l s='Fulfill and manage orders' d='Shop.Theme.Privacy'}</p>
              </li>
              <li>
              <p>- {l s='Deliver products or services' d='Shop.Theme.Privacy'}</p>
              </li>
              <li>
              <p>- {l s='Respond to inquiries and offer support' d='Shop.Theme.Privacy'}</p>
              </li>
              <li>
              <p>- {l s='Run and operate the Website and Services' d='Shop.Theme.Privacy'}</p>
              </li>
            </ul>
            <br>
            <p>{l s='Processing your Personal Information depends on how you interact with the Website and Services, where you are located in the world and if one of the following applies: (i) you have given your consent for one or more specific purposes; this, however, does not apply, whenever the processing of Personal Information is subject to European data protection law; (ii) provision of information is necessary for the performance of an agreement with you and/or for any pre-contractual obligations thereof; (iii) processing is necessary for compliance with a legal obligation to which you are subject; (iv) processing is related to a task that is carried out in the public interest or in the exercise of official authority vested in us; (v) processing is necessary for the purposes of the legitimate interests pursued by us or by a third party.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='We rely on user’s consent as a legal base as defined in the GDPR upon which we collect and process your Personal Information.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='Note that under some legislations we may be allowed to process information until you object to such processing by opting out, without having to rely on consent or any other of the legal bases above. In any case, we will be happy to clarify the specific legal basis that applies to the processing, and in particular whether the provision of Personal Information is a statutory or contractual requirement, or a requirement necessary to enter into a contract.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Payment">{l s='Payment processing' d='Shop.Theme.Privacy'}</h1>

            <p>{l s='In case of Services requiring payment, you may need to provide your credit card details or other payment account information, which will be used solely for processing payments. We use third-party payment processors (“Payment Processors”) to assist us in processing your payment information securely.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='Payment Processors adhere to the latest security standards as managed by the PCI Security Standards Council, which is a joint effort of brands like Visa, MasterCard, American Express and Discover. Sensitive and private data exchange happens over a SSL secured communication channel and is encrypted and protected with digital signatures, and the Website and Services are also in compliance with strict vulnerability standards in order to create as secure of an environment as possible for Users. We will share payment data with the Payment Processors only to the extent necessary for the purposes of processing your payments, refunding such payments, and dealing with complaints and queries related to such payments and refunds.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='Please note that the Payment Processors may collect some Personal Information from you, which allows them to process your payments (e.g., your email address, address, credit card details, and bank account number) and handle all the steps in the payment process through their systems, including data collection and data processing. The Payment Processors’ use of your Personal Information is governed by their respective privacy policies which may or may not contain privacy protections as protective as this Policy. We suggest that you review their respective privacy policies.' d='Shop.Theme.Privacy'}</p>
            
            
            <h1 id="Managing">{l s='Managing information' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='You are able to delete certain Personal Information we have about you. The Personal Information you can delete may change as the Website and Services change. When you delete Personal Information, however, we may maintain a copy of the unrevised Personal Information in our records for the duration necessary to comply with our obligations to our affiliates and partners, and for the purposes described below. If you would like to delete your Personal Information or permanently delete your account, you can do so on the settings page of your account on the Website or simply by contacting us.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Disclosure">{l s='Disclosure of information' d='Shop.Theme.Privacy'}</h1>
            

            <p>{l s='Depending on the requested Services or as necessary to complete any transaction or provide any Service you have requested, we may share your information with our affiliates, contracted companies, and service providers (collectively, “Service Providers”) we rely upon to assist in the operation of the Website and Services available to you and whose privacy policies are consistent with ours or who agree to abide by our policies with respect to Personal Information. We will not share any personally identifiable information with third parties and will not share any information with unaffiliated third parties.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='Service Providers are not authorized to use or disclose your information except as necessary to perform services on our behalf or comply with legal requirements. Service Providers are given the information they need only in order to perform their designated functions, and we do not authorize them to use or disclose any of the provided information for their own marketing or other purposes.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Retention">{l s='Retention of information' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='We will retain and use your Personal Information for the period necessary as long as your user account remains active, to enforce our agreements, resolve disputes, and unless a longer retention period is required or permitted by law.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='We may use any aggregated data derived from or incorporating your Personal Information after you update or delete it, but not in a manner that would identify you personally. Once the retention period expires, Personal Information shall be deleted. Therefore, the right to access, the right to erasure, the right to rectification, and the right to data portability cannot be enforced after the expiration of the retention period.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Transfer">{l s='Transfer of information' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='Depending on your location, data transfers may involve transferring and storing your information in a country other than your own. However, this will not include countries outside the European Union and European Economic Area. If any such transfer takes place, you can find out more by checking the relevant sections of this Policy or inquire with us using the information provided in the contact section.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="protection">{l s='Data protection rights under the GDPR' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='If you are a resident of the European Economic Area (“EEA”), you have certain data protection rights and we aim to take reasonable steps to allow you to correct, amend, delete, or limit the use of your Personal Information. If you wish to be informed what Personal Information we hold about you and if you want it to be removed from our systems, please contact us. In certain circumstances, you have the following data protection rights:' d='Shop.Theme.Privacy'}</p>

            <p>{l s='(i) You have the right to withdraw consent where you have previously given your consent to the processing of your Personal Information. To the extent that the legal basis for our processing of your Personal Information is consent, you have the right to withdraw that consent at any time. Withdrawal will not affect the lawfulness of processing before the withdrawal.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='(ii) You have the right to learn if your Personal Information is being processed by us, obtain disclosure regarding certain aspects of the processing, and obtain a copy of your Personal Information undergoing processing.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='(iii) You have the right to verify the accuracy of your information and ask for it to be updated or corrected. You also have the right to request us to complete the Personal Information you believe is incomplete.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='(iv) You have the right to object to the processing of your information if the processing is carried out on a legal basis other than consent. Where Personal Information is processed for the public interest, in the exercise of an official authority vested in us, or for the purposes of the legitimate interests pursued by us, you may object to such processing by providing a ground related to your particular situation to justify the objection.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='(v) You have the right, under certain circumstances, to restrict the processing of your Personal Information. These circumstances include: the accuracy of your Personal Information is contested by you and we must verify its accuracy; the processing is unlawful, but you oppose the erasure of your Personal Information and request the restriction of its use instead; we no longer need your Personal Information for the purposes of processing, but you require it to establish, exercise or defend your legal claims; you have objected to processing pending the verification of whether our legitimate grounds override your legitimate grounds. Where processing has been restricted, such Personal Information will be marked accordingly and, with the exception of storage, will be processed only with your consent or for the establishment, to exercise or defense of legal claims, for the protection of the rights of another natural, or legal person or for reasons of important public interest.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='(vi) You have the right, under certain circumstances, to obtain the erasure of your Personal Information from us. These circumstances include: the Personal Information is no longer necessary in relation to the purposes for which it was collected or otherwise processed; you withdraw consent to consent-based processing; you object to the processing under certain rules of applicable data protection law; the processing is for direct marketing purposes; and the personal data have been unlawfully processed. However, there are exclusions of the right to erasure such as where processing is necessary: for exercising the right of freedom of expression and information; for compliance with a legal obligation; or for the establishment, to exercise or defense of legal claims.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='(vii) You have the right to receive your Personal Information that you have provided to us in a structured, commonly used, and machine-readable format and, if technically feasible, to have it transmitted to another controller without any hindrance from us, provided that such transmission does not adversely affect the rights and freedoms of others.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='(viii) You have the right to complain to a data protection authority about our collection and use of your Personal Information. If you are not satisfied with the outcome of your complaint directly with us, you have the right to lodge a complaint with your local data protection authority. For more information, please contact your local data protection authority in the EEA. This provision is applicable provided that your Personal Information is processed by automated means and that the processing is based on your consent, on a contract which you are part of, or on pre-contractual obligations thereof.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="rights">{l s='How to exercise your rights' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='Any requests to exercise your rights can be directed to us through the contact details provided in this document. Please note that we may ask you to verify your identity before responding to such requests. Your request must provide sufficient information that allows us to verify that you are the person you are claiming to be or that you are the authorized representative of such person. If we receive your request from an authorized representative, we may request evidence that you have provided such an authorized representative with power of attorney or that the authorized representative otherwise has valid written authority to submit requests on your behalf.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='You must include sufficient details to allow us to properly understand the request and respond to it. We cannot respond to your request or provide you with Personal Information unless we first verify your identity or authority to make such a request and confirm that the Personal Information relates to you.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Cookies">{l s='Cookies' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='Our Website and Services use “cookies” to help personalize your online experience. A cookie is a text file that is placed on your hard disk by a web page server. Cookies cannot be used to run programs or deliver viruses to your computer. Cookies are uniquely assigned to you, and can only be read by a web server in the domain that issued the cookie to you. If you choose to decline cookies, you may not be able to fully experience the features of the Website and Services.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='We may use cookies to collect, store, and track information for security and personalization, to operate the Website and Services, and for statistical purposes. Please note that you have the ability to accept or decline cookies. Most web browsers automatically accept cookies by default, but you can modify your browser settings to decline cookies if you prefer.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="analytics">{l s='Data analytics' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='Our Website and Services may use third-party analytics tools that use cookies, web beacons, or other similar information-gathering technologies to collect standard internet activity and usage information. The information gathered is used to compile statistical reports on User activity such as how often Users visit our Website and Services, what pages they visit and for how long, etc. We use the information obtained from these analytics tools to monitor the performance and improve our Website and Services. We do not use third-party analytics tools to track or to collect any personally identifiable information of our Users and we will not associate any information gathered from the statistical reports with any individual User.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="signals">{l s='Do Not Track signals' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='Some browsers incorporate a Do Not Track feature that signals to websites you visit that you do not want to have your online activity tracked. Tracking is not the same as using or collecting information in connection with a website. For these purposes, tracking refers to collecting personally identifiable information from consumers who use or visit a website or online service as they move across different websites over time. How browsers communicate the Do Not Track signal is not yet uniform. As a result, the Website and Services are not yet set up to interpret or respond to Do Not Track signals communicated by your browser. Even so, as described in more detail throughout this Policy, we limit our use and collection of your Personal Information.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Social">{l s='Social media features' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='Our Website and Services may include social media features, such as the Facebook and Twitter buttons, Share This buttons, etc (collectively, “Social Media Features”). These Social Media Features may collect your IP address, what page you are visiting on our Website and Services, and may set a cookie to enable Social Media Features to function properly. Social Media Features are hosted either by their respective providers or directly on our Website and Services. Your interactions with these Social Media Features are governed by the privacy policy of their respective providers.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Email">{l s='Email marketing' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='We offer electronic newsletters to which you may voluntarily subscribe at any time. We are committed to keeping your e-mail address confidential and will not disclose your email address to any third parties except as allowed in the information use and processing section. We will maintain the information sent via e-mail in accordance with applicable laws and regulations.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='In compliance with the CAN-SPAM Act, all e-mails sent from us will clearly state who the e-mail is from and provide clear information on how to contact the sender. You may choose to stop receiving our newsletter or marketing emails by following the unsubscribe instructions included in these emails or by contacting us. However, you will continue to receive essential transactional emails.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Links">{l s='Links to other resources' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='The Website and Services contain links to other resources that are not owned or controlled by us. Please be aware that we are not responsible for the privacy practices of such other resources or third parties. We encourage you to be aware when you leave the Website and Services and to read the privacy statements of each and every resource that may collect Personal Information.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Information">{l s='Information security' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='We secure information you provide on computer servers in a controlled, secure environment, protected from unauthorized access, use, or disclosure. We maintain reasonable administrative, technical, and physical safeguards in an effort to protect against unauthorized access, use, modification, and disclosure of Personal Information in our control and custody. However, no data transmission over the Internet or wireless network can be guaranteed.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='Therefore, while we strive to protect your Personal Information, you acknowledge that (i) there are security and privacy limitations of the Internet which are beyond our control; (ii) the security, integrity, and privacy of any and all information and data exchanged between you and the Website and Services cannot be guaranteed; and (iii) any such information and data may be viewed or tampered with in transit by a third party, despite best efforts.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='As the security of Personal Information depends in part on the security of the device you use to communicate with us and the security you use to protect your credentials, please take appropriate measures to protect this information.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Data-breach">{l s='Data breach' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='In the event we become aware that the security of the Website and Services has been compromised or Users’ Personal Information has been disclosed to unrelated third parties as a result of external activity, including, but not limited to, security attacks or fraud, we reserve the right to take reasonably appropriate measures, including, but not limited to, investigation and reporting, as well as notification to and cooperation with law enforcement authorities. In the event of a data breach, we will make reasonable efforts to notify affected individuals if we believe that there is a reasonable risk of harm to the User as a result of the breach or if notice is otherwise required by law. When we do, we will post a notice on the Website, send you an email.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Changes">{l s='Changes and amendments' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='We reserve the right to modify this Policy or its terms related to the Website and Services at any time at our discretion. When we do, we will post a notification on the main page of the Website. We may also provide notice to you in other ways at our discretion, such as through the contact information you have provided.' d='Shop.Theme.Privacy'}</p>

            <p>{l s='An updated version of this Policy will be effective immediately upon the posting of the revised Policy unless otherwise specified. Your continued use of the Website and Services after the effective date of the revised Policy (or such other act specified at that time) will constitute your consent to those changes. However, we will not, without your consent, use your Personal Information in a manner materially different than what was stated at the time your Personal Information was collected.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Acceptance">{l s='Acceptance of this policy' d='Shop.Theme.Privacy'}</h1>
            
            <p>{l s='You acknowledge that you have read this Policy and agree to all its terms and conditions. By accessing and using the Website and Services and submitting your information you agree to be bound by this Policy. If you do not agree to abide by the terms of this Policy, you are not authorized to access or use the Website and Services.' d='Shop.Theme.Privacy'}</p>
            
            <h1 id="Contacting">{l s='Contacting us' d='Shop.Theme.Privacy'}</h1>

            <p>{l s='If you have any other questions, concerns, or complaints regarding this Policy, we encourage you to contact us using the details below:' d='Shop.Theme.Privacy'}</p>

            <a href="mailto:sales@all-stars-distribution.com">sales@all-stars-distribution.com</a>
            <br>
            <br>
            <p>{l s='We will attempt to resolve complaints and disputes and make every reasonable effort to honor your wish to exercise your rights as quickly as possible and in any event, within the timescales provided by applicable data protection laws.' d='Shop.Theme.Privacy'}</p>

            <p style="text-align: center;">{l s='This document was last updated on June, 2024' d='Shop.Theme.Privacy'}</p>

          </div>
        </div>
      {elseif $cms.id === 10}
        <div class="cms-legal">
          <div class="legal-banner">
            <img class="legal_image p-img" src="" alt="legal image" />
          </div>
          <div class="legal-content col-lg-12" style="max-width: 1350px;">
            <div class="legal-company col-lg-6 col-md-12">
              <div class="line-info">
                <strong>{l s='VAT Number / License:' d="Shop.Theme.LegalNotice"}</strong>
                <span>{l s='PT / 513881387' d="Shop.Theme.LegalNotice"}</span>
              </div>
              {* <div class="line-info">
                <strong>{l s='License Number:' d="Shop.Theme.LegalNotice"}</strong>
                <span>94 166 410</span>
              </div> *}
              <div class="line-info">
                <strong>{l s='Company:' d="Shop.Theme.LegalNotice"}</strong>
                <span>{l s='All Stars Distribution, Lda' d="Shop.Theme.LegalNotice"}</span>
              </div>
              <div class="line-info" style="display: flex;gap:0.25rem;">
                <div>
                  <strong>{l s='Address:' d="Shop.Theme.LegalNotice"}</strong>
                </div>
                <div>
                  <span>{l s='Zona Industrial de Gandra SN' d="Shop.Theme.LegalNotice"}</span>
                  <br>
                  <span>{l s='Gandra Valença' d="Shop.Theme.LegalNotice"}</span>
                  <br>
                  <span>4930-311 Gandra VLN</span>
                </div>
              </div>
              
            </div>
            <div class="legal-server col-lg-6 col-md-12">
              <div class="line-info">
                <strong>{l s='Website:' d="Shop.Theme.LegalNotice"}</strong>
                <span>{l s='www.all-stars-distribution.com' d="Shop.Theme.LegalNotice"}</span>
              </div>
              <div class="line-info">
                <strong>{l s='Managed by:' d="Shop.Theme.LegalNotice"}</strong>
                <span>{l s='All Stars Web Solutions' d="Shop.Theme.LegalNotice"}</span>
              </div>
              <div class="line-info" style="display: flex;gap:0.25rem;">
                <div>
                  <strong>{l s='Address:' d="Shop.Theme.LegalNotice"}</strong>
                </div>
                <div>
                  <span>{l s='Lugar de tuido, 4930-327 Valença' d="Shop.Theme.LegalNotice"}</span>
                </div>
              </div>
              <div class="line-info">
                <strong>{l s='Hosted by:' d="Shop.Theme.LegalNotice"}</strong>
                <span>{l s='WebSP, Lda' d="Shop.Theme.LegalNotice"}</span>
              </div>
            </div>
            <div class="legal-contact col-lg-12 col-md-12">
              <div class="line-info">
                <strong>{l s='Contact:' d="Shop.Theme.LegalNotice"}</strong>
              </div>
              <div class="line-info">
                <div style="display: flex;align-items:center;gap:0.25rem;">
                  <i class="fa-solid fa-envelope" style="font-size:22px;"></i>
                  <span><a href="mailto:sales@all-stars-distribution.com">{l s='sales@all-stars-distribution.com' d="Shop.Theme.LegalNotice"}</a></span>
                </div>
              </div>
              <div class="line-info">
                <div style="display: flex;align-items:center;gap:0.25rem;">
                  <i class="fa-solid fa-phone" style="font-size:22px;"></i>
                  <span><a href="tel:00351 251 096 251">{l s='00351 251 096 251' d="Shop.Theme.LegalNotice"}</a></span>
                </div>
              </div>

            </div>
            <div class="legal-info col-lg-12 col-md-12">
              <div class="line-info">
                <span>{l s='This website uses cookies for optimal performance and traffic analyze.' d="Shop.Theme.LegalNotice"}</span>
                </div>
              <div class="line-info">
                <span>{l s='We do not share information about our website use with any third company.' d="Shop.Theme.LegalNotice"}</span>
              </div>

            </div>
            <div class="legal-devices col-lg-12 col-md-12">
              <img class="devices_img" src="" alt="image devices"/>
            </div>
            <div class="legal-copyright col-lg-12 col-md-12">
              <div class="line-info">
                <span>{l s='Copyright 2024 : All Stars Distribution - All Rights Reserved' d="Shop.Theme.LegalNotice"}</span>
              </div> 
            </div>
          </div>
        </div>
        <style>
        .cms-legal .legal-banner {
          position: relative;
          width: 100%; /* Ensuring the banner takes full width */
        }
        .cms-legal .legal-banner .legal_image {
          display: block;
          width: 100%;
          height: auto;
          max-width: 1350px; /* Maximum width of the largest image */
          margin: 0 auto; /* Centering the image */
        }

        .legal-content{
          padding: 3rem 0 2rem 0;
          color: #000;
          text-align: left;
        }

        .legal-content img {
          width: 100%;
          height: auto;
        }

        .legal-content strong{
          font-weight: 700;
          font-size: 18px;
          line-height: 25px;
        }
        .legal-content span{
          font-weight: 400;
          font-size: 16px;
          line-height: 25px;
        }

        .legal-company{
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
        }
        .legal-server{
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
        }

        .legal-contact{
          display: flex;
          flex-direction: column;
          align-items: center;
          justify-content: center;
          padding:  3rem 0 2rem 0;
        }

        .legal-contact .line-info{
          display: flex;
          justify-content: center;
        }
        .legal-contact a{
          font-size: 18px;
        }

        .legal-contact a:hover{
          color: #0273EB;
          text-decoration: underline;
        }

        .legal-info{
          padding: 1rem 0 2rem 0;
          display: flex;
          flex-direction: column;
          text-align: center;
        }

        .legal-info .line-info{
          text-align: center;
          max-width: unset;
        }

        .legal-copyright{
          padding: 3rem 0 2rem 0;
          font-size: 16px;
        }

        .legal-copyright .line-info {
          max-width: unset;
          text-align: center;
        }

        .line-info{
          max-width: 60%;
          width: 100%;
        }

        @media screen and (max-width:1340px){
          .line-info{
            max-width: 60%;
            width: 100%;
          }
        }
        @media screen and (max-width:1168px){
          .line-info{
            max-width: 80%;
            width: 100%;
          }
        }
        @media screen and (max-width:992px){
          .legal-content{
            max-width: 100vw;
            display: flex;
            flex-direction: column;
            gap: 2rem;
            padding: 2rem;
          }

          .line-info{
            max-width: 323px;
            width: 100%;
          }
        }

        @media screen and (max-width:400px){
          .legal-content{
            padding: 2rem 1rem;
          }

          .line-info{
            max-width: 323px;
            width: 100%;
          }

          .legal-info{
            gap: 1rem;
          }
        }


      </style>
        <script>
            function updateLegalImage() {
              const legalImage = document.querySelector(".legal_image");
              const legalDevicesImage = document.querySelector(".devices_img");
              const screenWidth = window.screen.width;

              if (screenWidth > 1140) {
                legalImage.setAttribute("src", '/img/asd/Content_pages/legal/legnotice_{$language.iso_code}.webp');
                legalImage.setAttribute("width", "1350");
                legalImage.setAttribute("height", "300");
                legalDevicesImage.setAttribute("src", '/img/asd/Content_pages/legal/dispositivos_lg.webp');
                legalDevicesImage.setAttribute("width", "1350");
                legalDevicesImage.setAttribute("height", "301");
              } else if (screenWidth > 575) {
                legalImage.setAttribute("src", '/img/asd/Content_pages/legal/legnotice_{$language.iso_code}.webp');
                legalImage.setAttribute("width", "1140");
                legalImage.setAttribute("height", "253");
                legalDevicesImage.setAttribute("src", '/img/asd/Content_pages/legal/dispositivos_md.webp');
                legalDevicesImage.setAttribute("width", "1350");
                legalDevicesImage.setAttribute("height", "254");
              } else {
                legalImage.setAttribute("src", '/img/asd/Content_pages/legal/legnotice_{$language.iso_code}.webp');
                legalImage.setAttribute("width", "575");
                legalImage.setAttribute("height", "128");
                legalDevicesImage.setAttribute("src", '/img/asd/Content_pages/legal/dispositivos_xs.webp');
                legalDevicesImage.setAttribute("width", "1350");
                legalDevicesImage.setAttribute("height", "226");
              }
            }
            updateLegalImage();
            // document.addEventListener("DOMContentLoaded", updateLegalImage);
            window.addEventListener("resize", updateLegalImage);
        </script>
      {elseif $cms.id === 9}
        
        <div class="banner_cms_partners" style="margin-bottom: 3rem;">
          <div class="partners-banner">
            <img class="p-img" src="/img/asd/Content_pages/partners/partners_{$language.iso_code}.webp" alt="banner partners" width="1350" height="300" />
          </div>
          <div class="rte">
            <div id="cms-partners">
            <div class="spacer-20"></div>
            <div class="row cards">

            {* dpd *}
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
              <div class="card_partners">
              <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/dpd_logo.jpg" alt="dpd_logo"  width="300" height="240"/></div>
              <div class="text_partners">{l s='DPD group is the largest parcel delivery network in Europe, carrying worldwide about 5.3 million parcels daily via 77000 workers through their 4 different brands DPD, Chronopost, SEUR and BRT.' d='Shop.Theme.Partners'}​</div>
              <div class="button_container_partners"><a href="https://www.dpd.com" target="_blank" class="button_partners" rel="noreferrer noopener">{l s='Website' d='Shop.Theme.Partners'}</a></div>
              </div>
              </div>

              {* ups *}
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
              <div class="card_partners">
              <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/ups_logo.jpg" alt="ups_logo.jpg?v=1" width="300" height="240" /></div>
              <div class="text_partners">{l s='UPS' d='Shop.Theme.Partners'}</div>
              <div class="button_container_partners"><a href="https://www.ups.com" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'}</a></div>
              </div>
              </div>

              {* nacex *}
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
              <div class="card_partners">
              <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/nacex_logo.jpg" alt="nacex_logo" width="300" height="240" /></div>
              <div class="text_partners">{l s='Since it was set up in 1995, NACEX, part of Grupo Logista, has specialised in providing express courier services for parcels and documents sent between businesses (B2B) and individuals (B2C) and offers a wide range of national, international and value-added services that cover the most demanding delivery requirements in the market.
              NACEX has consolidated an exclusive franchise network in Spain, Portugal, Andorra and Benelux that guarantees full geographical coverage, thanks to latest-generation technological tools that allow, among other things, real-time shipment monitoring, and thanks to industry-leading customer communication systems.
              ' d='Shop.Theme.Partners'}</div>
              <div class="button_container_partners"><a href="https://www.nacex.com" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'}</a></div>
              </div>
              </div>

              {* maersk *}
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
            <div class="card_partners">
                <div class="image_container_partners">
                  <img class="image_partners" src="/img/asd/Content_pages/partners/maersk_logo.jpg" alt="maersk_logo" loading="lazy" width="300" height="240" />
                </div>
                <div class="text_partners">
                {l s="A.P. Møller-Mærsk, also known simply as Maersk is a Danish shipping and logistics company founded in 1904 by Arnold Peter Møller and Peter Mærsk Møller. Maersk's business activities include shipping, port operation, supply chain management and warehousing. The company is based in Copenhagen, Denmark, with subsidiaries and offices across 130 countries and 108.000 employees worldwide." d='Shop.Theme.Partners'}
                </div>
                <div class="button_container_partners">
                  <a href="https://www.maersk.com" target="_blank" class="button_partners" rel="noreferrer noopener">{l s='Website' d='Shop.Theme.Partners'}</a>
                </div>
              </div>
            </div>

              {* transcar *}
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
              <div class="card_partners">
                <div class="image_container_partners">
                  <img class="image_partners" src="/img/asd/Content_pages/partners/transcar_logo.jpg" alt="transcar_logo.jpg?v=1"  loading="lazy" width="300" height="240" />
                </div>
                <div class="text_partners">
                  {l s='Vehicles transport specialist, TrancarPremium uses state-of-the-art logistics tools, allowing the team to offer unparalleled quality of service and great management flexibility. Based in Portugal, the company offers different premium solutions for shipping supercars, racing cars, classics or exotics throughout Europe.' d='Shop.Theme.Partners'}
                </div>
                <div class="button_container_partners">
                  <a href="https://transcarpremium.com/" target="_blank" class="button_partners" rel="noreferrer noopener">{l s='Website' d='Shop.Theme.Partners'}</a>
                </div>
              </div>
              </div>

            {* ingenico *}
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
            <div class="card_partners">
            <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/ingenico_logo.jpg" alt="ingenico"  loading="lazy" width="300" height="240" /></div>
            <div class="text_partners">{l s='Ingenico is a France-based company, whose business is to provide the technology involved in secure electronic transactions. Its traditional business is based on the manufacture of point of sale (POS) payment terminals, but it also includes complete payment software and related services, also software for merchants.' d='Shop.Theme.Partners'}</div>
            <div class="button_container_partners"><a href="https://ingenico.com" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'}</a></div>
            </div>
            </div>

            {* Millenium *}
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
            <div class="card_partners">
            <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/bcp_logo.jpg" alt="bcp_logo.jpg?v=1"  loading="lazy" width="300" height="240" /></div>
            <div class="text_partners">{l s='Banco Comercial Português (BCP) is a Portuguese bank, member of the PSI-20 index and the Next 150. It is present in Portugal as Millenium BCP and in Belgium and Luxembourg as Banque BCP. It is also present in other countries and is listed on the Euronext stock exchange. Banque BCP was born in 2001 from the merger of the French branches of the oldest Portuguese financial establishments.' d='Shop.Theme.Partners'}</div>
            <div class="button_container_partners"><a href="https://www.millenniumbcp.pt/" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'} </a></div>
            </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
            <div class="card_partners">
            <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/adobe_logo.webp" alt="adobe_logo.jpg?v=1" loading="lazy" width="300" height="240"  /></div>
            <div class="text_partners">{l s='Adobe Inc is an American multinational computer software company focused upon the creation on multimedia and creativity software products, with a more recent foray into digital marketing software. Adobe is best known for its Adobe Flash web software, Photoshop image editing software, Adobe Illustrator graphics editor and Acrobat Reader.' d='Shop.Theme.Partners'}</div>
            <div class="button_container_partners"><a href="https://www.adobe.com/" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'}</a></div>
            </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
            <div class="card_partners">
            <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/smurfit_logo.webp" alt="smurfit_logo"  loading="lazy" width="300" height="240" /></div>
            <div class="text_partners">{l s='Smurfit Kappa' d='Shop.Theme.Partners'}</div>
            <div class="button_container_partners"><a href="https://www.smurfitkappa.com/" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'}</a></div>
            </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
            <div class="card_partners">
            <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/sonic_logo.webp" alt="sonic_logo" loading="lazy" width="300" height="240"  /></div>
            <div class="text_partners">{l s='Sonic Tools' d='Shop.Theme.Partners'}</div>
            <div class="button_container_partners"><a href="https://sonictoolsusa.com/" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'}</a></div>
            </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
              <div class="card_partners">
                <div class="image_container_partners">
                  <img class="image_partners" src="/img/asd/Content_pages/partners/norton_logo.jpg" alt="dpd_logo.jpg?v=1"  loading="lazy" width="300" height="240" />
                </div>
                <div class="text_partners">
                  {l s="Norton or Norton by Symantec, is a division of NortonLifeLock based in California and offering a variety of products and services related to digital security. In 2014, it was announced that Norton's parent company Symantec would split its business into two units - one focused on security, and one focused on information management, with Norton being placed in the unit focused on security." d='Shop.Theme.Partners'}
                </div>
                <div class="button_container_partners">
                  <a href="https://norton.com" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'}</a>
                </div>
              </div>
            </div>

            

            
              

              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
              <div class="card_partners">
              <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/asw_logo.webp" alt="allstars_web_logo.jpg?v=1"  loading="lazy" width="300" height="240" /></div>
              <div class="text_partners">{l s='All Stars Web Solutions is a top range web agency specializing in website design and development, software and application creation, digital marketing, and SEO. Offering the latest technologies IT tools for warehouse management (ERP), cybersecurity, front and back end with optimal ergonomics, they make the management of a website accessible to everyone.' d='Shop.Theme.Partners'}</div>
              <div class="button_container_partners"><a href="https://www.allstars-web.com" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'} </a></div>
              </div>
              </div>

            

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
            <div class="card_partners">
            <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/digi_logo.jpg" alt="digi_logo.jpg?v=1" loading="lazy" width="300" height="240"  /></div>
            <div class="text_partners">{l s='Since 2003, the company DIGISERVICES is a reliable supplier of high quality and customized tuning software files. French leader with more than 30 auto centers in France, more than 6000 vehicles visit their workshops each year.' d='Shop.Theme.Partners'}</div>
            <div class="button_container_partners"><a href="https://www.digiservices.fr/" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'} </a></div>
            </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
            <div class="card_partners">
            <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/shiftech_logo.webp" alt="shiftech_logo.jpg?v=1" loading="lazy" width="300" height="240"  /></div>
            <div class="text_partners">{l s='Since 2008, ShifTech has been a specialist in custom tuning software that offers the perfect combination of increased engine power and more economical fuel consumption. Present in France, Belgium and Luxembourg, it is a reference in the market due to its quality of service and its experience.' d='Shop.Theme.Partners'}</div>
            <div class="button_container_partners"><a href="https://www.shiftech.eu" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'} </a></div>
            </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
            <div class="card_partners">
            <div class="image_container_partners"><img class="image_partners" src="/img/asd/Content_pages/partners/brperformance_logo.webp" alt="alma_logo.jpg?v=1"  loading="lazy" width="300" height="240" /></div>
            <div class="text_partners">{l s='Key partner of the biggest brands in the performance automotive industry, BR-Performance is a key player in the custom tuning software market thanks to solid knowledges and state-of-the-art equipment.' d='Shop.Theme.Partners'}</div>
            <div class="button_container_partners"><a href="https://www.br-performance.fr" target="_blank" class="button_partners" rel="noreferrer noopener"> {l s='Website' d='Shop.Theme.Partners'} </a></div>
            </div>
            </div>

            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 p-3">
              <div class="card_partners">
                <div class="image_container_partners">
                  <img class="image_partners" src="/img/asd/Content_pages/partners/asm_logo.webp" alt="asm_logo"  loading="lazy" width="300" height="240" />
                </div>
                <div class="text_partners">
                {l s='European platform, founded in 2013 and established in 3 countries, All Stars Motorsport has quickly become a key player in aftermarket automotive performance and design industry. Reseller of the most famous brands, All Stars Motorsport offers the best products at the best prices to allow to offer everyone their own vision of the automobile.' d='Shop.Theme.Partners'}
                </div>
                <div class="button_container_partners">
                  <a href="https://www.all-stars-motorsport.com" target="_blank" class="button_partners" rel="noreferrer noopener">{l s='Website' d='Shop.Theme.Partners'}</a>
                </div>
              </div>
            </div>

            


            </div>
            <div class="spacer-20"></div>
          </div>
        </div>

      {elseif $cms.id === 11}
        <div class="rte">
          <div class="text-center">
            <img src="/img/asd/Content_pages/payment/payment_{$language.iso_code}.webp" alt="All Stars Distribution Payment" class="img-fluid cms_header_image p-img" width="1350" height="300">
          </div>
          
          <p class="cms_title_center" style="color: black; font-weight: bolder; font-size: 23px;">{l s='ALL STARS DISTRIBUTION offers two methods of payment :' d='Shop.Theme.Payment'}</p>
          <div class="spacer-20"></div>
          <div class="row content-payment">
          <div class="row-payment">
            <div class="col-lg-8"><b>{l s='CREDIT CARD :' d='Shop.Theme.Payment'} </b> 
            <br><br> {l s='Visa and Mastercard are the accepted bank cards for the payment of an order on our online platform.' d='Shop.Theme.Payment'}
            <br><br>{l s='In the interest of security and confidentiality, all data communicated during the payment procedure is encrypted and only entered on the page of our financial partner Ingenico.' d='Shop.Theme.Payment'}  
            <br><br>{l s='In order to validate the payment of an order, the name of the cardholder, its 16-digit number, its expiry date and its cryptogram will be requested by no other organisation other than our online payment service provider Ingenico.' d='Shop.Theme.Payment'}
            <br><br>{l s='The total amount paid will be debited immediately and the rest of the process and the update of the order status will be instantaneous. A confirmation will then be sent to you by email as a digital archive.' d='Shop.Theme.Payment'} 
            </div>
            <div class="col-lg-4" style="text-align: center;">
              <img src="/img/asd/Content_pages/payment/creditcard.webp?t=112" style="width: 250px;" alt="creditcard option" width="250" height="250">
            </div>
          </div>

          <div class="row-payment" >
            <div class="col-lg-8" style="margin-top: 70px;"><b>{l s='BANK TRANSFER :' d='Shop.Theme.Payment'} </b> 
            <br><br>{l s='Once you have selected payment by bank transfer on our website, you will receive a confirmation email with the details of our bank account, to which the payment should be made.Please note that these details must be exclusively in the name of ALL STARS DISTRIBUTION and based in Portugal.' d='Shop.Theme.Payment'} 
            <br><br>{l s='Payments by bank transfer must be made within 72 hours after the order has been confirmed. If the payment is not made within this period, your order will be automatically cancelled.' d='Shop.Theme.Payment'} 
            <br><br>{l s='Please note that payment by bank transfer will result in additional processing time for the dispatch of an order as it will only be dispatched once payment has been received in our bank account.' d='Shop.Theme.Payment'} 
            <br><br>{l s='Please also note that no items are reserved until payment for the order has been confirmed in our bank account.' d='Shop.Theme.Payment'}
            </div>
            <div class="col-lg-4" style="text-align: center;">
              <img src="/img/asd/Content_pages/payment/bankwire.png?t=113" style="width: 250px;" alt="bankwire option" width="250" height="190">
            </div>
          </div>

            <div class="col-lg-12" style="margin-top: 30px;"></div>
          </div>
        </div>
      {elseif $cms.id === 12}
        <div class="cms-career">
          <div class="career-banner">
            <img class="p-img" src="/img/asd/Content_pages/career/career_{$language.iso_code}.webp" alt="career banner"/>
          </div>
          <div class="career-content">
            <h1>{l s='> OPEN POSITIONS <' d='Shop.Theme.Career'}</h1>
            <div id="why_us_anchor">
                {$Graphic.content nofilter}
                {$Web.content nofilter}
                {$Customer.content nofilter}
                {$Picker.content nofilter}
                {$Associate.content nofilter}
                {$General.content nofilter}
              </div>

              <script>
            function updateCareerImage() {
              const careerImage = document.querySelector(".career-banner img");
              const screenWidth = window.screen.width;

              if (screenWidth > 1140) {
                careerImage.setAttribute("width", "1350");
                careerImage.setAttribute("height", "300");
              } else if (screenWidth > 575) {
                careerImage.setAttribute("width", "1140");
                careerImage.setAttribute("height", "190");
              } else {
                careerImage.setAttribute("width", "575");
                careerImage.setAttribute("height", "120");
              }
            }
            updateCareerImage();
            // document.addEventListener("DOMContentLoaded", updateLegalImage);
            window.addEventListener("resize", updateCareerImage);
        </script>

              <div class="form-career-container" style="margin: 5rem 0;">
                <h1 style="text-align: center;color:#000;margin-bottom:2rem;">{l s='JOB APPLICATION' d='Shop.Theme.Career'}</h1>
                
                <form class="form-career" action_job="form_job" method="post" name="application__form">
                  <input type="hidden" name="action_job" value="form_job">
                  <div class="form-row radio-btns-form  col-lg-12">
                    <div class="form-check col-lg-1 col-md-6">
                      <input class="form-check-input" type="radio" name="gender" id="gender" value="1">
                      <label class="form-check-label" for="gender">
                      {l s='Mr.' d='Shop.Theme.Career'}
                      </label>
                    </div>
                    <div class="form-check  col-lg-1 col-md-6">
                      <input class="form-check-input" type="radio" name="gender" id="gridRadios2" value="2">
                      <label class="form-check-label" for="gridRadios2">
                      {l s='Mrs.' d='Shop.Theme.Career'}
                      </label>
                    </div>
                  </div>
                  

                  <div class="form-row " style="display: flex;flex-wrap:wrap;">
                    <div class="form-group col-lg-4 col-md-6 col-sm-12">
                      <label for="name">{l s='Name' d='Shop.Theme.Career'}<span style="color:#ee302e;">*</span></label>
                      <input type="text" class="form-control" id="name" name="first_name" required>
                    </div>
                    <div class="form-group col-lg-4 col-md-6 col-sm-12 ">
                      <label for="surname">{l s='Surname' d='Shop.Theme.Career'}<span style="color:#ee302e;">*</span></label>
                      <input type="text" class="form-control" id="surname" name="last_name"required>
                    </div>
                    <div class="form-group  col-lg-4 col-md-6 col-sm-12 ">
                      <label for="email">{l s='Email' d='Shop.Theme.Career'}<span style="color:#ee302e;">*</span></label>
                      <input type="email" class="form-control" id="email" name="email_job" required>
                    </div>
                  
                    <div class="form-group col-lg-2 col-md-3  col-sm-12">
                      <label for="country_code">{l s='Phone' d='Shop.Theme.Career'}<span style="color:#ee302e;">*</span></label>
                      <select id="country_code" class="form-control" name="country_code" required>
                        <option selected>{l s='Please Select...' d='Shop.Theme.Career'}</option>
                        {foreach $countries as $country}
                          <option value="{$country['call_prefix']}">{substr($country["name"],0,24)} (+{$country['call_prefix']}) </option>
                        {/foreach}
                      </select>
                    </div>
                    <div class="form-group col-lg-2 col-md-3  col-sm-12">
                      <label for="phone_number">{l s='Phone Number' d='Shop.Theme.Career'}</label>
                      <input type="text" class="form-control" id="phone_number" placeholder="" name="phone_number" required>
                    </div>
                    <div class="form-group col-lg-4 col-md-6  col-sm-12">
                      <label for="contact_preference">{l s='How do you prefer to be contacted?' d='Shop.Theme.Career'}<span style="color:#ee302e;">*</span></label>
                      <select id="contact_preference" class="form-control" name="contact_preference" required>
                        <option selected>{l s='Please Select...' d='Shop.Theme.Career'}</option>
                        <option value="email">{l s='Email' d='Shop.Theme.Career'}</option>
                        <option value="phone">{l s='Phone' d='Shop.Theme.Career'}</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-4 col-md-6  col-sm-12">
                      <label for="country">{l s='Country' d='Shop.Theme.Career'}<span style="color:#ee302e;">*</span></label>
                      <select id="country" class="form-control" name="country" required>
                        <option selected>{l s='Please Select...' d='Shop.Theme.Career'}</option>
                        {foreach $countries as $country}
                          <option value="{$country['name']}">{substr($country["name"],0,24)}{(strlen($country["name"])>25)?'...':''}</option>
                        {/foreach}
                      </select>
                    </div>
                  
                    <div class="form-group col-lg-4 col-md-6  col-sm-12">
                      <label for="position">{l s='Which position are you applying to' d='Shop.Theme.Career'}<span style="color:#ee302e;">*</span></label>
                      <select id="position" class="form-control" name="position" required>
                        <option selected>{l s='Please Select...' d='Shop.Theme.Career'}</option>
                        <option value="Graphic Designer">Graphic Designer</option>
                        <option value="Webmaster">Webmaster</option>
                        <option value="Customer Support">Customer Support</option>
                        <option value="Warehouse Picker">Warehouse Picker</option>
                        <option value="Warehouse Associate">Warehouse Associate</option>
                        <option value="General Application">General Application</option>
                      </select>
                    </div>
                    <div class="form-group col-lg-4 col-md-6  col-sm-12">
                      <label for="address_line_1">{l s='Address Line 1' d='Shop.Theme.Career'}<span style="color:#ee302e;">*</span></label>
                      <input type="tel" class="form-control" id="address_line_1" placeholder="" name="address_line_1" required>
                    </div>
                    <div class="form-group col-lg-4  col-md-6  col-sm-12">
                      <label for="address_line_2">{l s='Address Line 2' d='Shop.Theme.Career'}</label>
                      <input type="text" class="form-control" id="address_line_2" placeholder="" name="address_line_2">
                    </div>
                  
                    <div class="form-group col-lg-4 col-md-6 col-sm-12 ">
                      <label for="city">{l s='City' d='Shop.Theme.Career'}</label>
                      <input type="text" class="form-control" id="city"  name="city" required>
                    </div>
                    <div class="form-group col-lg-4 col-md-6  col-sm-12">
                      <label for="post_code">{l s='Zip Code' d='Shop.Theme.Career'}<span style="color:#ee302e;">*</span></label>
                      <input type="text" class="form-control" id="post_code" name="post_code" required>
                    </div>
                    <div class="form-group col-lg-4 col-md-6  col-sm-12">
                      <label for="from_where">{l s='How did you know about this job position?' d='Shop.Theme.Career'}</label>
                      <input type="text" class="form-control" id="from_where" name="from_where">
                    </div>
                  </div>
    
                <div class="form-row ">
                  <div class="form-group col-lg-4 col-md-6  col-sm-12">
                    <label for="fileUpload">{l s='Upload your CV ( only PDF files )' d='Shop.Theme.Career'} <span style="color:#ee302e;">*</span></label>
                    <input type="file" class="form-control-file" id="fileUpload" name="fileUpload" style="background: #fff;width:100%;padding:6px 0.5rem;" required>
                  </div>
                </div>

                <div class="form-row ">
                  <div class="form-group col-lg-4 col-md-6 col-sm-12">
                    <div class="form-check col-md-12">
                      <input class="form-check-input" type="checkbox" id="gridCheck" required>
                      <label class="form-check-label" for="gridCheck">
                        <a href="{$link->getCMSLink(13)}">{l s='You agree with our conditions terms' d='Shop.Theme.Career'}</a> <span style="color:#ee302e;">*</span>
                      </label>
                    </div>
                  </div>
                </div>
    
                  <div class="form-row ">
                    <div class="form-group col-md-2 col-sm-12 col-xs-12" style="display: flex;justify-content:start;">
                      <button type="submit" class="btn btn-primary">{l s='Send' d='Shop.Theme.Career'}</button>
                    </div>
                  </div>
                </form>
              </div>


          </div>
        </div>
      {elseif $cms.id === 13}
        <div class="cms-terms">
          <div class="banner-terms">
            <img class="p-img" src="/img/asd/Content_pages/terms/terms_{$language.iso_code}.webp" alt="terms banner" width="1350" height="300" />
          </div>
          <div class="terms-content">
            <h1>{l s='GENERAL CONDITIONS OF SALE' d='Shop.Theme.Terms'}</h1>
            <p>{l s='These general terms and conditions of sale apply, without restriction or reservation, to all sales concluded on the website' d='Shop.Theme.Terms'} <a>https://all-stars-distribution.com</a></p>
            <h2>{l s='ARTICLE 1: MANDATORY INFORMATION' d='Shop.Theme.Terms'}</h2>
            <p>{l s='The website' d='Shop.Theme.Terms'} <a href="https://all-stars-distribution.com">https://all-stars-distribution.com</a> {l s='is the property of :' d='Shop.Theme.Terms'}</p>
            <br>
            <p style="margin-top: 2rem;line-height: 29px;">ALL STARS DISTRIBUTION LDA </p>
            <p style="line-height: 29px;">ZONA INDUSTRIAL DE GANDRA S/N </p>
            <p style="line-height: 29px;">4930-311 GANDRA – VALENCA </p>
            <p style="line-height: 29px;">PORTUGAL</p>
            <p style="line-height: 29px;">PT513881387</p>
            <a href="mailto:sales@all-stars-distribution.com">sales@all-stars-distribution.com</a>
            <h2>{l s='ARTICLE 2: PRODUCTS' d='Shop.Theme.Terms'}</h2>
            <p>{l s='The website www.all-stars-ditribution.com offers for sale spare parts, accessories and consumables for vehicles and cars. ALL STARS DISTRIBUTION is specialised in the sale of performance spare parts.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='The customer declares to have read and accepted the general conditions of sale prior to the validation of their order.' d='Shop.Theme.Terms'}</p>
            <br>
            <h2>{l s='ARTICLE 3: PRICE' d='Shop.Theme.Terms'}</h2>
            <p>{l s='The prices of the products present on the site www.all-stars-distribution.com are indicated in euros excluding taxes (HT).
            In the case of an order delivered to a country outside the European Union, the customer, being the importer of the products purchased, is solely responsible for the declaration and payment of any customs duties or other taxes that may be due in his country upon delivery of the order.
            Delivery costs are not included in the prices displayed; they will be visible in a summary sent by email to the customer following the validation of his online order before making the payment.' d='Shop.Theme.Terms'}</p>
            <br>
            <h2>{l s='ARTICLE 4: AVAILABILITY OF PRODUCTS' d='Shop.Theme.Terms'}</h2>
            <p>{l s='The available products appear on our site accompanied by the mention "In stock". In order to best meet the expectations of our customers, the availability of our products is regularly updated.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='If you have ordered a product that is unavailable after the validation of your order, you will be informed immediately. We will proceed with the cancellation of your order and you will be refunded immediately if payment for the order has already been made.' d='Shop.Theme.Terms'}</p>
            <br>
            <h2>{l s='ARTICLE 5: ORDERING' d='Shop.Theme.Terms'}</h2>
            <p>{l s='You can order our products directly on our website if you have a customer account. If you do not have one, you can request one via the following link:' d='Shop.Theme.Terms'} <a href="https://www.all-stars-distribution.com/en/content/7-becomedealer">https://www.all-stars-distribution.com/en/content/7-becomedealer</a></p>
            <br>
            <p>{l s='A reply will be sent to you within 48 hours of receiving your request.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='To place an order on our site, choose your items and add them to the basket. Confirm the contents of your basket, choose your payment method and tick the box "acceptance of the T&Cs".' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='You will receive an order confirmation email to the email address you provided when you created your customer account. Check the details and the amount of your order. Correct any errors in advance before making your payment.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='The transfer of ownership of the product will only take place upon full payment of your order.' d='Shop.Theme.Terms'}</p>
            <br>
            <h2>{l s='ARTICLE 6: DELIVERY' d='Shop.Theme.Terms'}</h2>
            <p>{l s='We deliver worldwide with the carrier of our choice. The delivery takes place at the address indicated by the buyer at the time of the validation of the order.' d='Shop.Theme.Terms'}</p>
            <br>
            <p>{l s='The amount of the delivery costs is calculated once your order is registered, according to the characteristics of the products purchased and the delivery address given. A confirmation email will be sent to you with the amount of the delivery costs to be expected for your order in order to proceed with the payment of the latter.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='Delivery times are given for information purposes only and may change due to various factors beyond our control.' d='Shop.Theme.Terms'}</p>
            <p>{l s='Parcels are entrusted to external service providers for their delivery (TNT, DPD, GLS, etc.). ALL STARS DISTRIBUTION cannot under any circumstances be held responsible for a dispute about the delivery of a package.' d='Shop.Theme.Terms'}</p>
            <p>{l s="Orders are shipped from our European warehouses, provided with a specific tracking number that can be checked online at any moment through the carrier's website." d='Shop.Theme.Terms'}</p>
            <p>{l s='We strongly recommend checking the packages condition directly with the driver during the delivery to ensure that there are no visible damages.' d='Shop.Theme.Terms'}</p>
            <p>{l s="In case of any issues such as damaged packaging, missing or damaged products, reservations must be reported on the delivery slip to support any claim. It will also be necessary to provide pictures of the visible damages as well as the transport label showing tracking number and recipient's information. If this verification cannot be carried out directly with the driver, a written complaint must be sent to the carrier as soon as the damages are noted." d='Shop.Theme.Terms'}</p>
            <p>{l s='Any complaint must be communicated to our customer service by e-mail within 48 hours (business days) following order’s delivery date, beyond which no complaint will be accepted by the carrier. In all cases of complaints, original packaging must be kept.' d='Shop.Theme.Terms'}</p>
            <p>{l s='In case of a parcel lost, a claim will be opened with the carrier to carry out in-depth research that may take up to 3 weeks before receiving the confirmation of the parcel loss. Once the loss confirmed by the carrier, a new shipment will be automatically scheduled depending on stock level. No refund will be issued in any case of parcel loss.' d='Shop.Theme.Terms'}</p>
            <br>
            <h2>{l s='ARTICLE 7: TERMS OF PAYMENT' d='Shop.Theme.Terms'}</h2>
            <p>{l s='We offer two methods of payment on our site:' d='Shop.Theme.Terms'} </p>
            <br>
            <p><b>{l s='BANK CARD :' d='Shop.Theme.Terms'} </b>
            {l s='Visa and Mastercard are the bank cards accepted for the payment of an order on our online platform.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='In the interest of security and confidentiality, all data communicated during the payment procedure is encrypted entered exclusively on the page of our financial partner Ingenico.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='In order to validate the payment of an order, the name of the cardholder, its 16-digit number, its expiry date and its cryptogram will be requested by no other organisation other than our online payment service provider Ingenico and only they will have access to it.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>
            {l s='The total amount paid will be debited immediately and the rest of the process and the order status will be updated instantly. A confirmation will then be sent to you by email as a digital archive.' d='Shop.Theme.Terms'} </p>
            <br>
            <p><b>{l s='BANK TRANSFER :' d='Shop.Theme.Terms'} </b></p>
            <br>
            <p>{l s='Once the payment by bank transfer has been selected on our website, you will receive a confirmation email with the details of our bank account, to which the payment must be made. Please note that these details must be exclusively in the name of ALL STARS DISTRIBUTION based in Portugal.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='Payments by bank transfer must be made within 72 hours after the order has been confirmed. If the payment is not made within this period, your order will be automatically cancelled.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='Please note that payment by bank transfer will result in additional processing time for the dispatch of an order as it will only be dispatched once payment has been received in our bank account.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='Please also note that no items are reserved until payment for the order has been confirmed in our bank account.' d='Shop.Theme.Terms'}</p>
            <br>
            <h2>{l s='ARTICLE 8: WARRANTY:' d='Shop.Theme.Terms'}</h2>
            <p>{l s='The company All Stars Distribution ensures the guarantee of the hidden defects under the legal conditions, the purchaser has a deadline of eight days from the discovery of the hidden defect to notify his reservations by email.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s="All warranty claims must be sent by email to sales@all-stars-distribution.com together with photos or videos showing the problem. As the guarantee is taken over directly by the supplier, the shipping costs for sending and returning the product will be at the customer's expense, with the supplier only covering the costs of repairing or replacing the product concerned by the warranty. If the supplier finds that the problem encountered is not covered by the conditions of the guarantee, the shipping costs for the return of the product remain the responsibility of the customer." d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='Under no circumstances can a warranty claim be made due to a problem encountered with a product following a faulty installation. In this case, the buyer must contact the professional who installed the product in question.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='For any warranty claim which will require the sending of the product to our premises in order to verify it, All Stars Distribution will reimburse the buyer for the shipping costs of the product if the warranty coverage by the supplier is confirmed, otherwise all shipping costs will be borne by the latter.' d='Shop.Theme.Terms'}</p>
            <br>
            <p>{l s='In no case will it be possible to request a refund for the product concerned from the company All Stars Distribution as part of a warranty claim.' d='Shop.Theme.Terms'}</p>
            <br>
            <h2>{l s='ARTICLE 9: PRODUCT RETURNS' d='Shop.Theme.Terms'}</h2>
            <p>{l s='All sales made on our site are final, they cannot in any case give rise to the return of a product (except in the context of a guarantee, see article 8).' d='Shop.Theme.Terms'}</p>
            <br>
            <h2>{l s='ARTICLE 10: CONDITIONS AND DEADLINES FOR REIMBURSEMENT' d='Shop.Theme.Terms'}</h2>
            <p>{l s='Cancellation of an order is possible as long as the order has not been shipped from our warehouse. Any cancellation request made after the order has been shipped will not be accepted.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='If cancellation of the order is possible, we will refund the order via the payment method originally used by the buyer within 30 days.' d='Shop.Theme.Terms'}</p>
            <br>
            <h2>{l s='ARTICLE 11: PERSONAL DATA' d='Shop.Theme.Terms'}</h2>
            <p>{l s='Certain customer information will be passed on to delivery and / or payment service providers (i.e., surname, first name, address, postal code and telephone number) in order to allow the processing and delivery of the products ordered.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='The commercial offers of the site will be sent to the customer by e-mail if no objection has been made. The customer may object at any time by logging into his personal space or by sending an email to our customer service department.' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s="The site ensures that the customer's personal information is collected and processed in compliance with law n°78-17 of January 6, 1978 relating to information technology, files and freedom." d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='In accordance with articles 39 and 40 of the law dated 6 January 1978, the customer has the right to access, rectify, delete and oppose his personal data. The customer can exercise this right via :' d='Shop.Theme.Terms'} </p>
            <br>
            <p>{l s='- His personal space' d='Shop.Theme.Terms'} </p>
            <p>{l s='- By e-mail to ' d='Shop.Theme.Terms'} <a href="mailto:sales@all-stars-distribution.com">sales@all-stars-distribution.com</a></p>
            <p style="margin:3rem 0 2rem 0;text-align:center;">{l s='This document was last updated on November 21, 2022' d='Shop.Theme.Terms'}</p>
          </div>
        </div>
      {else}

        {$cms.content nofilter}
      {/if}

      {* <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> *}

    <script>

      function validateForm() {
        
      var empty = $(".form-become-dealer").find('input[required]').filter(function() {
          return this.value == '';
      });
      
      if (empty.length) {
          $(".form-become-dealer").find('input[required]').css('border', '1px solid red');
          alert("{$fill_all}");
          return false;
      }
          
          
      let error = 0;
      let site = $('#site').val();
      let social = $('#social').val();
      let business_type = document.querySelectorAll('input[name="business_type[]"]:checked').length;
      let main_market   = document.querySelectorAll('input[name="main_market[]"]:checked').length;
  
      if( ($('#site').val() == '') && ($('#social').val() == '')){
          alert("{$error_1}"); 
          error = 1;
      }
      
      if(business_type == 0){
          alert("{$error_2}"); 
          error = 1;
      }
      
      if(main_market == 0){
          alert("{$error_3}"); 
          error = 1;
      } 
      
      if(!ValidateEmail()){
          error = 1;
      }
    
      
      if((site != '') && (!ValidateURL(1))){
          error = 1;
      } 
      
      if((social != '') && (!ValidateURL(2))){
          error = 1;
      } 

      if(error == 0){
          $('.form-become-dealer form').submit();
      }else{
          return false;
      }
  
  } 
  

  
  function ValidateURL(tipoURL) {
  
      let message = "{$error_6}";
      if(tipoURL == 1) message = "{$error_5}";
      
      let url = $('#social').val();
      if(tipoURL == 1) url = $('#site').val();
        
      if(url.indexOf(' ') >= 0){
          alert(message);
          return (false);
      } 
       let validatorString = new RegExp("((http|https)\\://)?[a-zA-Z0-9\\.\\/\\?\\:\\@\\-_=#]+\\.([a-zA-Z0-9\\&\\.\\/\\?\\:\\@\\-_=#])*");
  
      if ( validatorString.test(url) ){
          return (true);
      }else{
          alert(message);
          return (false);        
      }
  }
  

  

</script>  


    {/block}

    {block name='hook_cms_dispute_information'}
      {hook h='displayCMSDisputeInformation'}
    {/block}

    {block name='hook_cms_print_button'}
      {hook h='displayCMSPrintButton'}
    {/block}

  </section>
{/block}
