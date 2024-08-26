<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:19:44
  from '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/_paymentMethodsSettings.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4a0c3bd70_58357240',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '877fd632b9d9d5a1e222063d22cba2730b579037' => 
    array (
      0 => '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/_paymentMethodsSettings.tpl',
      1 => 1673625328,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:./_paymentMethodsList.tpl' => 2,
  ),
),false)) {
function content_66c6f4a0c3bd70_58357240 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="panel js-worldlineop-payment-methods-settings-form">
  <form class="form-horizontal"
        action="#"
        name="worldlineop_payment_methods_settings_form"
        id="worldlineop-payment-methods-settings-form"
        method="post"
        enctype="multipart/form-data">
    <div class="row">
      <div class="worldlineop-payment-methods-settings col-xs-12">
        <div class="alert alert-info">
          <p>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'In this section, you can customize the display of your payment methods to pay in:','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            <ul>
              <li><b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Redirect mode','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</b> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(All payment methods) Customers will complete the PAYMENT ON REDIRECTION to a Worldline Hosted Page','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</li>
              <li><b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'One page checkout','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</b> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(Cards only) Customers will complete the PAYMENT ON YOUR WEBSITE itself with an embedded iFrame (no redirection)','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</li>
            </ul>
          </p>
          <p>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please note that you can fully customize the payment page by setting the name of a template you created previously in the File Manager, on the Worldline portal.','mod'=>'worldlineop'),$_smarty_tpl ) );?>

          </p>
        </div>

        <h3 class="title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Redirect Mode (All Payment Methods)','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</h3>
        <!-- Display Generic Button -->
        <div class="form-group">
          <label class="control-label col-lg-3 ">
            <span>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment method selection after redirect','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
            </span>
          </label>
          <div class="col-lg-9">
            <span class="switch prestashop-switch fixed-width-xl">
              <input type="radio"
                     value="1"
                     name="worldlineopPaymentMethodsSettings[displayGenericOption]"
                     id="worldlineopPaymentMethodsSettings_displayGenericOption_on"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['displayGenericOption'] === true) {?>checked="checked"<?php }?>>
              <label for="worldlineopPaymentMethodsSettings_displayGenericOption_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <input type="radio"
                     value="0"
                     name="worldlineopPaymentMethodsSettings[displayGenericOption]"
                     id="worldlineopPaymentMethodsSettings_displayGenericOption_off"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['displayGenericOption'] != true) {?>checked="checked"<?php }?>>
              <label for="worldlineopPaymentMethodsSettings_displayGenericOption_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <a class="slide-button btn"></a>
            </span>
          </div>
          <div class="col-lg-9 col-lg-offset-3">
            <div class="help-block">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'A unique pay button to be redirected to pay on Worldline hosted page','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </div>
          </div>
        </div>
        <!-- /Display Generic Button -->
        <!-- Generic Logo -->
        <div class="form-group">
          <label class="control-label col-lg-3 ">
              <span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Generic logo displayed on your payment page','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </span>
          </label>
          <div class="col-lg-9">
              <?php if ($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['genericLogoFilename']) {?>
                <img class="preview-logo"
                     src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['path']['img'],'html','UTF-8' ));?>
payment_logos/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['genericLogoFilename'],'html','UTF-8' ));?>
"/>
              <?php }?>
            <input type="file"
                   name="worldlineopPaymentMethodsSettings[genericLogo]"
                   id="worldlineopPaymentMethodsSettings[genericLogo]"
                   class="worldlineop-upload js-worldlineop-upload"/>
            <label for="worldlineopPaymentMethodsSettings[genericLogo]">
              <i class="icon icon-upload"></i>
              <span>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Upload','mod'=>'worldlineop'),$_smarty_tpl ) );?>

                  </span>
            </label>
          </div>
          <div class="col-lg-9 col-lg-offset-3">
              <?php if ($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['genericLogoFilename']) {?>
                <input type="checkbox" id="worldlineopPaymentMethodsSettings[deleteGenericLogo]" name="worldlineopPaymentMethodsSettings[deleteGenericLogo]" />
                <label for="worldlineopPaymentMethodsSettings[deleteGenericLogo]"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete current logo','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <?php }?>
            <div class="help-block">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can upload here a new logo (file types accepted for logos are: .png .gif .jpg only)','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br/>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'We recommend that you use images with 20px height & 120px length maximum','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              <span></span>
            </div>
          </div>
        </div>
        <!-- /Generic Logo -->
        <!-- Redirect CTA -->
        <div class="form-group">
          <label class="control-label col-lg-3 ">
            <span>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pay button title','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </span>
          </label>
          <div class="col-lg-9">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
              <div class="translatable-field flex lang-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['id_lang'] ));?>
