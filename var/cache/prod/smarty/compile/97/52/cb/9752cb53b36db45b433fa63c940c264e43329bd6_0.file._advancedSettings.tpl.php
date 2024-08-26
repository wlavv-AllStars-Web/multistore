<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:19:44
  from '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/_advancedSettings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4a0bfaac5_47185873',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '9752cb53b36db45b433fa63c940c264e43329bd6' => 
    array (
      0 => '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/_advancedSettings.tpl',
      1 => 1673625328,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4a0bfaac5_47185873 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="panel js-worldlineop-advanced-settings-form">
  <form class="form-horizontal"
        action="#"
        name="worldlineop_advanced_settings_form"
        id="worldlineop-advanced-settings-form"
        method="post"
        enctype="multipart/form-data">
    <div class="row">
      <div class="worldlineop-advanced-settings col-xs-12">
        <div class="form-group form-group-h2">
          <h2 class="col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment Settings','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</h2>
          <div class="col-lg-9"></div>
        </div>
        <!-- Transaction Type -->
        <div class="form-group js-worldlineop-transaction-type-block">
          <label class="control-label col-lg-3">
            <span class="label-tooltip"
                  data-toggle="tooltip"
                  data-html="true"
                  data-original-title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Immediate: Authorize & Capture','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Authorized: Authorize only with pending Capture','mod'=>'worldlineop'),$_smarty_tpl ) );?>
">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Transaction type','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </span>
          </label>
          <div class="col-lg-9">
            <div class="radio">
              <label>
                <input type="radio"
                       name="worldlineopAdvancedSettings[paymentSettings][transactionType]"
                       id="worldlineop-type-immediate"
                       value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['const']['TRANSACTION_TYPE_IMMEDIATE'],'html','UTF-8' ));?>
"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['paymentSettings']['transactionType'] === $_smarty_tpl->tpl_vars['data']->value['extra']['const']['TRANSACTION_TYPE_IMMEDIATE']) {?>checked="checked"<?php }?>>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Immediate','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </label>
            </div>
            <div class="radio js-worldlineop-transaction-type-switch">
              <label>
                <input type="radio"
                       name="worldlineopAdvancedSettings[paymentSettings][transactionType]"
                       id="worldlineop-type-auth"
                       value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['const']['TRANSACTION_TYPE_AUTH'],'html','UTF-8' ));?>
"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['paymentSettings']['transactionType'] != $_smarty_tpl->tpl_vars['data']->value['extra']['const']['TRANSACTION_TYPE_IMMEDIATE']) {?>checked="checked"<?php }?>>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Authorized','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </label>
            </div>
          </div>
        </div>
        <!-- /Transaction Type -->
        <div class="js-worldlineop-capture-delay-block">
          <!-- Capture Delay -->
          <div class="form-group">
            <label class="control-label col-lg-3 ">
          <span>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delay before payment capture','mod'=>'worldlineop'),$_smarty_tpl ) );?>

          </span>
            </label>
            <div class="col-lg-9">
              <select name="worldlineopAdvancedSettings[paymentSettings][captureDelay]" class="fixed-width-md">
                <?php
