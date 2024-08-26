<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:08:15
  from '/home/asw200923/beta/themes/probusiness/templates/customer/order-detail.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc37efa6f308_43745130',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '4717d1575909822cb92d4da5eb57f11e4de22bb5' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/customer/order-detail.tpl',
      1 => 1724243808,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:customer/_partials/order-detail-return.tpl' => 1,
    'file:customer/_partials/order-detail-no-return.tpl' => 1,
  ),
),false)) {
function content_66cc37efa6f308_43745130 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_188033198166cc37efa479b1_53059819', 'page_title');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_130989100366cc37efa49e18_35955167', 'page_content');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'customer/page.tpl');
}
/* {block 'page_title'} */
class Block_188033198166cc37efa479b1_53059819 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_title' => 
  array (
    0 => 'Block_188033198166cc37efa479b1_53059819',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <div class="col-lg-12 banner-myaccount" style="margin-bottom: 1rem;padding:0;">
        <img src="/img/asd/Content_pages/order-details/order_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" alt="account_banner" />
    </div>
<?php
}
}
/* {/block 'page_title'} */
/* {block 'order_infos'} */
class Block_133415879566cc37efa4a226_55083380 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

        <div id="order-infos">
            <div class="box">
                <div class="row">
                    <div class="col-xs-<?php if ($_smarty_tpl->tpl_vars['order']->value['details']['reorder_url']) {?>9<?php } else { ?>12<?php }?>" style="text-align: center;text-transform: uppercase;font-size: 34px;">
                        <strong style="color: #777;"> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
 <span style="color: #0273eb"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['order']->value['details']['reference'], ENT_QUOTES, 'UTF-8');?>
</span> <strong>
                    </div>
                <div class="clearfix"></div>
            </div>
        </div>
        
        <div class="">
            <table class="table table-striped table-bordered hidden-sm-down">
                <thead class="thead-default" style="text-align: center; background-color: #f0f0f0;text-transform: uppercase;font-size: 24px">
                    <tr>
                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Date','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</td>
                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Montant','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</td>
                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</td>
                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shipping','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</td>
                        <?php if ($_smarty_tpl->tpl_vars['order']->value['details']['invoice_url']) {?>
                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invoice','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</td>
                        <?php } else { ?>
                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Valid to','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</td>
                        <?php }?>
                    </tr>
                </thead>
                <tbody style="text-align: center;font-size: 18px;">
                    <tr>
                        <td><?php echo htmlspecialchars((string) smarty_modifier_date_format($_smarty_tpl->tpl_vars['order']->value['history']['current']['date_add'],"d-m-Y"), ENT_QUOTES, 'UTF-8');?>
</td>
                        <td><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['totals']['total']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                        <td><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['order']->value->details->getPayment(), ENT_QUOTES, 'UTF-8');?>
</td>
                        <td><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['order']->value['shipping'][0]['carrier_name'], ENT_QUOTES, 'UTF-8');?>
</td>
                        
                        <?php if ($_smarty_tpl->tpl_vars['order']->value['details']['invoice_url']) {?>
                            <td>
                                <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['details']['invoice_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="display: block;">
                                  <img src="/img/asd/icon_invoice.svg" width="23" height="23" style="width: 23px;height:auto;" />
                                </a>
                            </td>
                        <?php } else { ?>
                            <td><?php echo htmlspecialchars((string) smarty_modifier_date_format(strtotime(($_smarty_tpl->tpl_vars['order']->value['history']['current']['date_add']).(' +5 days')),"d-m-Y"), ENT_QUOTES, 'UTF-8');?>
</td>
                        <?php }?>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php
}
}
/* {/block 'order_infos'} */
/* {block 'addresses'} */
class Block_166081946966cc37efa585b0_97650733 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <div class="addresses">
            <?php if ($_smarty_tpl->tpl_vars['order']->value['addresses']['delivery']) {?>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <article id="delivery-address" class="box">
                    <h4 style="font-size: 24px;border-bottom: 3px solid #0273eb;padding: 10px 0;text-transform: uppercase"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Delivery address','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</h4>
                    <address style="font-size: 18px; line-height: 1.4;"><?php echo $_smarty_tpl->tpl_vars['order']->value['addresses']['delivery']['formatted'];?>
</address>
                </article>
            </div>
            <?php }?>
            
            <div class="col-lg-6 col-md-6 col-sm-6">
                <article id="invoice-address" class="box" style="text-align: right;">
                    <h4 style="font-size: 24px;border-bottom: 3px solid #0273eb;padding: 10px 0;text-transform: uppercase"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invoice address','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</h4>
                    <address style="font-size: 18px; line-height: 1.4;"><?php echo $_smarty_tpl->tpl_vars['order']->value['addresses']['invoice']['formatted'];?>
