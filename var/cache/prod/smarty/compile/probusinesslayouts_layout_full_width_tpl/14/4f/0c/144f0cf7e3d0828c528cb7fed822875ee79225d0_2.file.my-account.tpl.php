<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:08:11
  from '/home/asw200923/beta/themes/probusiness/templates/customer/my-account.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc37eb0c4f60_40583297',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '144f0cf7e3d0828c528cb7fed822875ee79225d0' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/customer/my-account.tpl',
      1 => 1724233472,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:customer/_partials/block-address.tpl' => 1,
  ),
),false)) {
function content_66cc37eb0c4f60_40583297 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>



<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_105946244966cc37eb05e498_85923263', 'page_content');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'customer/page.tpl');
}
/* {block 'page_title'} */
class Block_192158378966cc37eb098ec0_68798380 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Your addresses','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</h1>
          <?php
}
}
/* {/block 'page_title'} */
/* {block 'customer_address'} */
class Block_142264064866cc37eb09a232_87365122 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <?php $_smarty_tpl->_subTemplateRender('file:customer/_partials/block-address.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('address'=>$_smarty_tpl->tpl_vars['address']->value), 0, true);
?>
                  <?php
}
}
/* {/block 'customer_address'} */
/* {block 'page_content'} */
class Block_105946244966cc37eb05e498_85923263 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content' => 
  array (
    0 => 'Block_105946244966cc37eb05e498_85923263',
  ),
  'page_title' => 
  array (
    0 => 'Block_192158378966cc37eb098ec0_68798380',
  ),
  'customer_address' => 
  array (
    0 => 'Block_142264064866cc37eb09a232_87365122',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.date_format.php','function'=>'smarty_modifier_date_format',),));
?>

  <div class="row myaccount-container">
    <div class="col-lg-12 banner-myaccount">
      <img src="/img/asd/Content_pages/account/account_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" alt="account_banner" />
    </div>


    <div class="col-lg-12">
    <ul class="nav nav-tabs" id="menu-client" role="tablist" style="display: flex;align-items:center;background-color: #f7f7f7; border: 1px solid #d8d8d8; height: 55px;margin-top: 20px;">
            <li class="nav-item">
        <a class="nav-link active" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Orders history",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
" id="order_history-tab" data-toggle="tab" href="#order_history" role="tab" aria-controls="order_history" aria-selected="false" style="padding:0.5rem 1rem;" onclick="changeImgBanner(this)"><i class="fa fa-list-ol website_blue font-size-40"></i></a>
      </li>
            
      <li class="nav-item">
        <a class="nav-link" id="statistics-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Statistics",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
"  data-toggle="tab" href="#statistics" role="tab" aria-controls="statistics" aria-selected="false" style="padding:0.5rem 1rem;" onclick="changeImgBanner(this)"><i class="fa-solid fa-chart-column"></i></a>
      </li>
      
                  <li class="nav-item">
        <a class="nav-link" id="shipping-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Shipping Rates",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
"  data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="false" style="padding:0.5rem 1rem;" onclick="changeImgBanner(this)"><i class="fa fa-truck website_blue font-size-40"></i></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="profile-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Profile",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false" style="padding:0.5rem 1rem;"  onclick="changeImgBanner(this)"><i class="fa fa-user website_blue font-size-40"></i></a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link" id="warranty-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Warranty",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
" data-toggle="tab" href="#warranty" role="tab" aria-controls="warranty" aria-selected="false" style="padding:0.5rem 12px;" onclick="changeImgBanner(this)"><img src="/img/asd/warranty_icon.svg" width="37" /></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="contact-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Contact",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
"  href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('contact'), ENT_QUOTES, 'UTF-8');?>
" role="" aria-controls="contact" aria-selected="false" style="padding:0.5rem 9px;" ><img src="/img/asd/email_icon.svg" width="43" /></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" id="notification-tab" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Notifications",'d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
" data-toggle="tab" href="#notification" role="tab" aria-controls="notification" aria-selected="false" style="padding:0.5rem 1rem;" onclick="changeImgBanner(this)"><i class="fa-solid fa-bell"></i></a>
      </li>
            <li class="nav-item" style="display:flex;justify-content: end;flex:1;">
        <a class="nav-link" id="logout-tab"  href="/?mylogout="><i class="fa-solid fa-lock-open"></i></a>
      </li>

      
    </ul>

    

      <div class="tab-content" id="myTabContent">
                <div class="tab-pane  show active" id="order_history" role="tabpanel" title="Order History" aria-labelledby="order_history-tab">
          <div class="order-states-container">
            <div class="card-status-myaccount" >
                <a onclick="findRowTable(24)">
                    <div class="counters_panel margin-lados-10">
                      <div class="color-label">
                        <div class="waiting_validation"></div>
                        <div class="counters_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Awaiting confirmation','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</div>
                      </div>
                        <div class="counters_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['counters']->value['waiting_validation'], ENT_QUOTES, 'UTF-8');?>
</div>
                    </div>
                    <div class="spacer-20"></div>
                </a>
            </div>
            <div class="card-status-myaccount">
                <a onclick="findRowTable(10)">
                    <div class="counters_panel margin-lados-10 ">
                      <div class="color-label">
                        <div class="waiting_payment"></div>
                        <div class="counters_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Awaiting payment','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</div>
                      </div>
                        <div class="counters_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['counters']->value['waiting_payment'], ENT_QUOTES, 'UTF-8');?>
</div>
                    </div>
                    <div class="spacer-20"></div>
                </a>
            </div> 
            <div class="card-status-myaccount">
                <a onclick="findRowTable(3)">
                    <div class="counters_panel margin-lados-10 ">
                      <div class="color-label">
                        <div class="preparation"></div>
                        <div class="counters_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Packing in progress','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</div>
                      </div>
                        <div class="counters_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['counters']->value['processing'], ENT_QUOTES, 'UTF-8');?>
</div>
                    </div>
                    <div class="spacer-20"></div>
                </a>
            </div> 
            <div class="card-status-myaccount">
                <a onclick="findRowTable(9)">
                    <div class="counters_panel margin-lados-10 ">
                      <div class="color-label">
                        <div class="backorder"></div>
                        <div class="counters_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'On Backorder','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</div>
                      </div>
                        <div class="counters_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['counters']->value['backorders'], ENT_QUOTES, 'UTF-8');?>
</div>
                    </div>
                    <div class="spacer-20"></div>
                </a>
            </div> 
            <div class="card-status-myaccount">
                <a onclick="findRowTable(4)">
                    <div class="counters_panel margin-lados-10 ">
                      <div class="color-label">
                        <div class="shipped"></div>
                        <div class="counters_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shipped','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</div>
                      </div>
                        <div class="counters_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['counters']->value['shipped'], ENT_QUOTES, 'UTF-8');?>
</div>
                    </div>
                </a>
            </div>    
            <div class="card-status-myaccount">
                <a onclick="findRowTable(6)">
                    <div class="counters_panel margin-lados-10 ">
                      <div class="color-label">
                        <div class="canceled"></div>
                        <div class="counters_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Canceled','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</div>
                      </div>
                        <div class="counters_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['counters']->value['canceled'], ENT_QUOTES, 'UTF-8');?>
</div>
                    </div>
                </a>
            </div> 
            <div class="card-status-myaccount">
                <a onclick="findRowTable(6)">
                    <div class="counters_panel margin-lados-10 ">
                      <div class="color-label">
                        <div class="partial_shipping"></div>
                        <div class="counters_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Partial Shipping','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</div>
                      </div>
                        <div class="counters_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['counters']->value['partial_shipping'], ENT_QUOTES, 'UTF-8');?>
</div>
                    </div>
                </a>
            </div> 
            <div class="card-status-myaccount">
                <a onclick="cleanFilter()">
                    <div class="counters_panel margin-lados-10 ">
                      <div class="color-label">
                        <div class="not_invoiced"></div>
                        <div class="counters_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total Orders','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</div>
                      </div>
                        <div class="counters_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['counters']->value['total_orders'], ENT_QUOTES, 'UTF-8');?>
</div>
                    </div>
                </a>
            </div> 
          </div>
          <div style="margin-top: 2rem;">
            <div style="display: flex;justify-content:space-between;width:100%;">
              <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order history','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</h1>
                          </div>

          
          <?php if ($_smarty_tpl->tpl_vars['orders']->value) {?>
            <table class="table table-striped table-bordered table-labeled hidden-sm-down">
              <thead class="thead-default">
                <tr>
                  <th class="text-xs-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Date','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</th>
                  <th class="text-xs-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order ID','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</th>
                                    <th class="text-xs-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total price','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</th>
                  <th class="hidden-md-down text-xs-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</th>
                  <th class="text-xs-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Carrier','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</th>
                  <th class="text-xs-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Tracking','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</th>
                                    <th class="text-xs-center"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Invoice','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</th>
                                  </tr>
              </thead>
              <tbody>
            
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['orders']->value, 'order');
$_smarty_tpl->tpl_vars['order']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['order']->value) {
$_smarty_tpl->tpl_vars['order']->do_else = false;
?>
                                  <tr data-state="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['order']->value['history']['current']['id_order_state'], ENT_QUOTES, 'UTF-8');?>
">
                    <td class="text-xs-center"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['details']['order_date'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                    <th scope="row" class="link-ref text-xs-center">
                      <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['details']['details_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" data-link-action="view-order-details">
                        <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['details']['reference'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                      </a>
                    </th>
                                        <td class="text-xs-center"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['totals']['total']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</td>
                                        <td class="text-xs-center">
                      <span
                        class="label label-pill <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['history']['current']['contrast'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                        style="background-color:<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['history']['current']['color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                      >
                        <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['history']['current']['ostate_name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                      </span>
                    </td>
                    <td  class="text-xs-center">
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order']->value['shipping'], 'line');
$_smarty_tpl->tpl_vars['line']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['line']->value) {
$_smarty_tpl->tpl_vars['line']->do_else = false;
?>
                        <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['line']->value['carrier_name'], ENT_QUOTES, 'UTF-8');?>

                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </td>
                    <td class="text-xs-center">
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['order']->value['shipping'], 'line');
$_smarty_tpl->tpl_vars['line']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['line']->value) {
$_smarty_tpl->tpl_vars['line']->do_else = false;
?>
                        <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['line']->value['tracking'], ENT_QUOTES, 'UTF-8');?>

                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </td>
                    <td class="text-xs-center hidden-md-down">
                      <?php if ($_smarty_tpl->tpl_vars['order']->value['details']['invoice_url']) {?>
                        <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['details']['invoice_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                                                    <img src="/img/asd/icon_invoice.svg" width="23" height="23" style="width: 23px;height:auto;" />
                        </a>
                      <?php } else { ?>
                        -
                      <?php }?>
                    </td>
                                                                                </tr>
                <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              </tbody>
            </table>
        
            <div class="orders hidden-md-up">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['orders']->value, 'order');
$_smarty_tpl->tpl_vars['order']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['order']->value) {
$_smarty_tpl->tpl_vars['order']->do_else = false;
?>
                <div class="order" data-state="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['order']->value['history']['current']['id_order_state'], ENT_QUOTES, 'UTF-8');?>
">
                  <div class="row">
                    <div class="col-xs-10" >
                      <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['details']['details_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"><h3><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['details']['reference'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</h3></a>
                      <div class="date"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['details']['order_date'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
                      <div class="total"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['totals']['total']['value'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</div>
                      <div class="status">
                        <span
                          class="label label-pill <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['history']['current']['contrast'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                          style="background-color:<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['history']['current']['color'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                        >
                          <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['history']['current']['ostate_name'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                        </span>
                      </div>
                    </div>
                    <div class="col-xs-2 text-xs-right">
                        <div>
                          <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['details']['details_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" data-link-action="view-order-details" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Details','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
">
                            <i class="material-icons">&#xE8B6;</i>
                          </a>
                        </div>
                        <?php if ($_smarty_tpl->tpl_vars['order']->value['details']['reorder_url']) {?>
                          <div>
                            <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['order']->value['details']['reorder_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Reorder','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
">
                              <i class="material-icons">&#xE863;</i>
                            </a>
                          </div>
                        <?php }?>
                    </div>
                  </div>
                </div>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
          <?php } else { ?>
            <div class="alert alert-warning" role="alert" style="max-width: 1350px;margin: 0 auto;text-align: center;">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'No orders yet.','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>

            </div>
          <?php }?>
          <?php echo '<script'; ?>
>
            function findRowTable(state_num) {
              const rows = document.querySelectorAll("#order_history tbody tr");
              const rowsM = document.querySelectorAll("#order_history .orders .order");

              if(window.screen.width > 767){
                rows.forEach(row => {
                  if (row.getAttribute('data-state') == state_num) {
                    row.style.display = ''; 
                  } else {
                    row.style.display = 'none'; 
                  }
                });
              }else{
                rowsM.forEach(row => {
                  if (row.getAttribute('data-state') == state_num) {
                    row.style.display = ''; 
                  } else {
                    row.style.display = 'none'; 
                  }
                });
              }

            }

            function cleanFilter() {
              const rows = document.querySelectorAll("#order_history tbody tr");
              const rowsM = document.querySelectorAll("#order_history .orders .order");

              if(window.screen.width > 767){
                rows.forEach(row => {
                  row.style.display = ''; 
                });
              }else{
                rowsM.forEach(row => {
                  row.style.display = ''; 
                });
              }

            }

          <?php echo '</script'; ?>
>
          </div>
        </div>

        
        <div class="tab-pane fade" id="statistics" role="tabpanel" aria-labelledby="statistics-tab">  
          <div class="col-sm-12 text-center" style="margin-bottom: 2rem;">
              <div class="row statistics_container charts" style="max-width: 1350px; margin: 0 auto;">
                  <div class="col-lg-8 col-md-7 col-sm-12 col-xs-12">
                      <div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total purchases per month','d'=>'Shop.Theme.Statistics'),$_smarty_tpl ) );?>
</div>
                      <canvas id="myChart" width="664" height="332"></canvas>
                  </div>

                  <div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
                    <div><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total purchases by brand (€)','d'=>'Shop.Theme.Statistics'),$_smarty_tpl ) );?>
</div>
                      <canvas id="chart-area" height="332" class="chartjs-render-monitor"></canvas>
                  </div>
              </div>
          </div>
          <div class="col-lg-7 col-md-12 col-sm-12 col-xs-12">
            <div class="col-lg-12">
              <div class="title-clientstatistics"  style="font-size: 14px;position: relative; top: 20px;text-align:center;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Best seller products','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</div>
              <canvas id="myChart-statistics"></canvas>
            </div>
            <div style="border-top: 1px solid #c8c8c8;padding: 10px 0;text-align: center;color: #666;cursor: pointer;margin-top: 20px; font-weight: bolder;" onclick="$('#top_100').toggle()"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Check Top 100','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</div>
            <div id="top_100" style="display: none;border-top: 1px solid #c8c8c8;padding: 10px 0;text-align: left;color: #666;cursor: pointer;margin-top: 0px; font-weight: bolder;">
                    <div style="width: 33%; float: left;">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['top']->value['top1'], 'product', false, 'k');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                        <div style="padding: 5px; height: 27px;">
                            <div style="width: 40px; float: left;"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['k']->value+1, ENT_QUOTES, 'UTF-8');?>
.</div>
                            <div style="width: calc(100% - 40px); float: left;"><a style="color: #777;" href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
-top100.html" target="_blank"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['reference'], ENT_QUOTES, 'UTF-8');?>
</a></div>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                    
                    <div style="width: 33%; float: left;">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['top']->value['top2'], 'product', false, 'k');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                        <div style="padding: 5px; height: 27px;">
                            <div style="width: 40px; float: left;"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['k']->value+1, ENT_QUOTES, 'UTF-8');?>
.</div>
                            <div style="width: calc(100% - 40px); float: left;"><a style="color: #777;" href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
-top100.html" target="_blank"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['reference'], ENT_QUOTES, 'UTF-8');?>
</a></div>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                    
                    <div style="width: 33%; float: left;">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['top']->value['top3'], 'product', false, 'k');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                        <div style="padding: 5px; height: 27px;">
                            <div style="width: 40px; float: left;"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['k']->value+1, ENT_QUOTES, 'UTF-8');?>
.</div>
                            <div style="width: calc(100% - 40px); float: left;"><a style="color: #777;" href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
-top100.html" target="_blank"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['reference'], ENT_QUOTES, 'UTF-8');?>
</a></div>
                        </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </div>
                </div>
          </div>
                    <div class="col-lg-5 col-md-12 col-sm-12 col-xs-12">
            <div id="general_information_container">
              <div class="spacer-20 visible-xs visible-sm"></div>
              <div class="statistics_container margin-left-10">
                  <div class="stats_container_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Company name','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</div>
                  <div class="stats_container_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['company_name']->value, ENT_QUOTES, 'UTF-8');?>
</div>
              </div>
              <div class="spacer-20"></div>
              <div class="statistics_container margin-left-10">
                  <div class="stats_container_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Client since','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</div>
                  <div class="stats_container_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['clientSince']->value, ENT_QUOTES, 'UTF-8');?>
</div>
              </div>
              <div class="spacer-20"></div>
              <div class="statistics_container margin-left-10">
                  <div class="stats_container_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Default language','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</div>
                  <div class="stats_container_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['defaultLanguage']->value, ENT_QUOTES, 'UTF-8');?>
</div>
              </div>
              <div class="spacer-20"></div>
              <div class="statistics_container margin-left-10">
                  <div class="stats_container_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last purchase','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</div>
                  <div class="stats_container_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['lastOrder']->value, ENT_QUOTES, 'UTF-8');?>
</div>
              </div>
              <div class="spacer-20"></div>
              <div class="statistics_container margin-left-10">
                  <div class="stats_container_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My addresses','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</div>
                  <div class="stats_container_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numberAddresses']->value, ENT_QUOTES, 'UTF-8');?>
</div>
              </div>
              <div class="spacer-20"></div>
              <div class="statistics_container margin-left-10">
                  <div class="stats_container_label"><a style="color: dodgerblue;" href="#order_history"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Number of orders','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</a></div>
                  <div class="stats_container_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numberOfOrders']->value, ENT_QUOTES, 'UTF-8');?>
</div>
              </div>
              <div class="spacer-20"></div>
              <div class="statistics_container margin-left-10">
                  <div class="stats_container_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Total orders amount','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</div>
                  <div class="stats_container_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['totalOfOrders']->value, ENT_QUOTES, 'UTF-8');?>
 €</div>
              </div>
              <div class="spacer-16"></div>
              <div class="statistics_container margin-left-10">
                  <div class="stats_container_label"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Average value per order','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</div>
                  <div class="stats_container_value"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['average']->value, ENT_QUOTES, 'UTF-8');?>
 €</div>
              </div>
            </div>
          </div>


          <div class="col-sm-12 last-viewed-products-container">
            <div class="statistics_container">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Last viewed products','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>

            </div>
            <div class="last-viewed-products">
                          <?php if (count($_smarty_tpl->tpl_vars['lastViewedProducts']->value) > 0) {?>
                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lastViewedProducts']->value, 'product', false, 'k');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-top: 1rem; <?php if ($_smarty_tpl->tpl_vars['k']->value == 0) {?> padding-left: 0px; <?php }?> <?php if ($_smarty_tpl->tpl_vars['k']->value == 3) {?> padding-right: 0px; <?php }?>">
                    <div class="statistics_container" style="padding: 0; margin: 0;overflow: hidden;">
                        <a class="product_img_link"	href="https://www.all-stars-distribution.com/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
-product.html" title="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
" itemprop="url" style="width: 100%; text-align: center;">
                              <div style="background-color: white;display: flex;justify-content:center;">
                              
                                <img
                                src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['reference'],$_smarty_tpl->tpl_vars['product']->value['id_image'],null,'jpg',$_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['id_manufacturer'],'thumb'), ENT_QUOTES, 'UTF-8');?>
"
                                alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],30,'...' )), ENT_QUOTES, 'UTF-8');?>
