<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:19:44
  from '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/_account.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4a0bbd4c7_16227397',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '8573311f093ba5338da5f7bc83b0735408fb3647' => 
    array (
      0 => '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/_account.tpl',
      1 => 1673625328,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4a0bbd4c7_16227397 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="panel js-worldlineop-account-form">
  <form class="form-horizontal"
        action="#"
        name="worldlineop_account_form"
        id="worldlineop-account-form"
        method="post"
        enctype="multipart/form-data">
    <div class="row">
      <div class="worldlineop-account col-xs-12">
        <!-- Environment -->
        <div class="form-group js-worldlineop-env-block">
          <label class="control-label col-lg-3">
            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Environment','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
          </label>
          <div class="col-lg-9 js-worldlineop-env-switch">
            <div class="radio">
              <label>
                <input type="radio"
                       name="worldlineopAccountSettings[environment]"
                       id="worldlineop-mode-test"
                       value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['const']['ACCOUNT_MODE_TEST'],'html','UTF-8' ));?>
"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['accountSettings']['environment'] != $_smarty_tpl->tpl_vars['data']->value['extra']['const']['ACCOUNT_MODE_PROD']) {?>checked="checked"<?php }?>>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Test','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </label>
            </div>
            <div class="radio">
              <label>
                <input type="radio"
                       name="worldlineopAccountSettings[environment]"
                       id="worldlineop-mode-prod"
                       value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['const']['ACCOUNT_MODE_PROD'],'html','UTF-8' ));?>
"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['accountSettings']['environment'] == $_smarty_tpl->tpl_vars['data']->value['extra']['const']['ACCOUNT_MODE_PROD']) {?>checked="checked"<?php }?>>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Production','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </label>
            </div>
          </div>
        </div>
        <!-- /Environment -->
        <div class="js-worldlineop-env-test-block">
          <h2 class="col-lg-offset-3 col-lg-9"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Test credentials','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</h2>
          <!-- Test PSPID -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Test PSPID','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <div class="fixed-width-xxl">
                <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['accountSettings']['testPspid'],'htmlall','UTF-8' ));?>
"
                       type="text"
                       name="worldlineopAccountSettings[testPspid]"
                       class="input fixed-width-xxl">
              </div>
            </div>
          </div>
          <!-- /Test PSPID -->
          <div class="alert alert-info">
            <p class="text-info">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To retrieve the API Key and API secret in your PSPID, follow these steps:','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </p>
            <p class="text-info">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> Login to the Back Office. Go to Configuration > Technical information > Ingenico Direct Settings > Direct API Key','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> If you have not configured anything yet, the screen shows "No API credentials found". To create both API Key and API Secret click on "GENERATE"','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </p>
          </div>
          <!-- Test API Key -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Test API Key','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <div class="fixed-width-xxl">
                <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['accountSettings']['testApiKey'],'htmlall','UTF-8' ));?>
"
                       type="text"
                       name="worldlineopAccountSettings[testApiKey]"
                       class="input fixed-width-xxl">
              </div>
            </div>
          </div>
          <!-- /Test API Key -->
          <!-- Test API Secret -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Test API Secret','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <div class="fixed-width-xxl">
                <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['accountSettings']['testApiSecret'],'htmlall','UTF-8' ));?>
"
                       type="text"
                       name="worldlineopAccountSettings[testApiSecret]"
                       class="input fixed-width-xxl">
              </div>
            </div>
          </div>
          <!-- /Test API Secret -->
          <div class="alert alert-info">
            <p class="text-info">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To retrieve the webhooks credentials, login to the Back Office.','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Go to Configuration > Technical information > Ingenico Direct settings > Webhooks Configuration and perform the following steps:','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </p>
            <p class="text-info">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> Click on "GENERATE WEBHOOKS API KEY"','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> Copy & Paste the WebhooksKeySecret immediately','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> In "Endpoints URLs", paste the Webhooks URL of your store - see below','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> Click on "SAVE" to confirm your settings','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </p>
            <p>
              <i class="icon icon-warning"></i>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If you have several shops & different credentials, please configure your Worldline portals for each shops/accounts.','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </p>
          </div>
          <!-- Test Webhooks Key -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Test Webhooks Key','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <div class="fixed-width-xxl">
                <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['accountSettings']['testWebhooksKey'],'htmlall','UTF-8' ));?>
"
                       type="text"
                       name="worldlineopAccountSettings[testWebhooksKey]"
                       class="input fixed-width-xxl">
              </div>
            </div>
          </div>
          <!-- /Test Webhooks Key -->
          <!-- Test Webhooks Secret -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Test Webhooks Secret','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <div class="fixed-width-xxl">
                <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['accountSettings']['testWebhooksSecret'],'htmlall','UTF-8' ));?>
"
                       type="text"
                       name="worldlineopAccountSettings[testWebhooksSecret]"
                       class="input fixed-width-xxl">
              </div>
            </div>
          </div>
        </div>
        <!-- /Test Webhooks Secret -->
        <div class="js-worldlineop-env-prod-block">
          <h2 class="col-lg-offset-3 col-lg-9"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Production credentials','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</h2>
          <!-- Prod PSPID -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Prod PSPID','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <div class="fixed-width-xxl">
                <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['accountSettings']['prodPspid'],'htmlall','UTF-8' ));?>
