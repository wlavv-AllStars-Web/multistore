<?php
/* Smarty version 4.3.4, created on 2024-08-22 19:09:52
  from '/home/asw200923/beta/themes/probusiness/templates/contact-form.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c77ef0b200f9_84068752',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '548585bfd08ac301c17457982dac8e787c605c0a' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/contact-form.tpl',
      1 => 1722609108,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c77ef0b200f9_84068752 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>
 
<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_190642655566c77ef0b095c8_02112827', 'page_content');
$_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content'} */
class Block_190642655566c77ef0b095c8_02112827 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_190642655566c77ef0b095c8_02112827',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>



<section class="contact-form" style="width:100%;max-width:1440px;">

<?php if ((isset($_smarty_tpl->tpl_vars['confirmation']->value))) {?>
    <div class="confirmation-msg">
        <p class="alert alert-success"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your message has been successfully sent to our team.'),$_smarty_tpl ) );?>
</p>
    </div>

<?php } elseif ((isset($_smarty_tpl->tpl_vars['alreadySent']->value))) {?>
    
    <div class="confirmation-msg">
        <p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your message has already been sent.'),$_smarty_tpl ) );?>
</p>
    </div>
<?php }?>

  <div style="background-color: #fff;">
    <img alt="contact" src="/img/asd/Content_pages/contact/contact_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" class="img-responsive" style="margin:0 auto;width:100%">

    <div>
        <ul class="nav nav-tabs" id="menu-client" role="tablist" style="display: flex;align-items:center;background-color: #f7f7f7; border: 1px solid #d8d8d8; height: 55px;margin-top: 20px;">
            <li class="nav-item">
                <a class="nav-link" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Orders history",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