"
                                loading="lazy"
                                data-full-size-image-url="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['reference'],$_smarty_tpl->tpl_vars['product']->value['id_image'],null,'jpg',$_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['id_manufacturer']), ENT_QUOTES, 'UTF-8');?>
"
                                width="125"
                                height="125"
                                style="width:125px;height:auto;"
                                />
                                                                </div>
                              <div style="border-top: 1px solid #C8C8C8; font-size: 14px; color: #666;padding: 5px;"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],25 )), ENT_QUOTES, 'UTF-8');?>
</div>
                              <div style="font-size: 14px; color: #666;"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['reference'],25 )), ENT_QUOTES, 'UTF-8');?>
</div>
                          </a>
                      </div>
                  </div>
                  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              <?php } else { ?>
                  <div style="padding: 10px;">
                      <p class="alert alert-warning" style="margin: 0"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You haven\'t viewed any products yet!','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</p>
                  </div>
              <?php }?>
            </div>
          </div>

          <div class="col-sm-12 most-purchased-container" style="margin-left: 0;">
            <div class="statistics_container">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Most purchased products','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>

            </div>
            <div class="most-purchased" style="">
            <?php if (count($_smarty_tpl->tpl_vars['mostBoughtProducts']->value) > 0) {?>
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mostBoughtProducts']->value, 'product', false, 'j');
$_smarty_tpl->tpl_vars['product']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['j']->value => $_smarty_tpl->tpl_vars['product']->value) {
$_smarty_tpl->tpl_vars['product']->do_else = false;
?>
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12" style="margin-top: 1rem; <?php if ($_smarty_tpl->tpl_vars['j']->value == 0) {?> padding-left: 0px; <?php }?> <?php if ($_smarty_tpl->tpl_vars['j']->value == 3) {?> padding-right: 0px; <?php }?>">
                <div class="statistics_container" style="padding: 0; margin: 0px;">
                    <a class="product_img_link"	href="https://www.all-stars-distribution.com/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
-product.html" title="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
" itemprop="url" style="width: 100%; text-align: center;">
                          <div style="background-color: white;display: flex;justify-content:center;">

                            <img
                            src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['reference'],$_smarty_tpl->tpl_vars['product']->value['id_image'],null,'jpg',$_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['id_manufacturer'],'thumb'), ENT_QUOTES, 'UTF-8');?>
