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

<div class="header_content">
  {block name='header_nav'}
    <nav class="header-nav">
      <div class="header-nav-container">
        <div id="navigation">
        {if Context::getContext()->customer->logged}
          <a class="logout" href="/?mylogout=" rel="nofollow" title="Log me out"> <i class="fa fa-unlock"></i> </a>
        {/if}
        </div>
        <div style="width: 50%; display: flex; justify-content: end ;">
          {hook h='displayNav1'}
        </div>
    </nav>
  {/block}
  {* <pre>{$urls|print_r}</pre> *}
  {* <pre>{$cart['products']|count}</pre> *}
  {* {debug} *}
  {block name='header_top'}
    <div class="header-top">
      <div class="container" >
        <div  class="row centrar" style="margin:0;  display: flex; align-items: center;">
          <div  id="_desktop_logo" class="col-md-4 col-sm-12" style="margin: 0; padding: 0; width:30%">
            <a  href="/" style="display: flex; justify-content:start">
              <img  class="logo img-flud img-big" src="/img/asd/logo_asd.webp" alt="{$shop.name|escape:'html':'UTF-8'}" style="width: 250px; margin: 0 " width="250" height="110">
            </a>
          </div>
          {if Context::getContext()->customer->logged}  
          <div class="wdth mobile" style="width: 50%;">
           {hook h="displayNav2" mod="ps_shoppingcart"}
            {* <a href="/order" {if $cart['products']|count > 0} class="cart_empty" {/if}>
            
              <div  style="cursor: pointer; width: 100%">
                <div style=" display: flex; flex-direction: row; justify-content:center" class="cart-container  {if $cart['products']|count < 1} cart_empty{/if}">
                  <div style="width:33px; background-color: #333;float: left;border-radius: 0.25rem 0 0 0.25rem; color: white;display:flex;align-items:center;justify-content:center;border-right: 2px solid #0273eb;"> 
                    <i class="fa fa-shopping-cart" style="font-size: 17px;"></i>
                  </div>
                  <div class="cart_total_header"> {l s="Total"} <span class="productsValue">{$cart.totals.total_excluding_tax.value}</span></div>
                  <div class="products_total_header">
                    <div style="width:33px; height:100%; background-color: #333;border-radius: 0px 0.25rem 0.25rem 0px; color: white; font-size: 1.25rem;text-align:center;display:flex;justify-content:center;align-items:center;border-left:2px solid #0273eb;font-weight:600;" >{$cart.products_count}</div>
                  </div>
                </div>
              </div>
              {if $cart.products|count > 0}
              </a>
              {/if} *}
            </div>
          {/if}
          <div  class="formula" style="display: flex; justify-content:center; margin-left: 50px; width:70%">
           {if Context::getContext()->customer->logged}  
            {* shooping cart bar*}
            <div class="cart" style="width: 50%;">
              {hook h="displayNav2" mod="ps_shoppingcart"}
            </div>
            {* {debug} *}
            {* search bar *}
            <div class="wdth" style="width: 50%">
              <form style="display:flex; justify-content:center" method="get" action="{$urls.pages.search}" id="searchbox">
    		        <input type="hidden" name="controller" value="search">
    		        <input style="border: 1px solid #777; width:50%; border-radius: 20px 0px 0px 20px;" class="search_query form-control" type="text" id="search_query_top" name="s" value="{$search_string|escape:'html':'UTF-8'}" placeholder="{l s='Search' d='Shop.Theme.Catalog'}">
    		        <button type="submit" name="submit_search" class="btn btn-default button-search">
    			        <i class="material-icons material-icons-search"></i>
    		        </button>
    	        </form>
            </div>
            
             {else} 
              {* <pre>{$urls|print_r}</pre> *}
            
            <form id="login-form" action="{$urls.pages.authentication}" method="post">   
                <div style="display:flex; width:30%; height: min-content;" class="form-group col">
                  <div class="email_icon header-icon">
                    <input type="hidden" name="back" value="my-account">
                    <i class="fa fa-user"></i>
                  </div>
                  <input class="form-control whtbl" name="email" type="email" value="{$smarty.post.email}" required placeholder="{l s="Email" d='Shop.Theme.Actions'}">
                </div>
                <div style="margin-bottom:0 ;  display: flex; flex-direction: column ; width: 30%" class="form-group col">
                  <div style="display:flex; flex-direction: row">
                    <div class="unlock_icon header-icon">
                      <i class="fa fa-unlock"></i>
                    </div>
                    <input class="form-control js-child-focus js-visible-password whtbl" name="password" type="password" value="" required placeholder="{l s="Password" d='Shop.Theme.Actions'}">                 
                  </div>
                  <div>
                    <a href="{$urls.pages.password}" rel="nofollow" style="color: #0273EB;font-size:12px;line-height:18px;">
                      {l s='Forgot your password?' d='Shop.Theme.Actions'}
                    </a>
                  </div>
                </div>             
                <div class="form-group col" >
                  <input type="hidden" name="submitLogin" value="1">           
                  <button id="sender" class="btn btn-primary form-control-submit whtbl" data-link-action="sign-in" type="submit">
                  {l s="Login" d='Shop.Theme.Actions'}
                  </button>                
                </div>          
              </form>   
           {/if}  
          </div>
        </div>
      </div>
      <div style="padding-left: 0; line-height: normal"  class="row headerline alinhamento-mobile hlfsz">
        <div class="margbot">
            {hook h='displayNav2' mod="ps_mainmenu"}
        </div>
      </div>    
    </div>


    {* mobile header top *}


  {/block}


</div>


