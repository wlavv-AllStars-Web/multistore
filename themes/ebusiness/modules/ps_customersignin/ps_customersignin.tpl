<div id="_desktop_user_info">
  <div class="user-info">
  {* <pre>{$urls|print_r}</pre> *}

    {if $logged}
      <a class="logout d-none d-lg-block" href="{$urls['actions']['logout']}" rel="nofollow" >
      <i class="fa fa-unlock" style="font-size: 20px;color:#fff"></i>
        {* <span style="text-transform: uppercase;color:#fff">{l s='Sign out' d='Shop.Theme.Actions'}</span> *}
      </a>
      <a class="user-info-account"  href="{$urls['pages']['my_account']}" title="{l s='My account' d='Shop.Theme.CustomerAccount'}" rel="nofollow" >
        <i class="fa-solid fa-user" style="color:#fff"></i>
        <span class="d-none d-lg-block" style="text-transform: uppercase;color:#fff;font-weight:600;font-size:15px;" >{l s='My account' d='Shop.Theme.Actions'}</span>
      </a>
      
    {else}
      <a class="d-desktop" href="{$urls['pages']['authentication']}" style="display: flex;justify-content:end;align-items:center;padding-right:4px;gap:5px;" title="{l    s='Log in to your customer account' d='Shop.Theme.CustomerAccount'}" rel="nofollow" >
        <i class="fa-solid fa-user" style="color:#fff"></i>
        <span class="d-none d-lg-block" style="text-transform: uppercase;color:#fff;font-weight:600;font-size:15px;">{l s='My account' d='Shop.Theme.Actions'}</span>
      </a>

      <div class="d-mobile" onclick="toggleMyaccountLogin()" style="display: flex;justify-content:end;align-items:center;padding-right:4px;gap:5px;" title="{l    s='Log in to your customer account' d='Shop.Theme.CustomerAccount'}" >
        <i class="fa-solid fa-user" style="color:#fff"></i>
        <span class="d-none d-lg-block" style="text-transform: uppercase;color:#fff;font-weight:600;font-size:15px;">{l s='My account' d='Shop.Theme.Actions'}</span>
      </div>
        
        {* <span style="border-right: 1px solid #fff; margin-top: 9px;   height: 21px;   display: inline-block;" > *}
    </span>
    {/if}
  </div>
</div>