"
                            alt="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],30,'...' )), ENT_QUOTES, 'UTF-8');?>
"
                            loading="lazy"
                            data-full-size-image-url="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['reference'],$_smarty_tpl->tpl_vars['product']->value['id_image'],null,'jpg',$_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['id_manufacturer']), ENT_QUOTES, 'UTF-8');?>
"
                            width="125"
                            height="125"
                            style="width:125px;height:auto;"
                            />
                          </div>
                          <div style="border-top: 1px solid #C8C8C8; height: 45px; font-size: 14px; color: #666;overflow: hidden;display:flex;align-items:center;">
                              <div style=" width: 50px;height: 100%;line-height: 30px;font-size: 20px;background-color: #fff;padding: 10px;border-right: 1px solid #c8c8c8; text-align: center;"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['number'], ENT_QUOTES, 'UTF-8');?>
</div> 
                              <div style="padding: 5px;"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'truncate' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['name'],25 )), ENT_QUOTES, 'UTF-8');?>
</div>
                          </div>
                      </a>
                  </div>
              </div>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php } else { ?>
              <div style="padding: 10px;">
                  <p class="alert alert-warning"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'You haven\'t made any purchases yet!','d'=>"Shop.Theme.Statistics"),$_smarty_tpl ) );?>
</p>
              </div>
          <?php }?>
            </div>
          </div>

        </div>



                <div class="tab-pane fade" id="addresses" role="tabpanel" aria-labelledby="addresses-tab">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_192158378966cc37eb098ec0_68798380', 'page_title', $this->tplIndex);