" <?php if ($_smarty_tpl->tpl_vars['language']->value['iso_code'] != $_smarty_tpl->tpl_vars['lang_iso']->value) {?>style="display:none;"<?php }?>>
                <div class="col-lg-5">
                  <input type="text"
                         id="worldlineop-redirect-cta-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['id_lang'] ));?>
"
                         name="worldlineopPaymentMethodsSettings[redirectCallToAction][<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['iso_code'],'html','UTF-8' ));?>
]"
                         class=""
                         value="<?php if ((isset($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['redirectCallToAction'][$_smarty_tpl->tpl_vars['language']->value['iso_code']]))) {
echo $_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['redirectCallToAction'][call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['iso_code'],'html','UTF-8' ))];
}?>">
                </div>
                <div class="col-lg-2">
                  <button type="button"
                          class="btn btn-default dropdown-toggle"
                          tabindex="-1"
                          data-toggle="dropdown">
                    <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['iso_code'],'html','UTF-8' ));?>

                    <i class="icon-caret-down"></i>
                  </button>
                  <ul class="dropdown-menu">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
                      <li>
                        <a href="javascript:hideOtherLanguage(<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['id_lang'] ));?>
);" tabindex="-1">
                          <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['name'],'html','UTF-8' ));?>

                        </a>
                      </li>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </ul>
                </div>
              </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </div>
          <div class="col-lg-9 col-lg-offset-3">
            <div class="help-block">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Title of the payment selection button on your checkout page','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              <span></span>
            </div>
          </div>
        </div>
        <!-- /Redirect CTA -->
        <!-- Display Payment Options -->
        <div class="form-group js-worldlineop-display-redirect-pm-block">
          <label class="control-label col-lg-3">
            <span>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment method selection before redirect','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
            </span>
          </label>
          <div class="col-lg-9 js-worldlineop-display-redirect-pm-switch">
            <span class="switch prestashop-switch fixed-width-xl">
              <input type="radio"
                     value="1"
                     name="worldlineopPaymentMethodsSettings[displayRedirectPaymentOptions]"
                     id="worldlineopPaymentMethodsSettings_displayRedirectPaymentOptions_on"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['displayRedirectPaymentOptions'] === true) {?>checked="checked"<?php }?>>
              <label for="worldlineopPaymentMethodsSettings_displayRedirectPaymentOptions_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <input type="radio"
                     value="0"
                     name="worldlineopPaymentMethodsSettings[displayRedirectPaymentOptions]"
                     id="worldlineopPaymentMethodsSettings_displayRedirectPaymentOptions_off"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['displayRedirectPaymentOptions'] != true) {?>checked="checked"<?php }?>>
              <label for="worldlineopPaymentMethodsSettings_displayRedirectPaymentOptions_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <a class="slide-button btn"></a>
            </span>
          </div>
          <div class="col-lg-9 col-lg-offset-3">
            <div class="help-block">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Each payment method identified by a button. On click, customer is redirected to pay on Worldline Online Payments page','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </div>
          </div>
        </div>
        <!-- /Display Payment Options -->
        <!-- Redirect payment methods list -->
        <div class="js-worldlineop-redirect-payment-methods-block">
          <div class="row">
            <div class="col-lg-offset-3 col-lg-9">
              <button class="btn btn-default js-worldlineop-refresh-redirect-pm-btn">
                <i class="icon icon-refresh"></i>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refresh list of available payment methods','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </button>
            </div>
          </div>
          <div id="js-worldlineop-redirect-payment-methods-list" class="worldlineop-payment-methods-list">
            <?php $_smarty_tpl->_subTemplateRender("file:./_paymentMethodsList.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"redirect",'name'=>"redirectPaymentMethods"), 0, false);
?>
          </div>
        </div>
        <!-- /Redirect payment methods list -->
        <!-- Template filename -->
        <div class="form-group">
          <label class="control-label col-lg-3">
            <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Template filename for redirect payment','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
          </label>
          <div class="col-lg-9">
            <div class="fixed-width-xxl">
              <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['redirectTemplateFilename'],'htmlall','UTF-8' ));?>