" id="order_history-tab"  onclick="openShippingtab('<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['my_account'], ENT_QUOTES, 'UTF-8');?>
','order_history')"role="tab" aria-controls="order_history" aria-selected="false" style="padding:0.5rem 1rem;" ><i class="fa fa-list-ol website_blue font-size-40"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="statistics-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Statistics",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
"   onclick="openShippingtab('<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['my_account'], ENT_QUOTES, 'UTF-8');?>
','statistics')" role="tab" aria-controls="statistics" aria-selected="false" style="padding:0.5rem 1rem;" ><i class="fa-solid fa-chart-column"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="shipping-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Shipping Rates",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
"   onclick="openShippingtab('<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['my_account'], ENT_QUOTES, 'UTF-8');?>
','shipping')" role="tab" aria-controls="shipping" aria-selected="false" style="padding:0.5rem 1rem;" ><i class="fa fa-truck website_blue font-size-40"></i></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="profile-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Profile",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
"  onclick="openShippingtab('<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['my_account'], ENT_QUOTES, 'UTF-8');?>
','profile')" role="tab" aria-controls="profile" aria-selected="false" style="padding:0.5rem 1rem;"  ><i class="fa fa-user website_blue font-size-40"></i></a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="warranty-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Warranty",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
"  onclick="openShippingtab('<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['my_account'], ENT_QUOTES, 'UTF-8');?>
','warranty')"  role="tab" aria-controls="warranty" aria-selected="false" style="padding:0.5rem 12px;" ><img src="/img/asd/warranty_icon.svg" width="37" /></a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" id="contact-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Contact",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
"  href="" role="" aria-controls="contact" aria-selected="false" style="padding:0.5rem 9px;" ><img src="/img/asd/email_icon.svg" width="43" /></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="notification-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Notifications",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
"  onclick="openShippingtab('<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['my_account'], ENT_QUOTES, 'UTF-8');?>
','notification')" role="tab" aria-controls="notification" aria-selected="false" style="padding:0.5rem 1rem;" ><i class="fa-solid fa-bell"></i></a>
            </li>
            <li class="nav-item" style="display:flex;justify-content: end;flex:1;">
                <a class="nav-link" id="logout-tab"  href="/?mylogout="><i class="fa-solid fa-lock-open"></i></a>
            </li>
        </ul>
    </div>

    <form action="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['request_uri']->value, ENT_QUOTES, 'UTF-8');?>
" method="post" class="contact-form-box" enctype="multipart/form-data" style="max-width:1350px; margin:2rem auto; background-color:#fff; box-shadow: none;">
        <div class="spacer-20"></div>
        <input type="hidden" value="2" name="id_contact">
		<div>
			<div id="contact-form-group" class="col-lg-12 px-0">
				<div class="name_field col-lg-3 pl-0">
					<div class="form-group">
                        <label for="firstname"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Name','d'=>"Shop.Theme.Contactform"),$_smarty_tpl ) );?>
<sup>*</sup></label>
                                                <input class="is_required form-control grey validate" type="text" id="firstname" name="firstname" data-validate="isName" value="" maxlength="40" style="max-width: 100%;padding:0.5rem 1rem;"/>
                        					</div>
				</div>
				<div class="lastname_field col-lg-3">
					<div class="form-group">
                        <label for="lastname"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last Name','d'=>"Shop.Theme.Contactform"),$_smarty_tpl ) );?>
<sup>*</sup></label>
                                                <input class="is_required form-control grey validate" type="text" id="lastname" name="lastname" data-validate="isName" value="" maxlength="40" style="max-width: 100%;padding:0.5rem 1rem;"/>
                        					</div>
				</div>
				<div class="order_field" style="display: none;">
					<div class="form-group" style="max-width: 100%" >
						<label for="email"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order reference'),$_smarty_tpl ) );?>
</label>
						<input  style="max-width: 100%;padding:0.5rem 1rem;" class="form-control grey" type="text" placeholder="(ex: WNDGVVZLX)" name="id_order" id="id_order" value="<?php if ((isset($_smarty_tpl->tpl_vars['customerThread']->value['id_order'])) && call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['customerThread']->value['id_order'] )) > 0) {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['customerThread']->value['id_order'] )), ENT_QUOTES, 'UTF-8');
} else {
if ((isset($_POST['id_order'])) && !empty($_POST['id_order'])) {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_POST['id_order'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');
}
}?>" />
					</div>
				</div>
				<div class="email_field col-lg-6 pr-0">
					<p class="form-group"  style="max-width: 100%;">
						<label for="email"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Email address','d'=>"Shop.Theme.Contactform"),$_smarty_tpl ) );?>
<sup>*</sup></label>
						<?php if ((isset($_smarty_tpl->tpl_vars['customerThread']->value['email']))) {?>
							<input class="form-control grey" type="text" id="email" name="from" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['customerThread']->value['email'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" readonly="readonly" style="max-width: 100%;padding:0.5rem 1rem;"/>
						<?php } else { ?>
							<input class="form-control grey validate" type="text" id="email" name="from" data-validate="isEmail" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['email']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" maxlength="40" style="max-width: 100%;padding:0.5rem 1rem;"/>
						<?php }?>
					</p>
				</div>
				
				<div style="height: 2px; width: 100%; display: inline-block"></div>
				<div class="form-group col-lg-12 px-0" >
					<label for="message"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Message','d'=>"Shop.Theme.Contactform"),$_smarty_tpl ) );?>
<sup>*</sup></label>
					<textarea class="form-control" id="message" name="message" maxlength="500" style="padding:0.5rem 1rem;"><?php if ((isset($_smarty_tpl->tpl_vars['message']->value))) {
echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'stripslashes' ][ 0 ], array( call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['message']->value,'html','UTF-8' )) )), ENT_QUOTES, 'UTF-8');
}?></textarea>
					<span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'(max 500 chars)','d'=>"Shop.Theme.Contactform"),$_smarty_tpl ) );?>
</span>
				</div>
			</div>
			<div class="submit col-lg-12 px-0">
				<button type="submit" name="submitMessage" id="submitMessage" class="btn btn-default btn-md">
					<span> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Send','d'=>"Shop.Theme.Contactform"),$_smarty_tpl ) );?>
 <i class="fa fa-chevron-right right"></i> </span>
				</button>
			</div>
		</div>
	</form>
  </div>
</section>
<style>
  #main {
    width: 100% !important;
    background: #FFFFFF;
  }

  .contact-form .form-control {
    color: #333333;
  }

  .contact-form .form-group{
    margin-bottom: 0;
  }

  .contact-form .btn[type="submit"]{
    background: #0273eb;
    border: 1px solid #0273eb;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-top: 1rem;
  }

  .contact-form .btn[type="submit"]:hover{
    color: #0273eb !important;
    background: #FFFFFF !important;
  }


@media screen and (min-width:769px) {
  .contact-form .btn[type="submit"]{
    height: 34px;
  }
}  

/* mobile */
@media screen and (max-width:768px){
  #contact #content {
    margin:0;
    background: #FFFFFF;
  }

  #contact #main {
    padding: 0;
  }

  #contact .container {
    margin-inline: 0;
  }

  #contact .breadcrumb_wrapper{
    display: none;
  }

  .contact-form .btn[type="submit"]{
    width: 200px;
    height: 44px;
  }

  #contact .footer_after {
    display: block;
  }


  #contact #messageCheckBox {
    width: 1.25rem;
    height: 1.25rem;
  }
}

</style>
<?php
}
}
/* {/block 'page_content'} */
}