?>

            <div class="row">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['customer']->value['addresses'], 'address');
$_smarty_tpl->tpl_vars['address']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['address']->value) {
$_smarty_tpl->tpl_vars['address']->do_else = false;
?>
              <div class="col-lg-4 col-md-6 col-sm-6" style="padding: 1rem 0;">
                  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_142264064866cc37eb09a232_87365122', 'customer_address', $this->tplIndex);
?>

              </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
            <div class="clearfix"></div>
            <div class="addresses-footer">
              <a class="btn btn-primary" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['urls']->value['pages']['address'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" data-link-action="add-address">
                <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Create new address','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</span>
              </a>
            </div>
        </div>

        <div class="tab-pane fade" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">
            
            <div style="width: 100%;">
                <div style="text-align: center;text-transform: uppercase;color: #000;font-size: 18px;padding: 20px;"><h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Euro shipping rates','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
 <span style="color: #0273eb;">( <?php echo htmlspecialchars((string) date('Y-m-d'), ENT_QUOTES, 'UTF-8');?>
 )</span></h1></div>

                <table id="table_shipping" border="3" bgcolor="#999">
                    <thead>
                        <tr>
                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'destination','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</td>
                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'0 - 10kg'),$_smarty_tpl ) );?>
</td>
                            <td><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'10kg - 35kg'),$_smarty_tpl ) );?>