"
                     type="text"
                     name="worldlineopPaymentMethodsSettings[redirectTemplateFilename]"
                     class="input fixed-width-xxl">
            </div>
          </div>
          <div class="col-lg-9 col-lg-offset-3">
            <div class="help-block">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If you are using a customized template, please enter the name here. If empty, the standard payment page will be displayed.','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment page look and feel can be customized on Worldline Back Office.','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </div>
          </div>
        </div>
        <!-- /Template filename -->


        <h3 class="title"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'One Page Checkout Mode (Cards only)','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</h3>
        <!-- Display Payment Options -->
        <div class="form-group js-worldlineop-display-iframe-pm-block">
          <label class="control-label col-lg-3">
            <span>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Accept cards payments on iframe','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
            </span>
          </label>
          <div class="col-lg-9 js-worldlineop-display-iframe-pm-switch">
            <span class="switch prestashop-switch fixed-width-xl">
              <input type="radio"
                     value="1"
                     name="worldlineopPaymentMethodsSettings[displayIframePaymentOptions]"
                     id="worldlineopPaymentMethodsSettings_displayIframePaymentOptions_on"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['displayIframePaymentOptions'] === true) {?>checked="checked"<?php }?>>
              <label for="worldlineopPaymentMethodsSettings_displayIframePaymentOptions_on"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Yes','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <input type="radio"
                     value="0"
                     name="worldlineopPaymentMethodsSettings[displayIframePaymentOptions]"
                     id="worldlineopPaymentMethodsSettings_displayIframePaymentOptions_off"
                     <?php if ($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['displayIframePaymentOptions'] != true) {?>checked="checked"<?php }?>>
              <label for="worldlineopPaymentMethodsSettings_displayIframePaymentOptions_off"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <a class="slide-button btn"></a>
            </span>
          </div>
          <div class="col-lg-9 col-lg-offset-3">
            <div class="help-block">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'By activating this mode, your customers can pay with card on your checkout page itself without any redirection. ','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'For all other alternate payment methods please select one of the redirection options above.','mod'=>'worldlineop'),$_smarty_tpl ) );?>

            </div>
          </div>
        </div>
        <!-- /Display Payment Options -->
        <div class="js-worldlineop-iframe-payment-methods-block">
          <!-- Iframe CTA -->
          <div class="form-group">
            <label class="control-label col-lg-3 ">
              <span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Pay button title','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </span>
            </label>
            <div class="col-lg-9">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
                <div class="translatable-field flex lang-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['id_lang'] ));?>
" <?php if ($_smarty_tpl->tpl_vars['language']->value['iso_code'] != $_smarty_tpl->tpl_vars['lang_iso']->value) {?>style="display:none;"<?php }?>>
                  <div class="col-lg-5">
                    <input type="text"
                           id="worldlineop-iframe-cta-<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['id_lang'] ));?>
"
                           name="worldlineopPaymentMethodsSettings[iframeCallToAction][<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['iso_code'],'html','UTF-8' ));?>
]"
                           class=""
                           value="<?php if ((isset($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['iframeCallToAction'][$_smarty_tpl->tpl_vars['language']->value['iso_code']]))) {