</address>
                </article>
            </div>
            <div class="clearfix"></div>
        </div>
    <?php
}
}
/* {/block 'addresses'} */
/* {block 'order_detail'} */
class Block_107013838666cc37efa5b207_30450310 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php if ($_smarty_tpl->tpl_vars['order']->value['details']['is_returnable']) {?>
            <?php $_smarty_tpl->_subTemplateRender('file:customer/_partials/order-detail-return.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php } else { ?>
            <?php $_smarty_tpl->_subTemplateRender('file:customer/_partials/order-detail-no-return.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
        <?php }?>
    <?php
}
}
/* {/block 'order_detail'} */
/* {block 'order_history'} */
class Block_29981146266cc37efa5e385_36067222 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <section id="order-history" class="">
            <h3 style="text-align: center; border-top: 3px solid #0273eb;padding: 20px 0 10px 0;text-transform: uppercase;font-size: 24px;margin-top: 60px;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status history','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</h3>
            <table class="table table-striped table-bordered table-labeled hidden-xs-down">
                <thead class="thead-default" style="text-align: center; background-color: #f0f0f0;text-transform: uppercase;font-size: 24px">
                    <tr>
                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Date','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</td>
                        <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</td>
                    </tr>
            </thead>
            <tbody>
                <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order']->value['history'], 'state');
$_smarty_tpl->tpl_vars['state']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->do_else = false;
?>
                    <tr style="text-align: center;font-size: 18px">
                        <td><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['state']->value['history_date'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                        <td> <span class="label label-pill <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['state']->value['contrast'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="background-color:<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['state']->value['color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"> <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['state']->value['ostate_name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
 </span> </td>
                    </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </tbody>
          </table>
          <div class="hidden-sm-up history-lines">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order']->value['history'], 'state');
$_smarty_tpl->tpl_vars['state']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['state']->value) {
$_smarty_tpl->tpl_vars['state']->do_else = false;
?>
              <div class="history-line">
                <div class="date"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['state']->value['history_date'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
                <div class="state">
                  <span class="label label-pill <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['state']->value['contrast'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" style="background-color:<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['state']->value['color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                    <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['state']->value['ostate_name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                  </span>
                </div>
              </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </div>
        </section>
    <?php
}
}
/* {/block 'order_history'} */
/* {block 'order_carriers'} */
class Block_17898712266cc37efa69660_49882823 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
?>

        <?php if ($_smarty_tpl->tpl_vars['order']->value['shipping']) {?>
            <div class="">
                <h3 style="text-align: center; border-top: 3px solid #0273eb;padding: 20px 0 10px 0;text-transform: uppercase;font-size: 24px;margin-top: 60px;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Information','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</h3>
                <table class="table table-striped table-bordered hidden-sm-down" style>
                    <thead class="thead-default" style="text-align: center; background-color: #f0f0f0;text-transform: uppercase;font-size: 24px">
                        <tr>
                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last update','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</td>
                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Weight','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</td>
                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Carrier','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</td>
                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tracking','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order']->value['shipping'], 'line');
$_smarty_tpl->tpl_vars['line']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['line']->value) {
$_smarty_tpl->tpl_vars['line']->do_else = false;
?>
                            <tr style="text-align: center;font-size: 18px">
                                <td><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['line']->value['shipping_date'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                                <td><?php echo htmlspecialchars((string) smarty_modifier_number_format($_smarty_tpl->tpl_vars['line']->value['weight'],2,".",","), ENT_QUOTES, 'UTF-8');?>
 Kg</td>
                                <td><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['line']->value['carrier_name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                                <td><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['line']->value['tracking'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                            </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
            </div>
        <?php }?>
    <?php
}
}
/* {/block 'order_carriers'} */
/* {block 'page_content'} */
class Block_130989100366cc37efa49e18_35955167 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_130989100366cc37efa49e18_35955167',
  ),
  'order_infos' => 
  array (
    0 => 'Block_133415879566cc37efa4a226_55083380',
  ),
  'addresses' => 
  array (
    0 => 'Block_166081946966cc37efa585b0_97650733',
  ),
  'order_detail' => 
  array (
    0 => 'Block_107013838666cc37efa5b207_30450310',
  ),
  'order_history' => 
  array (
    0 => 'Block_29981146266cc37efa5e385_36067222',
  ),
  'order_carriers' => 
  array (
    0 => 'Block_17898712266cc37efa69660_49882823',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_133415879566cc37efa4a226_55083380', 'order_infos', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_166081946966cc37efa585b0_97650733', 'addresses', $this->tplIndex);
?>


    <?php echo $_smarty_tpl->tpl_vars['HOOK_DISPLAYORDERDETAIL']->value;?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_107013838666cc37efa5b207_30450310', 'order_detail', $this->tplIndex);
?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_29981146266cc37efa5e385_36067222', 'order_history', $this->tplIndex);
?>


    <?php if ($_smarty_tpl->tpl_vars['order']->value['follow_up']) {?>
        <div class="box">
            <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Click the following link to track the delivery of your order','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</p>
            <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['follow_up'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['follow_up'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</a>
        </div>
    <?php }?>

    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_17898712266cc37efa69660_49882823', 'order_carriers', $this->tplIndex);
?>

<?php
}
}
/* {/block 'page_content'} */
}