</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['shipping']->value, 'row');
$_smarty_tpl->tpl_vars['row']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['row']->value) {
$_smarty_tpl->tpl_vars['row']->do_else = false;
?>
                        <tr>
                            <td><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['row']->value['name'], ENT_QUOTES, 'UTF-8');?>
</td>
                            <td><?php echo htmlspecialchars((string) number_format($_smarty_tpl->tpl_vars['row']->value['value_1'],2), ENT_QUOTES, 'UTF-8');?>
 €</td>
                            <td><?php echo htmlspecialchars((string) number_format($_smarty_tpl->tpl_vars['row']->value['value_2'],2), ENT_QUOTES, 'UTF-8');?>
 €</td>
                        </tr>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    </tbody>
                </table>
                <div style="text-align: center;text-transform: uppercase;color: #000;font-size: 16px; border-left: 3px solid #000; border-bottom: 3px solid #000; border-right: 3px solid #000; padding: 20px;width: 800px; margin: 0 auto;font-weight: bolder;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rate per parcel up to 305cm girth ( 2 x H + 2 x B + 1 x L ) - Oversized applicable : 21.50 €','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</div>
            </div>
        </div>
        
        <style>
            
            table#table_shipping{ width: 800px; margin: 0 auto; }
            table#table_shipping > thead > tr { border-bottom: 3px solid #333; }
            table#table_shipping > thead > tr > td { color: #FFF; background-color: dodgerblue; text-align: center; text-transform: uppercase;font-size: 22px; font-weight: bolder; }
            table#table_shipping > tbody > tr > td { color: #333; background-color: #fff; text-align: center; text-transform: uppercase;font-size: 22px; font-weight: bolder;line-height: 2; }
            
        </style>
        
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                          <div class="form-personal-info" style="padding-top: 2rem;">
            
                      <form action="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['my_account'], ENT_QUOTES, 'UTF-8');?>
