<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:07:08
  from '/home/asw200923/beta/themes/probusiness/templates/customer/password-email.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc37ac7cfa39_67669633',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '77f8158b585f211c455b4a2d08ca90721954188b' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/customer/password-email.tpl',
      1 => 1724059132,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cc37ac7cfa39_67669633 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_153886782866cc37ac7bfad5_36433505', 'page_content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content'} */
class Block_153886782866cc37ac7bfad5_36433505 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_153886782866cc37ac7bfad5_36433505',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <style>nav.breadcrumb { display: none; }</style>

  <div style="max-width:1350px;margin:auto;">
    <img src="/img/asd/Content_pages/forgot/forgot_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" style="width: 100%;" alt="news_banner"/>
  </div>
  
  <form action="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['urls']->value['pages']['password'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="forgotten-password" method="post">
    <ul class="ps-alert-error">
      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['errors']->value, 'error');
$_smarty_tpl->tpl_vars['error']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['error']->value) {
$_smarty_tpl->tpl_vars['error']->do_else = false;
?>
        <li class="item">
          <i>
            <svg viewBox="0 0 24 24">
              <path fill="#fff" d="M11,15H13V17H11V15M11,7H13V13H11V7M12,2C6.47,2 2,6.5 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20Z"></path>
            </svg>
          </i>
          <p><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['error']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</p>
        </li>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
    <div class="container-reset-password">
      <div class="reset-header">
        <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Forgot Password?",'d'=>"Shop.Theme.Reset"),$_smarty_tpl ) );?>
</h1>
        <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Reset your Password",'d'=>"Shop.Theme.Reset"),$_smarty_tpl ) );?>
</h1>
      </div>
      <div class="reset-sub">
        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Please enter the email associated with your customer account and click on "Reset" to receive a temporary link allowing you to reset your password.','d'=>"Shop.Theme.Reset"),$_smarty_tpl ) );?>
</p>
        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click on "Cancel" to return to the main page.','d'=>"Shop.Theme.Reset"),$_smarty_tpl ) );?>
</p>
        <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'If necessary, you can contact our technical teams by clicking','d'=>"Shop.Theme.Reset"),$_smarty_tpl ) );?>
<a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['contact'], ENT_QUOTES, 'UTF-8');?>
"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'here','d'=>"Shop.Theme.Reset"),$_smarty_tpl ) );?>
</a>.</p>
      </div>
      <div class="reset-content">
        <div class="form-group">
          <label class="col-md-12 px-0"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email address','d'=>'Shop.Forms.Labels'),$_smarty_tpl ) );?>
</label>
          <div class="col-md-12 px-0">
            <input type="email" name="email" id="email" value="<?php if ((isset($_POST['email']))) {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_POST['email'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}?>" class="form-control" required>
          </div>
        </div>
        <div class="col-md-6 pl-0">
            <a class="form-control-submit btn btn-primary col-md-12" href="/"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Cancel','d'=>'Shop.Theme.Reset'),$_smarty_tpl ) );?>
 </a>
        </div>
        <div class="col-md-6 pr-0">
            <button class="form-control-submit btn btn-primary col-md-12" name="submit" type="submit"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reset','d'=>'Shop.Theme.Reset'),$_smarty_tpl ) );?>
 </button>
        </div>
      </div>
    </div>
  </form>
<?php
}
}
/* {/block 'page_content'} */
}