"
                       type="text"
                       name="worldlineopAccountSettings[prodPspid]"
                       class="input fixed-width-xxl">
              </div>
            </div>
          </div>
          <!-- /Prod PSPID -->
          <div class="alert alert-info">
            <p class="text-info">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To retrieve the API Key and API secret in your PSPID, follow these steps:','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </p>
            <p class="text-info">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> Login to the Back Office. Go to Configuration > Technical information > Ingenico Direct Settings > Direct API Key','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> If you have not configured anything yet, the screen shows "No API credentials found". To create both API Key and API Secret click on "GENERATE"','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </p>
          </div>
          <!-- Prod API Key -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Prod API Key','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <div class="fixed-width-xxl">
                <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['accountSettings']['prodApiKey'],'htmlall','UTF-8' ));?>
"
                       type="text"
                       name="worldlineopAccountSettings[prodApiKey]"
                       class="input fixed-width-xxl">
              </div>
            </div>
          </div>
          <!-- /Prod API Key -->
          <!-- Prod API Secret -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Prod API Secret','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <div class="fixed-width-xxl">
                <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['accountSettings']['prodApiSecret'],'htmlall','UTF-8' ));?>
"
                       type="text"
                       name="worldlineopAccountSettings[prodApiSecret]"
                       class="input fixed-width-xxl">
              </div>
            </div>
          </div>
          <!-- /Prod API Secret -->
          <div class="alert alert-info">
            <p class="text-info">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To retrieve the webhooks credentials, login to the Back Office.','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Go to Configuration > Technical information > Ingenico Direct settings > Webhooks Configuration and perform the following steps:','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </p>
            <p class="text-info">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> Click on "GENERATE WEBHOOKS API KEY"','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> Copy & Paste the WebhooksKeySecret immediately','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> In "Endpoints URLs", paste the Webhooks URL of your store - see below','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'> Click on "SAVE" to confirm your settings','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </p>
            <p class="text-info">
              <i class="icon icon-warning"></i>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If you have several shops & different credentials, please configure your Worldline portals for each shops/accounts.','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </p>
          </div>
          <!-- Prod Webhooks Key -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Prod Webhooks Key','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <div class="fixed-width-xxl">
                <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['accountSettings']['prodWebhooksKey'],'htmlall','UTF-8' ));?>
"
                       type="text"
                       name="worldlineopAccountSettings[prodWebhooksKey]"
                       class="input fixed-width-xxl">
              </div>
            </div>
          </div>
          <!-- /Prod Webhooks Key -->
          <!-- Prod Webhooks Secret -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Prod Webhooks Secret','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <div class="fixed-width-xxl">
                <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['accountSettings']['prodWebhooksSecret'],'htmlall','UTF-8' ));?>
"
                       type="text"
                       name="worldlineopAccountSettings[prodWebhooksSecret]"
                       class="input fixed-width-xxl">
              </div>
            </div>
          </div>
          <!-- /Prod Webhooks Secret -->
        </div>
        <!-- Webhooks URL -->
        <div class="form-group worldlineop-webhooks-block">
          <label class="control-label col-lg-3">
            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Webhooks URL','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
          </label>
          <div class="col-lg-9">
            <div class="form-control-static">
              <code id="js-webhooks-code"><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['path']['controllers']['webhooks'],'htmlall','UTF-8' ));?>
</code>
              <i class="icon icon-copy js-icon-copy"></i>
            </div>
          </div>
          <div class="col-lg-offset-3 col-lg-9">
            <div class="help-block">
              <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'To avoid copy/paste issue, use the "copy" icon to copy the URL','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</p>
            </div>
          </div>
        </div>
        <!-- /Webhooks URL -->
        <input type="hidden" name="action" value="saveAccountForm"/>
      </div>
    </div>
    <div class="panel-footer">
      <button type="submit" class="btn btn-default pull-right" name="submitSaveAccountForm">
        <i class="process-icon-save"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save','mod'=>'worldlineop'),$_smarty_tpl ) );?>

      </button>
      <button type="submit" class="btn btn-default pull-right" name="submitTestCredentialsForm">
        <i class="process-icon-ok"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save & Check credentials','mod'=>'worldlineop'),$_smarty_tpl ) );?>

      </button>
    </div>
  </form>
</div>


<?php echo '<script'; ?>
 type="text/javascript">
  function copyInput($input) {
    let range = document.createRange();
    let sel = window.getSelection();

    range.setStartBefore($input.firstChild);
    range.setEndAfter($input.lastChild);
    sel.removeAllRanges();
    sel.addRange(range);

    try {
      document.execCommand('copy');
      showSuccessMessage(copyMessage);
    } catch (err) {
      console.error('Unable to copy');
    }
  }

  $('.js-icon-copy').on('click', function (e) {
    copyInput(document.getElementById('js-webhooks-code'));
  });
<?php echo '</script'; ?>
>

<?php }
}