" method="post" class="std">
                <div class="left-form-personal col-lg-6 col-sm-12" style="display: flex;flex-direction:column;align-items:center;">
                  <div class="form-group col-lg-9">
                    <h1 style="text-align: center;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Your Personal Information",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</h1>
                    <p style="text-align: center;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Please be sure to update your personal information if changed.",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</p>
                  </div>
                  <div class="radio-btns-form-personal  col-lg-9 col-md-6">
                    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['genders']->value, 'gender', false, 'k');
$_smarty_tpl->tpl_vars['gender']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['gender']->value) {
$_smarty_tpl->tpl_vars['gender']->do_else = false;
?>
                      <div class="form-check col-md-3 col-sm-6" style="text-align: center;">
                        <input class="form-check-input" type="radio" name="id_gender" id="id_gender<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['gender']->value->id, ENT_QUOTES, 'UTF-8');?>
" value="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['gender']->value->id )), ENT_QUOTES, 'UTF-8');?>
" <?php if ((isset($_POST['id_gender'])) && $_POST['id_gender'] == $_smarty_tpl->tpl_vars['gender']->value->id) {?> checked="checked"<?php }?>>
                        <label class="form-check-label" for="id_gender<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['gender']->value->id, ENT_QUOTES, 'UTF-8');?>
">
                          <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['gender']->value->name, ENT_QUOTES, 'UTF-8');?>

                        </label>
                      </div>
                    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                  </div>

                
                  <div class="form-group col-lg-9 col-md-7 col-sm-12 col-xs-12">
                    <label for="firstname"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"First Name",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</label>
                    <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo htmlspecialchars((string) $_POST['firstname'], ENT_QUOTES, 'UTF-8');?>
">
                  </div>
                  <div class="form-group col-lg-9 col-md-7 col-sm-12 col-xs-12">
                    <label for="lastname"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Last Name",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</label>
                    <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo htmlspecialchars((string) $_POST['lastname'], ENT_QUOTES, 'UTF-8');?>
">
                  </div>
                  <div class="form-group col-lg-9 col-md-7 col-sm-12 col-xs-12">
                    <label for="email"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Email",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars((string) $_POST['email'], ENT_QUOTES, 'UTF-8');?>
">
                  </div>
                  <div class="form-row col-lg-9 col-md-7 col-sm-12 col-xs-12">
                    <div class="form-group col-lg-12 col-md-12 col-sm-12 px-0 m-0">
                      <label><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Date of Birth",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</label>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12  days">
                      <select id="days" name="days" class="form-control">
                        <option selected><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Day",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</option>
                        <option>...</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['days']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                          <option value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['v']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if (($_smarty_tpl->tpl_vars['sl_day']->value == $_smarty_tpl->tpl_vars['v']->value)) {?>selected="selected"<?php }?>><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['v']->value, ENT_QUOTES, 'UTF-8');?>
&nbsp;&nbsp;</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                      </select>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12  months">
                      <select id="months" name="months" class="form-control">
                        <option selected><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Month",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</option>
                        <option>...</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['months']->value, 'v', false, 'k');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['k']->value => $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                            <option value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['k']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if (($_smarty_tpl->tpl_vars['sl_month']->value == $_smarty_tpl->tpl_vars['k']->value)) {?>selected="selected"<?php }?>><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>$_smarty_tpl->tpl_vars['v']->value),$_smarty_tpl ) );?>
&nbsp;</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                      </select>
                    </div>
                    <div class="form-group col-lg-4 col-md-4 col-sm-12 col-xs-12  years">
                      <select id="years" name="years" class="form-control">
                        <option selected><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Year",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</option>
                        <option>...</option>
                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['years']->value, 'v');
$_smarty_tpl->tpl_vars['v']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['v']->value) {
$_smarty_tpl->tpl_vars['v']->do_else = false;
?>
                            <option value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['v']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if (($_smarty_tpl->tpl_vars['sl_year']->value == $_smarty_tpl->tpl_vars['v']->value)) {?>selected="selected"<?php }?>><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['v']->value, ENT_QUOTES, 'UTF-8');?>
&nbsp;&nbsp;</option>
                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                      </select>
                    </div>
                  </div>
                                    <div class="form-group col-lg-9 col-md-7 col-sm-12">
                    <label for="old_passwd"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Current Password",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</label>
                    <input type="password" class="form-control " name="old_passwd" id="old_passwd" required data-validate="isPasswd" >
                  </div>
                  <div class="form-group col-lg-9 col-md-7 col-sm-12">
                    <label for="passwd"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"New Password",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</label>
                    <input type="password" class="form-control " name="passwd" id="passwd" data-validate="isPasswd">
                  </div>
                  <div class="form-group col-lg-9 col-md-7 col-sm-12">
                    <label for="confirmation"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"New Password Confirmation",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</label>
                    <input type="password" class="form-control " name="confirmation" id="confirmation" data-validate="isPasswd">
                  </div>
                                    <div class="form-group col-lg-9 col-md-7 col-sm-12">
                    <div class="form-check col-md-12">
                        <input class="form-check-input" type="checkbox" id="newsletter" name="newsletter" value="1" <?php if ((isset($_POST['newsletter'])) && $_POST['newsletter'] == 1) {?> checked="checked"<?php }?>>
                        <label class="form-check-label" for="newsletter">
                          <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(13), ENT_QUOTES, 'UTF-8');?>