$_smarty_tpl->tpl_vars['day'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['day']->step = 1;$_smarty_tpl->tpl_vars['day']->total = (int) ceil(($_smarty_tpl->tpl_vars['day']->step > 0 ? $_smarty_tpl->tpl_vars['data']->value['extra']['const']['CAPTURE_DELAY_MAX']+1 - ($_smarty_tpl->tpl_vars['data']->value['extra']['const']['CAPTURE_DELAY_MIN']) : $_smarty_tpl->tpl_vars['data']->value['extra']['const']['CAPTURE_DELAY_MIN']-($_smarty_tpl->tpl_vars['data']->value['extra']['const']['CAPTURE_DELAY_MAX'])+1)/abs($_smarty_tpl->tpl_vars['day']->step));
if ($_smarty_tpl->tpl_vars['day']->total > 0) {
for ($_smarty_tpl->tpl_vars['day']->value = $_smarty_tpl->tpl_vars['data']->value['extra']['const']['CAPTURE_DELAY_MIN'], $_smarty_tpl->tpl_vars['day']->iteration = 1;$_smarty_tpl->tpl_vars['day']->iteration <= $_smarty_tpl->tpl_vars['day']->total;$_smarty_tpl->tpl_vars['day']->value += $_smarty_tpl->tpl_vars['day']->step, $_smarty_tpl->tpl_vars['day']->iteration++) {
$_smarty_tpl->tpl_vars['day']->first = $_smarty_tpl->tpl_vars['day']->iteration === 1;$_smarty_tpl->tpl_vars['day']->last = $_smarty_tpl->tpl_vars['day']->iteration === $_smarty_tpl->tpl_vars['day']->total;?>
                  <option value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['day']->value ));?>
"
                          <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['paymentSettings']['captureDelay'] == $_smarty_tpl->tpl_vars['day']->value) {?>selected<?php }?>>
                    <?php if ($_smarty_tpl->tpl_vars['day']->value === 0) {?>
                      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Manual capture','mod'=>'worldlineop'),$_smarty_tpl ) );?>

                    <?php } elseif ($_smarty_tpl->tpl_vars['day']->value === 1) {?>
                      <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['day']->value ));?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'day','mod'=>'worldlineop'),$_smarty_tpl ) );?>

                    <?php } else { ?>
                      <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['day']->value ));?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'days','mod'=>'worldlineop'),$_smarty_tpl ) );?>

                    <?php }?>
                  </option>
                <?php }
}
?>
              </select>
            </div>
            <div class="col-lg-9 col-lg-offset-3">
              <div class="help-block">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Number of days before triggering automatic payment capture','mod'=>'worldlineop'),$_smarty_tpl ) );?>

                <span></span>
              </div>
            </div>
          </div>
          <!-- /Capture Delay -->
          <!-- Capture cronjob -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Capture cronjob','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </span>
            </label>
            <div class="col-lg-9">
              <p class="form-control-static"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cron command example to run capture process 4 times a day:','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</p>
              <p><code><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['path']['controllers']['captureCron'],'htmlall','UTF-8' ));?>
</code></p>
            </div>
          </div>
          <!-- /Capture cronjob -->
        </div>
        <!-- Logs -->
        <div class="form-group">
          <label class="control-label col-lg-3 ">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Enable advanced logging','mod'=>'worldlineop'),$_smarty_tpl ) );?>

          </label>
          <div class="col-lg-9">
            <span class="switch prestashop-switch fixed-width-sm">
              <input type="radio"
                     value="1"
                     name="worldlineopAdvancedSettings[logsEnabled]"
                     id="worldlineopAdvancedSettings_logsEnabled_on"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['logsEnabled'] === true) {?>checked="checked"<?php }?>>
              <label for="worldlineopAdvancedSettings_logsEnabled_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <input type="radio"
                     value="0"
                     name="worldlineopAdvancedSettings[logsEnabled]"
                     id="worldlineopAdvancedSettings_logsEnabled_off"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['logsEnabled'] != true) {?>checked="checked"<?php }?>>
              <label for="worldlineopAdvancedSettings_logsEnabled_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <a class="slide-button btn"></a>
            </span>
          </div>
          <div class="col-lg-9 col-lg-offset-3">
            <div class="help-block">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'The minimum log level will be set to Debug.','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Older files can be accessed on your server, in the "logs" directory of this module.','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              <br/>
              <a href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getAdminLink('AdminWorldlineopLogs',true,array(),array('action'=>'downloadLogFile')),'html','UTF-8' ));?>
