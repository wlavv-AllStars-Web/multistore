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
<style>
  @media (min-width: 901px) {
    .deformula {
      display: none !important;
    }
  }

  @media (max-width: 900px) {
    .colu {
      flex-direction: column;
    }
  }
</style>
{function name="menu" nodes=[] depth=0 parent=null}
  {if $nodes|count}

    <ul style="width:100%; display:flex; justify-content: space-between; margin-bottom:4px;overflow:hidden;" class="top-menu colu"
      {if $depth == 0}id="top-menu" {/if} data-depth="{$depth}">

      {foreach from=$nodes item=node}

        {if Context::getContext()->customer->logged == 1}
          {if $node.label == "Logged"}
            {foreach $node['children'] AS $children }
              {if $children.label == "Brands"}

                <li style="width: 100%" class="mxsz {$children.type}{if $children.current} current {/if}"
                  id="{$children.page_identifier}">
                  {assign var=_counter value=$_counter+1}
                  <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600"
                    class="bortextalign {if $depth >= 0}dropdown-item{/if}{if $depth === 1} dropdown-submenu{/if}" href="/brands"
                    data-depth="{$depth}" {if $children.open_in_new_window} target="_blank" {/if}>

                    {$children.label}
                  </a>
                </li>
              {else}

                <li style="width: 100%" class="mxsz {$children.type}{if $children.current} current {/if}"
                  id="{$children.page_identifier}">
                  {assign var=_counter value=$_counter+1}
                  <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600"
                    class="bortextalign {if $depth >= 0}dropdown-item{/if}{if $depth === 1} dropdown-submenu{/if}"
                    href="{$children.url}" data-depth="{$depth}" {if $children.open_in_new_window} target="_blank" {/if}>

                    {$children.label}
                  </a>
                </li>
              {/if}
            {/foreach}
          {/if}
        {else if Context::getContext()->customer->logged == 0}


          {if $node.label == "NotLogged"}
            {foreach $node['children'] AS $children }
              {if $children.label == "Brands"}

                <li style="width: 100%" class="mxsz {$children.type}{if $children.current} current {/if}"
                  id="{$children.page_identifier}">
                  {assign var=_counter value=$_counter+1}
                  <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600"
                    class="bortextalign {if $depth >= 0}dropdown-item{/if}{if $depth === 1} dropdown-submenu{/if}" href="/brands"
                    data-depth="{$depth}" {if $children.open_in_new_window} target="_blank" {/if}>

                    {$children.label}
                  </a>
                </li>
              {else}
                <li style="width: 100%" class="mxsz {$children.type}{if $children.current} current {/if}"
                  id="{$children.page_identifier}">
                  {assign var=_counter value=$_counter+1}
                  <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600"
                    class="bortextalign {if $depth >= 0}dropdown-item{/if}{if $depth === 1} dropdown-submenu{/if}"
                    href="{$children.url}" data-depth="{$depth}" {if $children.open_in_new_window} target="_blank" {/if}>

                    {$children.label}
                  </a>
                </li>
              {/if}
            {/foreach}
          {/if}
        {/if}
      {/foreach}
    </ul>
  {/if}
{/function}

  {* <pre>{$urls|print_r}</pre> *}
<div style="width: 80vw;" class="menu js-top-menu position-static formula row" id="_desktop_top_menu_desktop">
  {if Context::getContext()->customer->logged}
    <ul style="width:100%; display:flex; justify-content: space-between; margin-bottom:4px;overflow:hidden;" class="top-menu colu" id="top-menu" data-depth="0">
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-23">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item {if $showNotificationBall ===1} ball_notification{/if}" href="{$urls.pages.my_account}" data-depth="0">
            <span>
            {l s='My Account' d='Shop.Theme.Menu'}
            </span>
          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-24">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="{$link->getPageLink('new-products', true)}" data-depth="0">
          {l s='News' d='Shop.Theme.Menu'}
          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="{$link->getPageLink('manufacturer')}" data-depth="0">
          {l s='Brands' d='Shop.Theme.Menu'}
          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="{$link->getPageLink('catalog', true)}" data-depth="0">
          {l s='Catalogs' d='Shop.Theme.Menu'}
          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-25">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="{$link->getCategoryLink(16)|escape:'html':'UTF-8'}" data-depth="0">
          {l s='Clearence' d='Shop.Theme.Menu'}
          </a>
      </li>

    </ul>
  {else}
    <ul style="width:100%; display:flex; justify-content: space-between; margin-bottom:5px" class="top-menu colu" id="top-menu" data-depth="0">
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-23">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="{$link->getCMSLink(8)}" data-depth="0">
          {l s='About Us' d='Shop.Theme.Menu'}
          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-24">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="{$link->getCMSLink(14)}" data-depth="0">
          {l s='Become a dealer' d='Shop.Theme.Menu'}
          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-25">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="{$link->getCMSLink(15)}" data-depth="0">
          {l s='Become a suplier' d='Shop.Theme.Menu'}
          </a>
      </li>

      <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="{$link->getPageLink('manufacturer')}" data-depth="0">
          {l s='Brands' d='Shop.Theme.Menu'}
          </a>
      </li>
    </ul>
  {/if}
  <div class="clearfix"></div>
</div>