"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Sign up for our newsletter!",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</a>
                        </label>
                      
                    </div>
                  </div>
                                                </div>
                            <div class="right-form-personal  col-lg-6 col-sm-12">
                <div class="form-group col-lg-12 col-md-7 col-sm-12" style="padding-top: 2rem;">
                <h1 style="text-align: center;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Your Company Information",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</h1>
                </div>
                                  <div class="form-group col-lg-9 col-md-7 col-sm-12">
                    <label for="company"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Company Name",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</label>
                    <input type="text" class="form-control" id="company" name="company" value="<?php if ((isset($_POST['company']))) {
echo htmlspecialchars((string) $_POST['company'], ENT_QUOTES, 'UTF-8');
}?>" >
                  </div>
                  <div class="form-group col-lg-9 col-md-7 col-sm-12">
                    <label for="siret"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Vat Number",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</label>
                    <input type="text" class="form-control" id="siret" name="siret" value="<?php if ((isset($_POST['siret']))) {
echo htmlspecialchars((string) $_POST['siret'], ENT_QUOTES, 'UTF-8');
}?>">
                  </div>
                  
                                  <div class="form-group col-lg-12 col-md-4 col-sm-12" style="text-align: center;padding-bottom:2rem;">
                    <button class="btn btn-primary" type="submit" name="submitIdentity" data-link-action="save-customer" style="background:#0273eb;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Submit form",'d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</button>
                  </div>
                                  <div class="form-group col-lg-12" style="padding-top: 2rem;">
                    <h1 class="page-subheading" style="text-align: center;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'General Data Protection Regulation','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</h1>
                        
                    <div style="margin-top: 40px;text-align:center;">
                      <h4> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove account','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
  </h4>
                      <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'After the account has been removed you can not go back!.','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</p>
                      <button type="submit" name="removeIdentity" class="btn btn-default button button-medium">
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Remove Account','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
<i class="icon-chevron-right right"></i></span>
                      </button>
                    </div>
                  </div>
                    
                  <div class="form-group col-lg-12" style="padding-top: 2rem;">
                    <div style="margin-top: 40px;text-align:center;">
                      <h4> <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Portability of personal data','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
  </h4>
                      <p><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Allows you to extract your personal data in a CSV document!.','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
</p>	
                      <button type="submit" name="exportIdentity" class="btn btn-default button button-medium">
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Export personal data','d'=>'Shop.Theme.Customeraccount'),$_smarty_tpl ) );?>
<i class="icon-chevron-right right"></i></span>
                      </button>
                    </div>
                  </div>
                              </div>
              

              

              
              
            </form>

            

          </div>
          

          

        </div>

        <div class="tab-pane fade" id="warranty" role="tabpanel" aria-labelledby="warranty-tab">
            <h1>Warranty</h1>
        </div>

        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
          <h1>Contact</h1>
        </div>


        <div class="tab-pane fade" id="notification" role="tabpanel" aria-labelledby="notification-tab">
          <div class="content_notification">
            
          <?php if (count($_smarty_tpl->tpl_vars['messages']->value) > 0) {?>
              <div class="col-sm-12 text-center px-0">
                  <div class="spacer-20"></div>
                  <div class="row" style="max-width: 1350px; margin: 0 auto;">
                                        <div class="col-lg-12 px-0">
                        <div class="panel" style="box-shadow: none;">
                                                    <div class="panel-body">
                              <ul id="clients-messages">
                                  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['messages']->value, 'message');
$_smarty_tpl->tpl_vars['message']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['message']->value) {
$_smarty_tpl->tpl_vars['message']->do_else = false;
?>            
                                    
                                      <li class="notification-item" id="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['message']->value['id'], ENT_QUOTES, 'UTF-8');?>
" >
                                                                                            <div class="notification-container" role="alert">
                                                <div class="notification-header">
                                                  <div class="title-notification"><i class="fa-solid fa-circle-info"></i><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['message']->value["title_".((string)$_smarty_tpl->tpl_vars['language']->value['iso_code'])], ENT_QUOTES, 'UTF-8');?>
</div>
                                                  <div class="date-notification"><i class="fa-regular fa-calendar"></i><?php echo htmlspecialchars((string) smarty_modifier_date_format($_smarty_tpl->tpl_vars['message']->value["creation_date"],"%d-%m-%Y"), ENT_QUOTES, 'UTF-8');?>
</div>
                                                </div>
                                                <div class="notification-body">
                                                  <div class="message-notification"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['message']->value[("message_").($_smarty_tpl->tpl_vars['language']->value['iso_code'])], ENT_QUOTES, 'UTF-8');?>
</div>
                                                </div>
                                              </div>
                                              <div class="spacer-10"></div>
                                          </li>
                                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                  </ul>
                            </div>
                        </div>
                      </div>
                  </div>
                  <div class="spacer-20"></div>
              </div>
              
              <style>
                  .alert.alert-danger::before {  content: none; }
                  .alert.alert-warning::before { content: none; }
                  .alert.alert-info::before {    content: none; }
                  .alert.alert-success::before { content: none; }
                  
                  .fa:hover::before{ color: white; }
                  
                  #clients-messages > li{ font-size: 18px; border-bottom: 1px solid #ddd; margin-bottom: 10px; min-height: 25px; color: #555; }
              </style>

          <?php }?>


          </div>
        </div>


      </div>


      

    </div>


  
    <?php echo '<script'; ?>
 src="https://cdn.jsdelivr.net/npm/chart.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
