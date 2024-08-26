<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:19:44
  from '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/_header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4a0ba2cd2_00790485',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '2dc98ea7766026b62d28cab773052e9ba0851530' => 
    array (
      0 => '/home/asw200923/beta/modules/worldlineop/views/templates/admin/worldlineop_configuration/_header.tpl',
      1 => 1673625328,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4a0ba2cd2_00790485 (Smarty_Internal_Template $_smarty_tpl) {
?>
<div class="panel">
  <div class="row">
    <div class="worldlineop-header flex col-xs-12">
      <div class="worldlineop-logo">
        <img src="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['path']['img'],'html','UTF-8' ));?>
worldline-horizontal.png"/>
      </div>
      <div class="worldlineop-support flex">
        <div class="contact flex">
          <i class="icon icon-question-circle icon-big flex"></i>
          <div class="flex">
            <p><b><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Do you have a question?','mod'=>'worldlineop'),$_smarty_tpl ) );?>
</b></p>
            <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Contact us using','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              <a target="_blank" href="https://addons.prestashop.com/en/contact-us?id_product=86428">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'this link','mod'=>'worldlineop'),$_smarty_tpl ) );?>

              </a>
            </p>
          </div>
        </div>
        <div class="cta-buttons flex">
          <a class="btn btn-primary" href="<?php echo call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['data']->value['extra']['path']['module'],'html','UTF-8' ));?>
readme_en.pdf">
            <i class="icon icon-book"></i>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Download User guide','mod'=>'worldlineop'),$_smarty_tpl ) );?>

          </a>
        </div>
      </div>
    </div>
  </div>
</div>
<?php }
}