">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click here to download the latest file','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </a>
              <span></span>
            </div>
          </div>
        </div>
        <!-- /Logs -->

        <!-- Payment Flow Modifications -->
        <div class="form-group form-group-h2 js-worldlineop-payment-flow-modifications-block">
          <h2 class="col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment Flow Modifications','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</h2>
          <div class="col-lg-9 js-worldlineop-payment-flow-modifications-switch">
            <span class="switch prestashop-switch fixed-width-sm">
              <input type="radio"
                     value="1"
                     name="worldlineopAdvancedSettings[paymentFlowSettingsDisplayed]"
                     id="worldlineopAdvancedSettings_paymentFlowSettingsDisplayed_on"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['paymentFlowSettingsDisplayed'] === true) {?>checked="checked"<?php }?>>
              <label for="worldlineopAdvancedSettings_paymentFlowSettingsDisplayed_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <input type="radio"
                     value="0"
                     name="worldlineopAdvancedSettings[paymentFlowSettingsDisplayed]"
                     id="worldlineopAdvancedSettings_paymentFlowSettingsDisplayed_off"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['paymentFlowSettingsDisplayed'] != true) {?>checked="checked"<?php }?>>
              <label for="worldlineopAdvancedSettings_paymentFlowSettingsDisplayed_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <a class="slide-button btn"></a>
            </span>
          </div>
        </div>
        <!-- /Payment Flow Modifications -->

        <div class="js-worldlineop-payment-flow-modifications-settings-block">
          <div class="alert alert-info">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'We recommend you to use the default settings unless absolutely necessary','mod'=>'worldlineop'),$_smarty_tpl ) );?>

          </div>
          <!-- Payment accepted status mapping -->
          <div class="form-group">
            <label class="control-label col-lg-3" for="worldlineopAdvancedSettings[paymentSettings][successOrderStateId]">
            <span>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment accepted status mapping','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </span>
            </label>
            <div class="col-lg-9">
              <select name="worldlineopAdvancedSettings[paymentSettings][successOrderStateId]" class="fixed-width-xxl">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['extra']['statuses'], 'status');
$_smarty_tpl->tpl_vars['status']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['status']->value) {
$_smarty_tpl->tpl_vars['status']->do_else = false;
?>
                  <option value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['status']->value['id_order_state'] ));?>
"
                          <?php if ($_smarty_tpl->tpl_vars['status']->value['id_order_state'] == $_smarty_tpl->tpl_vars['data']->value['advancedSettings']['paymentSettings']['successOrderStateId']) {?>selected<?php }?>>
                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['status']->value['name'],'html','UTF-8' ));?>

                    <?php if ($_smarty_tpl->tpl_vars['status']->value['id_order_state'] == $_smarty_tpl->tpl_vars['data']->value['extra']['defaultStatuses']['PS_OS_PAYMENT']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(default)','mod'=>'worldlineop'),$_smarty_tpl ) );
}?>
                  </option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </select>
            </div>
          </div>
          <!-- /Payment accepted status mapping -->
          <!-- Payment error status mapping -->
          <div class="form-group">
            <label class="control-label col-lg-3" for="worldlineopAdvancedSettings[paymentSettings][successOrderStateId]">
            <span>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment error status mapping','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </span>
            </label>
            <div class="col-lg-9">
              <select name="worldlineopAdvancedSettings[paymentSettings][errorOrderStateId]" class="fixed-width-xxl">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['extra']['statuses'], 'status');
$_smarty_tpl->tpl_vars['status']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['status']->value) {
$_smarty_tpl->tpl_vars['status']->do_else = false;
?>
                  <option value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['status']->value['id_order_state'] ));?>
