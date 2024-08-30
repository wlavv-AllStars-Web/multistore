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

    {block name='page_content_container'}
      <div id="content" class="page-home">
        {block name='page_content_top'}{/block}

        {block name='page_content'}
          {block name='hook_home'}
            {* {if Context::getContext()->customer->logged}  
            {$HOOK_HOME nofilter}
            {else} *}
              <div class="not_logged_homepage">
                <div class="banner_home hidden-sm-down" >
                <a href="{$homepage_footer['link_banner']}">
                  <img class="p-img" src="/img/asd/homepage/main.webp?{rand()}" alt="{$homepage_footer['alt_banner']}" style="width: 100%;height:auto;" width="1690" height="443" loading="eager" />
                </a>
                </div>

                <div class="profile_container_homepage">
                  <div class="profile_style">{l s='Profile' d='Shop.Theme.HomepageLogout'}</div>
                  <div class="profile_container_text" id="profile_data">
                  {l s='Supplying over 30 top of the line brands to automotive performance professionals worldwide, All Stars Distribution is one of the largest European wholesalers of performance and design parts. Dedicated to serving shops, tuners, e-dealers and other resellers, All Stars Distribution is committed to employing the best of inventory management and distribution practices to get our customers the performance parts they need to satisfy their customers.' d='Shop.Theme.HomepageLogout'}
                  
                  </div>
                  <div id="profile_container_text1 " class="card_view_more mobile" onclick="expandText(this)">{l s='View More' d='Shop.Theme.HomepageLogout'}</div>
                </div>

                <div id="why_us_anchor">
                  <div class="why_card">
                    <img src="/img/asd/homepage/stock_{$language.iso_code}.webp"  alt="stock" width="536" height="268" loading="lazy"/>
                    <div id="thumb_data_1" class="card_text" >
                    {l s='As a wholesaler, the importance of inventory, having it and managing it, cannot be overstated. All Stars Distribution places the highest priority on maintaining the depth and breadth of our inventory all year round. To quickly supply a wide range of specialized products, often manufactured in small quantities to serve the just-in-time market, WE STOCK 98% of our partner manufacturers’ product lines. By choosing All Stars Distribution as a supplier for your performance parts, you will have a direct access to the largest stock of niche market products in Europe, without any financial, human or logistical constraints! Our Warehouse Management and Enterprise Resource Planning Systems, developed in-house by our Information Technology Team, allow us to limit stockouts as much as possible using extremely reliable purchasing algorithms for quick order fulfillment!' d='Shop.Theme.HomepageLogout'}
                    
                    </div>
                    <div id="card_expand1" class="card_view_more" >{l s='View More' d='Shop.Theme.HomepageLogout'}</div>
                  </div>

                  <div class="why_card">
                    <img src="/img/asd/homepage/logistics_{$language.iso_code}.webp" alt="logistics" loading="lazy" width="536" height="268" />
                    <div id="thumb_data_2" class="card_text">
                    {l s='Order management is at the foundation of our business. Our efficiency in picking, packing and dispatching will determine the level of satisfaction of your customers. To ensure a fast and reliable operation we use a specific Order Fulfillment Software developed in-house by our Information Technology Team. Our proprietary software, called "All Stars Log", applied to the picking, packing and reception, ensures a "double check control" providing us an error rate close to 0! Our system’s responsiveness and processing capacity assist us in getting 94% of orders processed and shipped, using premium packaging accessories, in less than 6 hours. Retail quality service for the wholesale market.' d='Shop.Theme.HomepageLogout'}
                    
                    </div>
                    <div id="card_expand2" class="card_view_more" >{l s='View More' d='Shop.Theme.HomepageLogout'}</div>
                  </div>

                  <div class="why_card">
                    <img src="/img/asd/homepage/shipping_{$language.iso_code}.webp" alt="shipping" loading="lazy" width="536" height="268" />
                    <div id="thumb_data_3" class="card_text">
                    {l s='As an international distributor we understand the importance of reliable third-party shipping partnerships and managing shipping expenses. To help limit and simplify these costs, we offer various options to our customers such as Flat Rate shipping charges, applying a scale of only two values per country of destination. Resellers can take advantage of our Drop Shipping option through which your customer receives the product directly from our warehouse, but showing the name of your company as the sender! Our Pick Up option allows our customers to organize the collection and the shipping of their goods via their own carrier.' d='Shop.Theme.HomepageLogout'}
                    
                    </div>
                    <div id="card_expand3" class="card_view_more" >{l s='View More' d='Shop.Theme.HomepageLogout'}</div>
                  </div>

                  <div class="why_card">
                    <img src="/img/asd/homepage/online_{$language.iso_code}.webp" alt="online" loading="lazy" width="536" height="268" />
                    <div id="thumb_data_4" class="card_text">
                    {l s='Our online platform, developed in-house by our IT department, is constantly evolving to offer our customers more and more digital tools! Among other things, through our trade portal you can consult our products and stock levels, see the Retail Prices and your discounts, place your orders and follow their progress until the final delivery. In a few clicks, you can track your parcels, check your proforma and final invoices, see your statistics, manage your account or contact our support teams--currently available in 5 languages (French, English, Spanish, Portuguese and Romanian). Offering a unique platform in Europe, exclusively dedicated to wholesale, All Stars Distribution has all the products and services required to support and develop your business!' d='Shop.Theme.HomepageLogout'}
                    
                    </div>
                    <div id="card_expand4" class="card_view_more" >{l s='View More' d='Shop.Theme.HomepageLogout'}</div>
                  </div>

                  <div class="why_card">
                    <img src="/img/asd/homepage/catalog_{$language.iso_code}.webp" alt="catalogue" loading="lazy" width="536" height="268"/>
                    <div id="thumb_data_5" class="card_text">
                    {l s='Our purchasing department, made up of enthusiasts with solid knowledge of the market and products, works in close collaboration with each brand we carry, to offer the best, latest products ahead of the trend. In addition to the daily listing of new products added to our catalogues, we are always working on adding to our line card—only brands that meet our very strict quality requirements. Already with an exclusive offering of more than 30 specialized, performance enhancing brands, All Stars Distribution is your single source for the material you need to bring your customers’ projects to completion.' d='Shop.Theme.HomepageLogout'}
                    
                    </div>
                    <div id="card_expand5" class="card_view_more" >{l s='View More' d='Shop.Theme.HomepageLogout'}</div>
                  </div>

                  <div class="why_card">
                    <img src="/img/asd/homepage/resources_{$language.iso_code}.webp" alt="resources" loading="lazy" width="536" height="268"/>
                    <div id="thumb_data_6" class="card_text">
                    {l s='If you don’t make the sale, we don’t make the sale! Our design and communication teams, with the support of our IT department, are always working to provide our customers with the latest and best marketing resources. Available to all our partners/customers, these precious resources feature updated catalogues, CSV integration files, API feeds, product photos and digital content specific to each brand. Our newsletters and social media presence keep you informed, without any delay, of upcoming events, new products, new brands and the global news from our industry.' d='Shop.Theme.HomepageLogout'}
                    
                    </div>
                    <div id="card_expand6" class="card_view_more" >{l s='View More' d='Shop.Theme.HomepageLogout'}</div>
                  </div>

                </div>

                <div class="btns_homepage">
                  <div class="button_half btn-primary" onclick="window.location.href='{$link->getCMSLink(14)}'">{l s='Become a Dealer' d='Shop.Theme.HomepageLogout'}</div>
                  <div class="button_half btn-primary" onclick="window.location.href='{$link->getCMSLink(15)}'">{l s='Become a Supplier' d='Shop.Theme.HomepageLogout'}</div>
                </div>

              </div>
            {* {/if} *}
          {/block}
        {/block}
      </div>
    {/block}
