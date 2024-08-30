{extends file='page.tpl'}

{block name='page_content'}

    <style>nav.breadcrumb { display: none; }</style>

  <div style="max-width:1350px;margin:auto;">
    <img class="p-img" src="/img/asd/Content_pages/forgot/forgot_{$language.iso_code}.webp" style="width: 100%;" alt="news_banner"/>
  </div>
  
  <form action="{$urls.pages.password|escape:'html':'UTF-8'}" class="forgotten-password" method="post">
    <ul class="ps-alert-error">
      {foreach $errors as $error}
        <li class="item">
          <i>
            <svg viewBox="0 0 24 24">
              <path fill="#fff" d="M11,15H13V17H11V15M11,7H13V13H11V7M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20Z"></path>
            </svg>
          </i>
          <p>{$error|escape:'html':'UTF-8'}</p>
        </li>
      {/foreach}
    </ul>
    <div class="container-reset-password">
      <div class="reset-header">
        <h1>{l s="Forgot Password?" d="Shop.Theme.Reset"}</h1>
        <h1>{l s="Reset your Password" d="Shop.Theme.Reset"}</h1>
      </div>
      <div class="reset-sub">
        <p>{l s='Please enter the email associated with your customer account and click on "Reset" to receive a temporary link allowing you to reset your password.' d="Shop.Theme.Reset"}</p>
        <p>{l s='Click on "Cancel" to return to the main page.' d="Shop.Theme.Reset"}</p>
        <p>{l s='If necessary, you can contact our technical teams by clicking' d="Shop.Theme.Reset"}<a href="{$urls.pages.contact}"> {l s='here' d="Shop.Theme.Reset"}</a>.</p>
      </div>
      <div class="reset-content">
        <div class="form-group">
          <label class="col-md-12 px-0">{l s='Email address' d='Shop.Forms.Labels'}</label>
          <div class="col-md-12 px-0">
            <input type="email" name="email" id="email" value="{if isset($smarty.post.email)}{$smarty.post.email|escape:'html':'UTF-8'}{/if}" class="form-control" required>
          </div>
        </div>
        <div class="col-md-6 pl-0">
            <a class="form-control-submit btn btn-primary col-md-12" href="/"> {l s='Cancel' d='Shop.Theme.Reset'} </a>
        </div>
        <div class="col-md-6 pr-0">
            <button class="form-control-submit btn btn-primary col-md-12" name="submit" type="submit"> {l s='Reset' d='Shop.Theme.Reset'} </button>
        </div>
      </div>
    </div>
  </form>
{/block}