<div style="width: 100vw; display: flex; flex-direction: column" class="deformula ">
  <div style="width:100vw;" class="menu js-top-menu position-static row" id="_desktop_top_mobile">
    <button style="float: left; " class="navbar-toggler" type="button" data-toggle="collapse"
      data-target="#_desktop_top_menu" aria-controls="_desktop_top_menu" aria-expanded="false"
      aria-label="Toggle mobile menu">
      <i style="color: white; float:left; font-size:xx-large;" class="material-icons">&#xE5D2;</i>
    </button>
    {if Context::getContext()->customer->logged}

      {hook h='displaySearch'}

    {else}
      <button style="float: right; padding-left:24px; padding-top: 15px; color: white " class="navbar-toggler"
        type="button" data-toggle="collapse" data-target="#login_block" aria-controls="login_block" aria-expanded="false"
        aria-label="Toggle mobile menu">
        <span class="logtext">{l s='Login' d='Shop.Theme.Actions'}</span>
      </button>
    {/if}
  </div>
  {if Context::getContext()->customer->logged}
    <div style="margin: 0; width: 100vw;" class="js-top-menu collapse navbar-collapse row" id="_desktop_top_menu">
      <ul style="width:100%; display:flex; justify-content: space-between; margin-bottom:5px" class="top-menu colu" id="top-menu" data-depth="0">
        <li style="width: 100%" class="mxsz cms-page" id="cms-page-23">
            <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="{$link->getPageLink('myaccount', true)}" data-depth="0">
            {l s='My Account' d='Shop.Theme.Menu'}
            </a>
        </li>
        <li style="width: 100%" class="mxsz cms-page" id="cms-page-24">
            <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="{$link->getPageLink('new-products', true)}" data-depth="0">
            {l s='News' d='Shop.Theme.Menu'}
            </a>
        </li>
        <li style="width: 100%" class="mxsz cms-page" id="cms-page-25">
            <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="{$link->getPageLink('manufacturer')}" data-depth="0">
            {l s='Brands' d='Shop.Theme.Menu'}
            </a>
        </li>

        <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
            <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="{$link->getPageLink('catalog', true)}" data-depth="0">
            {l s='Catalogs' d='Shop.Theme.Menu'}
            </a>
        </li>
        <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
            <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="{$link->getCategoryLink(16)|escape:'html':'UTF-8'}" data-depth="0">
            {l s='Clearence' d='Shop.Theme.Menu'}
            </a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
  {else}
  <div style="margin: 0; width: 100vw;" class="js-top-menu collapse navbar-collapse row" id="_desktop_top_menu">
    <ul style="width:100%; display:flex; justify-content: space-between; margin-bottom:5px" class="top-menu colu" id="top-menu" data-depth="0">
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-23">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="{$link->getCMSLink(8)}" data-depth="0">
          {l s='About Us' d='Shop.Theme.Menu'}
          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-24">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="{$link->getCMSLink(14)}" data-depth="0">
          {l s='Become a dealer' d='Shop.Theme.Menu'}
          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-25">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="{$link->getCMSLink(15)}" data-depth="0">
          {l s='Become a suplier' d='Shop.Theme.Menu'}
          </a>
      </li>

      <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="{$link->getPageLink('manufacturer')}" data-depth="0">
          {l s='Brands' d='Shop.Theme.Menu'}
          </a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  {/if}
  {* Login Dropdown Menu *}


  <div
    style="text-align: end; padding-top: 12px; width: 100% !important; padding-left: 25px; padding-right: 25px; background-color:white"
    id="login_block" class="collapse navbar-collapse mxsz">

    <form style="display:flex;flex-direction: column; width: 100%" id="login-form" action="{$link->getPageLink('authentication', true)}" method="post"
    name="continue"
    data-link-action="sign-in"
    type="submit"
    value="1">
    
      <div style="display:flex; width:100%; height: min-content" class="form-group col">
        <i class="fa fa-user" style="font-size: 25px; padding: 5px 7px; background-color: #0273eb; color: white"></i>
        <input type="text" class="form-control whtbl" id="email" name="email" placeholder="{l s="Email"}">
      </div>
      <div style="margin-bottom:0 ;  display: flex; flex-direction: column ; width: 100%; margin-top: 20px"
        class="form-group col">
        <div style="display:flex; flex-direction: row">
          <i class="fa fa-unlock"
            style="font-size: 25px; padding: 5px 7px;  background-color: #0273eb; color: white "></i>
          <input class="form-control js-child-focus js-visible-password whtbl" name="password" type="password" value=""
            required placeholder="{l s="Password"}">
        </div>
        <div style="justify-content:end">
          {hook h='displayPaCaptcha' posTo='login'}
          <a href="{$urls.pages.password|escape:'html':'UTF-8'}" rel="nofollow" style="color: #0273EB">
            {l s='Forgot your password?' d='Shop.Theme.Actions'}
          </a>
        </div>
      </div>
      <div style="width: 100% ; margin-top: 20px" class="form-group col">
        <input type="hidden" name="submitLogin" value="1">
        <button style=" width: 100%; " type="submit" class="btn whtbl">{l s="Login"}</button>
      </div>
    </form>

  </div>
</div>


{* {hook h='displayTop' mod='ps_customersignin' } *}