"
                          <?php if ($_smarty_tpl->tpl_vars['status']->value['id_order_state'] == $_smarty_tpl->tpl_vars['data']->value['advancedSettings']['paymentSettings']['errorOrderStateId']) {?>selected<?php }?>>
                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['status']->value['name'],'html','UTF-8' ));?>

                    <?php if ($_smarty_tpl->tpl_vars['status']->value['id_order_state'] == $_smarty_tpl->tpl_vars['data']->value['extra']['defaultStatuses']['PS_OS_ERROR']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(default)','mod'=>'worldlineop'),$_smarty_tpl ) );
}?>
                  </option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </select>
            </div>
          </div>
          <!-- /Payment error status mapping -->
          <!-- Payment pending status mapping -->
          <div class="form-group">
            <label class="control-label col-lg-3" for="worldlineopAdvancedSettings[paymentSettings][successOrderStateId]">
            <span>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pending payment status mapping','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </span>
            </label>
            <div class="col-lg-9">
              <select name="worldlineopAdvancedSettings[paymentSettings][pendingOrderStateId]" class="fixed-width-xxl">
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['data']->value['extra']['statuses'], 'status');
$_smarty_tpl->tpl_vars['status']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['status']->value) {
$_smarty_tpl->tpl_vars['status']->do_else = false;
?>
                  <option value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['status']->value['id_order_state'] ));?>
"
                          <?php if ($_smarty_tpl->tpl_vars['status']->value['id_order_state'] == $_smarty_tpl->tpl_vars['data']->value['advancedSettings']['paymentSettings']['pendingOrderStateId']) {?>selected<?php }?>>
                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['status']->value['name'],'html','UTF-8' ));?>

                    <?php if ($_smarty_tpl->tpl_vars['status']->value['id_order_state'] == $_smarty_tpl->tpl_vars['data']->value['extra']['defaultStatuses']['WOP_PENDING_ORDER_STATUS_ID']) {
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(default)','mod'=>'worldlineop'),$_smarty_tpl ) );
}?>
                  </option>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </select>
            </div>
          </div>
          <!-- /Payment pending status mapping -->
          <!-- Safety Delay -->
          <div class="form-group">
            <label class="control-label col-lg-3" for="worldlineopAdvancedSettings[paymentSettings][safetyDelay]">
          <span>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order validation safety delay','mod'=>'worldlineop'),$_smarty_tpl ) );?>

          </span>
            </label>
            <div class="col-lg-9">
              <select name="worldlineopAdvancedSettings[paymentSettings][safetyDelay]" class="fixed-width-md">
                <?php
$_smarty_tpl->tpl_vars['seconds'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['seconds']->step = 1;$_smarty_tpl->tpl_vars['seconds']->total = (int) ceil(($_smarty_tpl->tpl_vars['seconds']->step > 0 ? $_smarty_tpl->tpl_vars['data']->value['extra']['const']['SAFETY_DELAY_MAX']+1 - ($_smarty_tpl->tpl_vars['data']->value['extra']['const']['SAFETY_DELAY_MIN']) : $_smarty_tpl->tpl_vars['data']->value['extra']['const']['SAFETY_DELAY_MIN']-($_smarty_tpl->tpl_vars['data']->value['extra']['const']['SAFETY_DELAY_MAX'])+1)/abs($_smarty_tpl->tpl_vars['seconds']->step));
if ($_smarty_tpl->tpl_vars['seconds']->total > 0) {
for ($_smarty_tpl->tpl_vars['seconds']->value = $_smarty_tpl->tpl_vars['data']->value['extra']['const']['SAFETY_DELAY_MIN'], $_smarty_tpl->tpl_vars['seconds']->iteration = 1;$_smarty_tpl->tpl_vars['seconds']->iteration <= $_smarty_tpl->tpl_vars['seconds']->total;$_smarty_tpl->tpl_vars['seconds']->value += $_smarty_tpl->tpl_vars['seconds']->step, $_smarty_tpl->tpl_vars['seconds']->iteration++) {
$_smarty_tpl->tpl_vars['seconds']->first = $_smarty_tpl->tpl_vars['seconds']->iteration === 1;$_smarty_tpl->tpl_vars['seconds']->last = $_smarty_tpl->tpl_vars['seconds']->iteration === $_smarty_tpl->tpl_vars['seconds']->total;?>
                  <option value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['seconds']->value ));?>
"
                          <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['paymentSettings']['safetyDelay'] == $_smarty_tpl->tpl_vars['seconds']->value) {?>selected<?php }?>>
                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['seconds']->value ));?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'seconds','mod'=>'worldlineop'),$_smarty_tpl ) );?>

                  </option>
                <?php }
}
?>
              </select>
            </div>
            <div class="col-lg-9 col-lg-offset-3">
              <div class="help-block">
                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If you use the split order feature, activate this option to gracefully handle the duplication of the order by retaining any incoming webhook for the determined period','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </div>
            </div>
          </div>
          <!-- /Safety Delay -->
          <!-- Retention Delay -->
          <div class="form-group">
            <label class="control-label col-lg-3" for="worldlineopAdvancedSettings[paymentSettings][retentionHours]">
            <span>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Release inventory from Pending payment orders after','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </span>
            </label>
            <div class="col-lg-9">
              <select name="worldlineopAdvancedSettings[paymentSettings][retentionHours]" class="fixed-width-md">
                <?php
