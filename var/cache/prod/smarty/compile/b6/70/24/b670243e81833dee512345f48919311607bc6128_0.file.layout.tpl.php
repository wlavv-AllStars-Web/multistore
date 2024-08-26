<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:19:44
  from '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/layout.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4a0b9b156_14415220',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b670243e81833dee512345f48919311607bc6128' => 
    array (
      0 => '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/layout.tpl',
      1 => 1673625328,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./_header.tpl' => 1,
    'file:./_account.tpl' => 1,
    'file:./_advancedSettings.tpl' => 1,
    'file:./_paymentMethodsSettings.tpl' => 1,
  ),
),false)) {
function content_66c6f4a0b9b156_14415220 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="row">
  <div class="col-lg-10 col-lg-offset-1">
    <div id="worldlineop-configuration">
      <div class="worldlineop-information">
        <i class="icon icon-info-circle"></i>
        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Worldline Online Payments module','mod'=>'worldlineop'),$_smarty_tpl ) );?>
 v<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['moduleVersion'],'html','UTF-8' ));?>
 -
        <a data-toggle="modal"
           data-target="#worldlineop-modal-whatsnew"
           href="#">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'What\'s new?','mod'=>'worldlineop'),$_smarty_tpl ) );?>

        </a>
      </div>
      <?php $_smarty_tpl->_subTemplateRender("file:./_header.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
      <div class="form-wrapper">
        <ul class="nav nav-tabs">
          <li <?php if ($_smarty_tpl->tpl_vars['data']->value['activeTab'] == 'account') {?>class="active"<?php }?>>
            <a href="#account" data-toggle="tab">
              <i class="icon icon-user"></i>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My account','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </a>
          </li>
          <li class="js-tab-advanced<?php if ($_smarty_tpl->tpl_vars['data']->value['activeTab'] == 'advancedSettings') {?> active<?php }?>">
            <a href="#advanced-settings" data-toggle="tab">
              <i class="icon icon-cogs"></i>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Advanced Settings','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </a>
          </li>
          <li class="js-tab-advanced<?php if ($_smarty_tpl->tpl_vars['data']->value['activeTab'] == 'paymentMethods') {?> active<?php }?>">
            <a href="#payment-methods" data-toggle="tab">
              <i class="icon icon-credit-card"></i>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment Methods','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </a>
          </li>
          <li class="js-worldlineop-advanced-settings-block worldlineop-advanced-settings-block">
            <div class="js-worldlineop-advanced-settings-switch">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Show advanced settings','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              <span class="switch prestashop-switch fixed-width-sm">
                <input type="radio"
                       value="1"
                       name="worldlineopAdvancedSettings[advancedSettingsEnabled]"
                       id="worldlineopAdvancedSettings_advancedSettingsEnabled_on"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['extra']['advancedSettingsEnabled'] === 'true') {?>checked="checked"<?php }?>>
                <label for="worldlineopAdvancedSettings_advancedSettingsEnabled_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
                <input type="radio"
                       value="0"
                       name="worldlineopAdvancedSettings[advancedSettingsEnabled]"
                       id="worldlineopAdvancedSettings_advancedSettingsEnabled_off"
                       <?php if ($_smarty_tpl->tpl_vars['data']->value['extra']['advancedSettingsEnabled'] != 'true') {?>checked="checked"<?php }?>>
                <label for="worldlineopAdvancedSettings_advancedSettingsEnabled_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
                <a class="slide-button btn"></a>
              </span>
            </div>
          </li>
        </ul>
        <div class="tab-content panel">
          <div id="account" class="tab-pane <?php if ($_smarty_tpl->tpl_vars['data']->value['activeTab'] == 'account') {?>active<?php }?>">
            <?php $_smarty_tpl->_subTemplateRender("file:./_account.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
          </div>
          <div id="advanced-settings" class="tab-pane <?php if ($_smarty_tpl->tpl_vars['data']->value['activeTab'] == 'advancedSettings') {?>active<?php }?>">
            <?php $_smarty_tpl->_subTemplateRender("file:./_advancedSettings.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
          </div>
          <div id="payment-methods" class="tab-pane <?php if ($_smarty_tpl->tpl_vars['data']->value['activeTab'] == 'paymentMethods') {?>active<?php }?>">
            <?php $_smarty_tpl->_subTemplateRender("file:./_paymentMethodsSettings.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php echo '<script'; ?>
 type="text/javascript">
  var languages = new Array();

  // Multilang field setup must happen before document is ready so that calls to displayFlags() to avoid
  // precedence conflicts with other document.ready() blocks
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language', false, 'k');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
  languages[<?php echo $_smarty_tpl->tpl_vars['k']->value;?>
] = {
    id_lang: <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['id_lang'],'javascript','UTF-8' ));?>
,
    iso_code: '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['iso_code'],'javascript','UTF-8' ));?>
',
    name: '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['name'],'javascript','UTF-8' ));?>
',
    is_default: '<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['is_default'],'javascript','UTF-8' ));?>
'
  };
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);
echo '</script'; ?>
>
<?php }
}
