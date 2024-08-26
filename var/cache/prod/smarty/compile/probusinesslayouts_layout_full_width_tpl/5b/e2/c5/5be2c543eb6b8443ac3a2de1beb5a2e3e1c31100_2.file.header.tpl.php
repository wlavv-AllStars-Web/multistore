<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:10:03
  from '/home/asw200923/beta/themes/probusiness/templates/_partials/header.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc385b3da0c2_58083570',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '5be2c543eb6b8443ac3a2de1beb5a2e3e1c31100' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/_partials/header.tpl',
      1 => 1723456791,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cc385b3da0c2_58083570 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>

<div class="header_content">
  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_175775216366cc385b3d04e7_24558172', 'header_nav');
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_103673412266cc385b3d1be5_61423383', 'header_top');
?>



</div>


<?php }
/* {block 'header_nav'} */
class Block_175775216366cc385b3d04e7_24558172 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_nav' => 
  array (
    0 => 'Block_175775216366cc385b3d04e7_24558172',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <nav class="header-nav">
      <div class="header-nav-container">
        <div id="navigation">
        <?php if (Context::getContext()->customer->logged) {?>
          <a class="logout" href="/?mylogout=" rel="nofollow" title="Log me out"> <i class="fa fa-unlock"></i> </a>
        <?php }?>
        </div>
        <div style="width: 50%; display: flex; justify-content: end ;">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav1'),$_smarty_tpl ) );?>

        </div>
    </nav>
  <?php
}
}
/* {/block 'header_nav'} */
/* {block 'header_top'} */
class Block_103673412266cc385b3d1be5_61423383 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'header_top' => 
  array (
    0 => 'Block_103673412266cc385b3d1be5_61423383',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="header-top">
      <div class="container" >
        <div  class="row centrar" style="margin:0;  display: flex; align-items: center;">
          <div  id="_desktop_logo" class="col-md-4 col-sm-12" style="margin: 0; padding: 0; width:30%">
            <a  href="/" style="display: flex; justify-content:start">
              <img  class="logo img-flud img-big" src="/img/asd/logo_asd.webp" alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['shop']->value['name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="width: 250px; margin: 0 " width="250" height="110">
            </a>
          </div>
          <?php if (Context::getContext()->customer->logged) {?>  
          <div class="wdth mobile" style="width: 50%;">
           <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayNav2",'mod'=>"ps_shoppingcart"),$_smarty_tpl ) );?>

                        </div>
          <?php }?>
          <div  class="formula" style="display: flex; justify-content:center; margin-left: 50px; width:70%">
           <?php if (Context::getContext()->customer->logged) {?>  
                        <div class="cart" style="width: 50%;">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>"displayNav2",'mod'=>"ps_shoppingcart"),$_smarty_tpl ) );?>

            </div>
                                    <div class="wdth" style="width: 50%">
              <form style="display:flex; justify-content:center" method="get" action="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['search'], ENT_QUOTES, 'UTF-8');?>
" id="searchbox">
    		        <input type="hidden" name="controller" value="search">
    		        <input style="border: 1px solid #777; width:50%; border-radius: 20px 0px 0px 20px;" class="search_query form-control" type="text" id="search_query_top" name="s" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['search_string']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Search','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
">
    		        <button type="submit" name="submit_search" class="btn btn-default button-search">
    			        <i class="material-icons material-icons-search"></i>
    		        </button>
    	        </form>
            </div>
            
             <?php } else { ?> 
                          
            <form id="login-form" action="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['authentication'], ENT_QUOTES, 'UTF-8');?>
" method="post">   
                <div style="display:flex; width:30%; height: min-content;" class="form-group col">
                  <div class="email_icon header-icon">
                    <input type="hidden" name="back" value="my-account">
                    <i class="fa fa-user"></i>
                  </div>
                  <input class="form-control whtbl" name="email" type="email" value="<?php echo htmlspecialchars((string) $_POST['email'], ENT_QUOTES, 'UTF-8');?>
" required placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Email",'d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
">
                </div>
                <div style="margin-bottom:0 ;  display: flex; flex-direction: column ; width: 30%" class="form-group col">
                  <div style="display:flex; flex-direction: row">
                    <div class="unlock_icon header-icon">
                      <i class="fa fa-unlock"></i>
                    </div>
                    <input class="form-control js-child-focus js-visible-password whtbl" name="password" type="password" value="" required placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Password",'d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
">                 
                  </div>
                  <div>
                    <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['password'], ENT_QUOTES, 'UTF-8');?>
" rel="nofollow" style="color: #0273EB;font-size:12px;line-height:18px;">
                      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Forgot your password?','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

                    </a>
                  </div>
                </div>             
                <div class="form-group col" >
                  <input type="hidden" name="submitLogin" value="1">           
                  <button id="sender" class="btn btn-primary form-control-submit whtbl" data-link-action="sign-in" type="submit">
                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Login",'d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

                  </button>                
                </div>          
              </form>   
           <?php }?>  
          </div>
        </div>
      </div>
      <div style="padding-left: 0; line-height: normal"  class="row headerline alinhamento-mobile hlfsz">
        <div class="margbot">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayNav2','mod'=>"ps_mainmenu"),$_smarty_tpl ) );?>

        </div>
      </div>    
    </div>


    

  <?php
}
}
/* {/block 'header_top'} */
}