echo $_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['iframeCallToAction'][call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['iso_code'],'html','UTF-8' ))];
}?>">
                  </div>
                  <div class="col-lg-2">
                    <button type="button"
                            class="btn btn-default dropdown-toggle"
                            tabindex="-1"
                            data-toggle="dropdown">
                      <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['iso_code'],'html','UTF-8' ));?>

                      <i class="icon-caret-down"></i>
                    </button>
                    <ul class="dropdown-menu">
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['languages']->value, 'language');
$_smarty_tpl->tpl_vars['language']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['language']->value) {
$_smarty_tpl->tpl_vars['language']->do_else = false;
?>
                        <li>
                          <a href="javascript:hideOtherLanguage(<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['id_lang'] ));?>
);" tabindex="-1">
                            <?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['language']->value['name'],'html','UTF-8' ));?>

                          </a>
                        </li>
                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </ul>
                  </div>
                </div>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
            <div class="col-lg-9 col-lg-offset-3">
              <div class="help-block">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Title of the payment selection button on your checkout page','mod'=>'worldlineop'),$_smarty_tpl ) );?>

                <span></span>
              </div>
            </div>
          </div>
          <!-- /Iframe CTA -->
          <!-- Logo -->
          <div class="form-group">
            <label class="control-label col-lg-3 ">
              <span>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Logo displayed on your payment page','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </span>
            </label>
            <div class="col-lg-9">
              <?php if ($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['iframeLogoFilename']) {?>
                <img class="preview-logo"
                     src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['path']['img'],'html','UTF-8' ));?>
payment_logos/<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['iframeLogoFilename'],'html','UTF-8' ));?>
"/>
              <?php }?>
              <input type="file"
                     name="worldlineopPaymentMethodsSettings[iframeLogo]"
                     id="worldlineopPaymentMethodsSettings[iframeLogo]"
                     class="worldlineop-upload js-worldlineop-upload"/>
              <label for="worldlineopPaymentMethodsSettings[iframeLogo]">
                <i class="icon icon-upload"></i>
                <span>
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Upload','mod'=>'worldlineop'),$_smarty_tpl ) );?>

                  </span>
              </label>
            </div>
            <div class="col-lg-9 col-lg-offset-3">
              <?php if ($_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['iframeLogoFilename']) {?>
                <input type="checkbox" id="worldlineopPaymentMethodsSettings[deleteLogo]" name="worldlineopPaymentMethodsSettings[deleteLogo]" />
                <label for="worldlineopPaymentMethodsSettings[deleteLogo]"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delete current logo','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</label>
              <?php }?>
              <div class="help-block">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You can upload here a new logo (file types accepted for logos are: .png .gif .jpg only)','mod'=>'worldlineop'),$_smarty_tpl ) );?>
<br/>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'We recommend that you use images with 20px height & 120px length maximum','mod'=>'worldlineop'),$_smarty_tpl ) );?>

                <span></span>
              </div>
            </div>
          </div>
          <!-- /Logo -->
          <!-- Iframe payment methods list -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment methods available','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <button class="btn btn-default js-worldlineop-refresh-iframe-pm-btn">
                <i class="icon icon-refresh"></i>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Refresh list of available payment methods','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </button>
            </div>
          </div>
          <div id="js-worldlineop-iframe-payment-methods-list" class="worldlineop-payment-methods-list">
            <?php $_smarty_tpl->_subTemplateRender("file:./_paymentMethodsList.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"iframe",'name'=>"iframePaymentMethods"), 0, true);
?>
          </div>
          <!-- /Iframe payment methods list -->
          <!-- Template filename -->
          <div class="form-group">
            <label class="control-label col-lg-3">
              <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Template filename','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</span>
            </label>
            <div class="col-lg-9">
              <div class="fixed-width-xxl">
                <input value="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['paymentMethodsSettings']['iframeTemplateFilename'],'htmlall','UTF-8' ));?>
"
                       type="text"
                       name="worldlineopPaymentMethodsSettings[iframeTemplateFilename]"
                       class="input fixed-width-xxl">
              </div>
            </div>
          </div>
          <!-- /Template filename -->
        </div>
        <input type="hidden" name="action" value="savePaymentMethodsSettingsForm"/>
      </div>
    </div>
    <div class="panel-footer">
      <button type="submit" class="btn btn-default pull-right" name="submitPaymentMethodsSettingsForm">
        <i class="process-icon-save"></i> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Save','mod'=>'worldlineop'),$_smarty_tpl ) );?>

      </button>
    </div>
  </form>
</div>
<?php }
}
