
{if Context::getContext()->isMobile() != 1}
<script>
  function toggleDisplay() {
    var element = document.getElementById("sl");
    var altura = element.offsetHeight; // Obtém a altura do elemento

  if(altura == '0'){
  $(".dropdownMenuDesktop").css('height','259px');
  }else
  {
  $(".dropdownMenuDesktop").css('height','0');
  }
  }
</script>
{assign var=_counter value=0}
{function name="menu" nodes=[] depth=0 parent=null}
    {if $nodes|count}
      <ul class="top-menu" {if $depth == 0}id="top-menu" style="height:50px;"{/if} data-depth="{$depth}" {if $depth === 1}style="display:flex;flex-wrap: wrap;"{/if}>
        {foreach from=$nodes item=node} 
            <li class="menu-link" id="{$node.page_identifier}" style="width: 25%;"
             {if $node.url == 'car'}onclick="toggleDisplay()"{/if}>
            {assign var=_counter value=$_counter+1}
              <a
                class="{if $depth >= 0}bb{/if}{if $depth === 1} dropdown-submenu sss{/if}"
                
                  {if $node.url == 'car'}onclick="toggleDisplay()" style="cursor: pointer;"{/if}
                  {if $node.url != 'car'}href="/{$node.url}" data-depth="{$depth}"{/if}
                  {if $node.url === 'http://asm.local/en/brands'}href="{$link->getPageLink('manufacturer')}"{/if}
                  {if $node.open_in_new_window} target="_blank" {/if}
                
              >
                {if $node.children|count}
                  {* Cannot use page identifier as we can have the same page several times *}
                  {assign var=_expand_id value=10|mt_rand:100000}
                  <span class="pull-xs-right hidden-md-up">
                    <span data-target="#top_sub_menu_{$_expand_id}" data-toggle="collapse" class="navbar-toggler collapse-icons">
                      <i class="material-icons add">&#xE313;</i>
                      <i class="material-icons remove">&#xE316;</i>
                    </span>
                  </span>
                {/if}
                {$node.label}         
              </a>
              {if $node.children|count}
              <div {if $depth === 0} class="popover sub-menu js-sub-menu collapse"{else} class="collapse"{/if} id="top_sub_menu_{$_expand_id}">
                {menu nodes=$node.children depth=$node.depth parent=$node}
              </div>
              {/if}
            </li>
        {/foreach}
      </ul>
    {/if}
{/function}

<div class="menu d-none d-lg-flex col-12 js-top-menu position-static hidden-sm-down" id="_desktop_top_menu">
    {menu nodes=$menu.children}
    <div class="clearfix"></div> 
</div>

<div class="dropdownMenuDesktop" id="sl" align="center">
    <h2 class="title-sc">{l s='Select a vehicle' d='Shop.Theme.Actions'}</h2>
    <div class="clearFilter_button" style="width: 188px;   margin-bottom: 33px;   text-transform: uppercase;">
      {l s='CLEAR FILTER' d='Shop.Theme.Actions'}
    </div>
    <div>
      <img src="/img/103.png" style="width: 70px;height:70px"/>
    </div>
  </div>

{/if}


{if Context::getContext()->isMobile() == 1}
  
{if $page.page_name == 'index'}
<div class="menu-mobile d-lg-none" style="background-color: #595959;   padding: 13px 16px 0px 16px;   margin-bottom: -18px;">
  <div class="col-12 p-0 image-box" style="margin-bottom:1rem;border:1px solid #fff;">
    <div onclick="openCarsMenu()" style="cursor: pointer;">
      <img src="/img/yourcar_{$language.iso_code}.webp" style="width: 100%;border-radius:5px;"/>
    </div>
  </div>
  <div class="dropdownMenuMobile">
    <div class="clearFilter_button" style="text-transform: uppercase;">
      {l s='CLEAR FILTER' d='Shop.Theme.Actions'}
    </div>
    <div>
      <img src="/img/103.png" style="width: 70px;height:70px"/>
    </div>
  </div>
  <div class="col-12 d-flex p-0" style="margin-bottom: 1rem;gap:1rem">
    <div class="col-6 d-flex p-0  image-box" style="flex:1;border:1px solid #fff;">
    <a href="{$link->getPageLink('new-products', true)}">
    <img src="/img/news_{$language.iso_code}.webp" style="width: 100%;border-radius:5px;"/>
    </a>
    </div>
    <div class="col-6 d-flex p-0  image-box" style="flex:1;border:1px solid #fff;">
    <a href="{$link->getPageLink('manufacturer')}">
    <img src="/img/brands_{$language.iso_code}.webp" style="width: 100%;border-radius:5px;"/>
    </a>
    </div>
  </div>
</div>


<script>
function openCarsMenu() {
  const dropdownMenuMobile = document.querySelector(".dropdownMenuMobile")
  if(dropdownMenuMobile){
  dropdownMenuMobile.classList.toggle("show")
  }
}
</script>
{/if}
{/if}