$_smarty_tpl->tpl_vars['hours'] = new Smarty_Variable(null, $_smarty_tpl->isRenderingCache);$_smarty_tpl->tpl_vars['hours']->step = 1;$_smarty_tpl->tpl_vars['hours']->total = (int) ceil(($_smarty_tpl->tpl_vars['hours']->step > 0 ? $_smarty_tpl->tpl_vars['data']->value['extra']['const']['RETENTION_DELAY_MAX']+1 - ($_smarty_tpl->tpl_vars['data']->value['extra']['const']['RETENTION_DELAY_MIN']) : $_smarty_tpl->tpl_vars['data']->value['extra']['const']['RETENTION_DELAY_MIN']-($_smarty_tpl->tpl_vars['data']->value['extra']['const']['RETENTION_DELAY_MAX'])+1)/abs($_smarty_tpl->tpl_vars['hours']->step));
if ($_smarty_tpl->tpl_vars['hours']->total > 0) {
for ($_smarty_tpl->tpl_vars['hours']->value = $_smarty_tpl->tpl_vars['data']->value['extra']['const']['RETENTION_DELAY_MIN'], $_smarty_tpl->tpl_vars['hours']->iteration = 1;$_smarty_tpl->tpl_vars['hours']->iteration <= $_smarty_tpl->tpl_vars['hours']->total;$_smarty_tpl->tpl_vars['hours']->value += $_smarty_tpl->tpl_vars['hours']->step, $_smarty_tpl->tpl_vars['hours']->iteration++) {
$_smarty_tpl->tpl_vars['hours']->first = $_smarty_tpl->tpl_vars['hours']->iteration === 1;$_smarty_tpl->tpl_vars['hours']->last = $_smarty_tpl->tpl_vars['hours']->iteration === $_smarty_tpl->tpl_vars['hours']->total;?>
                  <?php if ($_smarty_tpl->tpl_vars['hours']->value%3 === 0) {?>
                    <option value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['hours']->value ));?>
"
                            <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['paymentSettings']['retentionHours'] == $_smarty_tpl->tpl_vars['hours']->value) {?>selected<?php }?>>
                      <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['hours']->value ));?>
 <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'hours','mod'=>'worldlineop'),$_smarty_tpl ) );?>

                    </option>
                  <?php }?>
                <?php }
}
?>
              </select>
            </div>
          </div>
          <!-- /Retention Delay -->
          <!-- Pending cronjob -->
          <div class="form-group">
            <label class="control-label col-lg-3">
            <span>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pending cronjob','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </span>
            </label>
            <div class="col-lg-9">
              <p class="form-control-static"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cron command example to run process every hour:','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</p>
              <p><code><?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['path']['controllers']['pendingCron'],'htmlall','UTF-8' ));?>
