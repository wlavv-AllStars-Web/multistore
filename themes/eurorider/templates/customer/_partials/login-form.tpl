{include file='_partials/form-errors.tpl' errors=$errors['']}

{* TODO StarterTheme: HOOKS!!! *}

<form id="login-form" action="{$action}" method="post">
  <div>
    {block name='form_fields'}
      {foreach from=$formFields item="field"}
        {block name='form_field'}
          {form_field field=$field}
        {/block}
      {/foreach}
    {/block}
    <div class="forgot-password">
      <a href="{$urls.pages.password}" rel="nofollow">
        {l s='Forgot your password?' d='Shop.Theme.CustomerAccount'}
      </a>
    </div>
  </div>

  <footer class="form-footer text-xs-center clearfix">
    <input type="hidden" name="submitLogin" value="1">
    {block name='form_buttons'}
      <button class="btn btn-primary form-control-submit" data-link-action="sign-in" type="submit">
        {l s='Sign in' d='Shop.Theme.Actions'}
      </button>
    {/block}
  </footer>
</form>
<style>
  #authentication #main {
    width: 100% !important;
    min-height: 57vh;
    display: flex;
  align-items: center;
  }

  #authentication #main #content{
    border: 0 !important;
  }

  #login-form .forgot-password a{
    color: var(--color-text)!important;
  }

  #login-form .forgot-password a:hover{
    color: var(--asm-color)!important;
  }
  
  .register_form .register_form_cell a.button-to-register-form{
    color: #fff !important;
  }
  .register_form .register_form_cell a.button-to-register-form:hover{
    color: #fff !important;
  }

  .register_form .register_form_cell a[data-link-action="display-register-form"]{
    color: var(--color-text);
  }

  .register_form .register_form_cell a[data-link-action="display-register-form"]:hover{
    color: var(--asm-color);
  }
  
  .login_page_content input{
    color: var(--color-text);
  }
</style>