>

      

      function changeImgBanner(tab){
          const tabid = tab.getAttribute("aria-controls");
          const banner = document.querySelector(".banner-myaccount img");
          if (tabid === 'notification') { // Corrected 'notication' to 'notification'
              banner.setAttribute("src", "/img/asd/Content_pages/notifications/noti_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp");
              
              // iniico ajax client notification

              const data = {
                  updatenotification: 1, // This triggers Tools::isSubmit('updatenotification')
                  id_notification: document.querySelector(".notification-item:nth-child(1)").getAttribute("id"),
                  id_customer: <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['id_customer']->value, ENT_QUOTES, 'UTF-8');?>
,
              };

              $.ajax({
                  url: '<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account'), ENT_QUOTES, 'UTF-8');?>
',
                  type: 'POST',
                  data: data,
                  success: function(data) {
                      document.querySelector("#notification-tab").classList.remove("ball_notification")
                      document.querySelector("#_desktop_top_menu_desktop .ball_notification").classList.remove("ball_notification")
                  },
                  error: function(xhr, status, error) {
                      console.error('Error:', error);
                  }
              });


          
              // fim ajax client notification

          }else if(tabid === 'order_history'){
            banner.setAttribute("src", "/img/asd/Content_pages/history/order_history_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp");
          }else if(tabid === 'statistics'){
            banner.setAttribute("src", "/img/asd/Content_pages/statistics/statistics_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp");
          }else if(tabid === 'shipping'){
            banner.setAttribute("src", "/img/asd/Content_pages/shipping/shipping_costs_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp");
          }else if(tabid === 'warranty'){
            banner.setAttribute("src", "/img/asd/Content_pages/warranty/warranty_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp");
          }else{ 
              banner.setAttribute("src", "/img/asd/Content_pages/account/account_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp");
          }
      }

      document.addEventListener("DOMContentLoaded", (event) => {
        const activetab = document.querySelector("#menu-client li .active")
        changeImgBanner(activetab)

        if(<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['showNotificationBall']->value, ENT_QUOTES, 'UTF-8');?>
 === 1){
          document.querySelector("#notification-tab").classList.add("ball_notification");
        }
      })

    
      var myLineChart = new Chart(document.getElementById('myChart').getContext('2d'),
        {
            type: 'line',
            data: {
                    labels: [
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lastYearOrdersMonth']->value, 'month');
$_smarty_tpl->tpl_vars['month']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['month']->value) {
$_smarty_tpl->tpl_vars['month']->do_else = false;
?>
                        '<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['month']->value, ENT_QUOTES, 'UTF-8');?>
',
                      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                    ],
                    datasets: [
                        {
                        data: [<?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['lastYearOrdersTotal']->value, 'total', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['total']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['total']->value) {
$_smarty_tpl->tpl_vars['total']->do_else = false;
echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['total']->value, ENT_QUOTES, 'UTF-8');?>
,<?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>],
                        borderColor: '<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['lastYearOrdersColor']->value, ENT_QUOTES, 'UTF-8');?>
',
                        backgroundColor: '<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['lastYearOrdersColor']->value, ENT_QUOTES, 'UTF-8');?>
',
                        fill: false,
                        label: ' €',
                        }
                    ]
                },

        }
    );

    /** PIE CHART **/


// Simulating the embedded string data from the server
const brandsString = "<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['ordersByBrand']->value['brands'], ENT_QUOTES, 'UTF-8');?>
".replace(/&quot;/g, '"');
const brandsArray = brandsString.split(",").map(brand => brand.trim());
const totalString = "<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['ordersByBrand']->value['totals'], ENT_QUOTES, 'UTF-8');?>
".replace(/&quot;/g, '"');
const totalArray = totalString.split(",").map(total => total.trim());

// console.log(brandsArray)




	window.myPie = new Chart(document.getElementById('chart-area').getContext('2d'), 
	    {
    		type: 'pie',
    		data: {
    			datasets: [{
    				data: totalArray,
    				backgroundColor: '<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['ordersByBrandColors']->value, ENT_QUOTES, 'UTF-8');?>
',
    				label: 'Value'
    			}],
    			labels: brandsArray
    		},
    		options: {
    			responsive: true
    		}
    	}
	);
  
  const references = "<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['bestSellers']->value['references'], ENT_QUOTES, 'UTF-8');?>
";
  const values = "<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['bestSellers']->value['values'], ENT_QUOTES, 'UTF-8');?>
";
  const referencesArray = references.split(",")
  const valuesArray = values.split(",")

  /** Statistics Chart**/
  var barChartData = {
    	labels: referencesArray,
    	datasets: [{
    		backgroundColor: '<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['bestSellers']->value['colors'], ENT_QUOTES, 'UTF-8');?>
',
    		borderColor: '<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['bestSellers']->value['colors'], ENT_QUOTES, 'UTF-8');?>
',
    		borderWidth: 1,
    		data: valuesArray,
        label: ''
    	}]
    
    };

  var ctx = document.getElementById('myChart-statistics').getContext('2d');
		window.myBar = new Chart(ctx, {
			type: 'bar',
			data: barChartData,
			options: {
				responsive: true,
				tooltips: {
                    enabled: false,
                    mode: 'index',
                    intersect: false, 
                },
				legend: {
					display: false,
				},
				title: {
					display: true,
					text: ''
				},
        
			}
		});




    document.addEventListener('DOMContentLoaded', function () {

      const urlParams = new URLSearchParams(window.location.search);
      const tab = urlParams.get('tab');
      // console.log(tab)
      if (tab) {
          document.querySelector("#"+tab+"-tab").click();
      }
    });


    <?php echo '</script'; ?>
>


      </div>
<?php
}
}
/* {/block 'page_content'} */
}