</code></p>
            </div>
          </div>
          <!-- /Pending cronjob -->
          <!-- Switch Endpoint -->
          <div class="form-group form-group-h2 js-worldlineop-switch-endpoint-block">
            <label class="control-label col-lg-3 "><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Switch endpoint','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
            <div class="col-lg-9 js-worldlineop-switch-endpoint-switch">
            <span class="switch prestashop-switch fixed-width-sm">
              <input type="radio"
                     value="1"
                     name="worldlineopAdvancedSettings[switchEndpoint]"
                     id="worldlineopAdvancedSettings_switchEndpoint_on"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['switchEndpoint'] === true) {?>checked="checked"<?php }?>>
              <label for="worldlineopAdvancedSettings_switchEndpoint_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <input type="radio"
                     value="0"
                     name="worldlineopAdvancedSettings[switchEndpoint]"
                     id="worldlineopAdvancedSettings_switchEndpoint_off"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['switchEndpoint'] != true) {?>checked="checked"<?php }?>>
              <label for="worldlineopAdvancedSettings_switchEndpoint_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <a class="slide-button btn"></a>
            </span>
            </div>
          </div>
          <!-- /Switch Endpoint -->

          <div class="js-worldlineop-switch-endpoint-settings-block">
            <!-- Test Endpoint -->
            <div class="form-group">
              <label class="control-label col-lg-3">
                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Test Endpoint','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
              </label>
              <div class="col-lg-9">
                <div class="fixed-width-xxl">
                  <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['advancedSettings']['testEndpoint'],'htmlall','UTF-8' ));?>
"
                         type="text"
                         name="worldlineopAdvancedSettings[testEndpoint]"
                         class="input fixed-width-xxl">
                </div>
              </div>
            </div>
            <!-- /Test Endpoint -->
            <!-- Prod Endpoint -->
            <div class="form-group">
              <label class="control-label col-lg-3">
                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Prod Endpoint','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
              </label>
              <div class="col-lg-9">
                <div class="fixed-width-xxl">
                  <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['advancedSettings']['prodEndpoint'],'htmlall','UTF-8' ));?>
