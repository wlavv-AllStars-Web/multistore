<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:03:48
  from 'module:ps_customersigninps_customersignin.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe28410fe36_40313969',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'd5f8f570180f74d1dbdd1a1d2af0445e90a6650c' => 
    array (
      0 => 'module:ps_customersigninps_customersignin.tpl',
      1 => 1719912747,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe28410fe36_40313969 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="_desktop_user_info">
  <div class="user-info">
  
    <?php if ($_smarty_tpl->tpl_vars['logged']->value) {?>
      <a class="logout d-none d-lg-block" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['actions']['logout'], ENT_QUOTES, 'UTF-8');?>
" rel="nofollow" >
      <i class="fa fa-unlock" style="font-size: 20px;color:#fff"></i>
              </a>
      <a class="user-info-account"  href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['my_account'], ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My account','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>
" rel="nofollow" >
        <i class="fa-solid fa-user" style="color:#fff"></i>
        <span class="d-none d-lg-block" style="text-transform: uppercase;color:#fff;font-weight:600;font-size:15px;" ><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My account','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
      </a>
      
    <?php } else { ?>
      <a class="user-info-account" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['authentication'], ENT_QUOTES, 'UTF-8');?>
" style="display: flex;justify-content:end;align-items:center;padding-right:4px;gap:5px;" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Log in to your customer account','d'=>'Shop.Theme.CustomerAccount'),$_smarty_tpl ) );?>
" rel="nofollow" >
        <i class="fa-solid fa-user" style="color:#fff"></i>
        <span class="d-none d-lg-block" style="text-transform: uppercase;color:#fff;font-weight:600;font-size:15px;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My account','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
      </a>
        
            </span>
    <?php }?>
  </div>
</div>

<style>
@media screen and (max-width:991px){
  .user-info{
      display: flex;align-items:center;gap:2rem;
    }
  .user-info-account {
    display: flex;justify-content:end;align-items:center;padding-right:4px;gap:5px;
  }
}

@media screen and (min-width:992px){
    .user-info{
      display: flex;align-items:center;padding-left: 3rem;gap:2rem;
    }

  .user-info-account {
    display: flex;justify-content:end;align-items:center;padding-right:4px;gap:5px;
  }
}
</style><?php }
}