"
                         type="text"
                         name="worldlineopAdvancedSettings[prodEndpoint]"
                         class="input fixed-width-xxl">
                </div>
              </div>
            </div>
            <!-- /Prod Endpoint -->
          </div>
        </div>
        <div class="form-group form-group-h2">
          <h2 class="col-lg-3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Checkout Flow Modifications','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</h2>
          <div class="col-lg-9"></div>
        </div>
        <!-- Group cards -->
        <div class="form-group">
          <label class="control-label col-lg-3 ">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Group payment options by card','mod'=>'worldlineop'),$_smarty_tpl ) );?>

          </label>
          <div class="col-lg-9">
            <span class="switch prestashop-switch fixed-width-sm">
              <input type="radio"
                     value="1"
                     name="worldlineopAdvancedSettings[groupCardPaymentOptions]"
                     id="worldlineopAdvancedSettings_groupCardPaymentOptions_on"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['groupCardPaymentOptions'] === true) {?>checked="checked"<?php }?>>
              <label for="worldlineopAdvancedSettings_groupCardPaymentOptions_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <input type="radio"
                     value="0"
                     name="worldlineopAdvancedSettings[groupCardPaymentOptions]"
                     id="worldlineopAdvancedSettings_groupCardPaymentOptions_off"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['groupCardPaymentOptions'] != true) {?>checked="checked"<?php }?>>
              <label for="worldlineopAdvancedSettings_groupCardPaymentOptions_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <a class="slide-button btn"></a>
            </span>
          </div>
          <div class="col-lg-9 col-lg-offset-3">
            <div class="help-block">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Only for the generic payment option. If you choose to group payment options by card, the customer will have one unique choice for cards instead of x choices.','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              <span></span>
            </div>
          </div>
        </div>
        <!-- /Group cards -->
        <!-- Force 3DsV2 -->
        <div class="form-group js-worldlineop-switch-force-3ds-block">
          <label class="control-label col-lg-3 ">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Force 3DsV2','mod'=>'worldlineop'),$_smarty_tpl ) );?>

          </label>
          <div class="col-lg-9 js-worldlineop-switch-force-3ds-switch">
              <span class="switch prestashop-switch fixed-width-sm">
                <input type="radio"
                       value="1"
                       name="worldlineopAdvancedSettings[force3DsV2]"
                       id="worldlineopAdvancedSettings_force3DsV2_on"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['force3DsV2'] === true) {?>checked="checked"<?php }?>>
                <label for="worldlineopAdvancedSettings_force3DsV2_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
                <input type="radio"
                       value="0"
                       name="worldlineopAdvancedSettings[force3DsV2]"
                       id="worldlineopAdvancedSettings_force3DsV2_off"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['force3DsV2'] != true) {?>checked="checked"<?php }?>>
                <label for="worldlineopAdvancedSettings_force3DsV2_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
                <a class="slide-button btn"></a>
              </span>
          </div>
          <div class="col-lg-9 col-lg-offset-3">
            <div class="help-block">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'It is mandatory to enforce 3DsV2 in Europe, but can be turned off for other geographies','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </div>
          </div>
        </div>
        <!-- /Force 3DsV2 -->
        <div class="js-worldlineop-force-3ds-disabled-block">
          <!-- Enforce 3DS -->
          <div class="form-group js-worldlineop-enforce-challenge-block">
            <label class="control-label col-lg-3 ">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Request challenge on all cards transactions','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </label>
            <div class="col-lg-9 js-worldlineop-enforce-challenge-switch">
              <span class="switch prestashop-switch fixed-width-sm">
                <input type="radio"
                       value="1"
                       name="worldlineopAdvancedSettings[enforce3DS]"
                       id="worldlineopAdvancedSettings_enforce3DS_on"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['enforce3DS'] === true) {?>checked="checked"<?php }?>>
                <label for="worldlineopAdvancedSettings_enforce3DS_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
                <input type="radio"
                       value="0"
                       name="worldlineopAdvancedSettings[enforce3DS]"
                       id="worldlineopAdvancedSettings_enforce3DS_off"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['enforce3DS'] != true) {?>checked="checked"<?php }?>>
                <label for="worldlineopAdvancedSettings_enforce3DS_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
                <a class="slide-button btn"></a>
              </span>
            </div>
            <div class="col-lg-9 col-lg-offset-3">
              <div class="help-block">
              </div>
            </div>
          </div>
          <!-- /Enforce 3DS -->
          <!-- 3DS Exemption -->
          <div class="form-group js-worldlineop-3ds-exemption-block">
            <label class="control-label col-lg-3 ">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Exempt transactions from 3DS','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </label>
            <div class="col-lg-9">
              <span class="switch prestashop-switch fixed-width-sm">
                <input type="radio"
                       value="1"
                       name="worldlineopAdvancedSettings[threeDSExempted]"
                       id="worldlineopAdvancedSettings_threeDSExempted_on"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['threeDSExempted'] === true) {?>checked="checked"<?php }?>>
                <label for="worldlineopAdvancedSettings_threeDSExempted_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
                <input type="radio"
                       value="0"
                       name="worldlineopAdvancedSettings[threeDSExempted]"
                       id="worldlineopAdvancedSettings_threeDSExempted_off"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['advancedSettings']['threeDSExempted'] != true) {?>checked="checked"<?php }?>>
                <label for="worldlineopAdvancedSettings_threeDSExempted_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
                <a class="slide-button btn"></a>
              </span>
            </div>
            <div class="col-lg-9 col-lg-offset-3">
              <div class="help-block">
                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'When enabled, transactions with an order amount < 30 EUR will be exempted from 3DS','mod'=>'worldlineop'),$_smarty_tpl ) );?>

                <span></span>
              </div>
            </div>
          </div>
          <!-- /3DS Exemption -->
        </div>

        <input type="hidden" name="action" value="saveAdvancedSettingsForm"/>
      </div>
    </div>
    <div class="panel-footer">
      <button type="submit" class="btn btn-default pull-right" name="submitSaveAdvancedSettingsForm">
        <i class="process-icon-save"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save','mod'=>'worldlineop'),$_smarty_tpl ) );?>

      </button>
    </div>
  </form>
</div>
<?php }
}
