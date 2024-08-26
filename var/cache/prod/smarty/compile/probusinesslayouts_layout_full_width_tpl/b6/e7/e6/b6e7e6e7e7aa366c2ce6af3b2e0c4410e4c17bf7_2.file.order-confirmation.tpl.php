<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:21:03
  from '/home/asw200923/beta/themes/probusiness/templates/checkout/order-confirmation.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4ef16cad1_36300565',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'b6e7e6e7e7aa366c2ce6af3b2e0c4410e4c17bf7' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/checkout/order-confirmation.tpl',
      1 => 1723115543,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4ef16cad1_36300565 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_22922568366c6f4ef165703_85895294', 'page_content_container');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_124345007566c6f4ef16c458_63199606', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'order_confirmation_header'} */
class Block_150623390966c6f4ef166338_38621575 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

              <div style="display: flex; gap:1rem;justify-content:center;align-items:center;">
                <img src="/img/asd/icon_correct.svg" width="40" height="40" style="width: 40px;height:auto;"/>
                <h3 class="h1 card-title" style="text-align: center;font-weight:400;margin-bottom: 0;">
                                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Order','d'=>'Shop.Theme.OrderConfirmation'),$_smarty_tpl ) );?>

                </h3>
                <h3 class="h1 card-title" style="text-align: center;margin-bottom: 0;">
                  <strong><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['order']->value['details']['reference'], ENT_QUOTES, 'UTF-8');?>
</strong>
                </h3>

                <h3 class="h1 card-title" style="text-align: center;font-weight:400;margin-bottom: 0;">
                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Registered','d'=>'Shop.Theme.OrderConfirmation'),$_smarty_tpl ) );?>

                </h3>
              </div>
              <br>
            <?php
}
}
/* {/block 'order_confirmation_header'} */
/* {block 'hook_order_confirmation'} */
class Block_198859159466c6f4ef16b1c6_54467314 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

              <?php echo $_smarty_tpl->tpl_vars['HOOK_ORDER_CONFIRMATION']->value;?>

            <?php
}
}
/* {/block 'hook_order_confirmation'} */
/* {block 'page_content_container'} */
class Block_22922568366c6f4ef165703_85895294 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_22922568366c6f4ef165703_85895294',
  ),
  'order_confirmation_header' => 
  array (
    0 => 'Block_150623390966c6f4ef166338_38621575',
  ),
  'hook_order_confirmation' => 
  array (
    0 => 'Block_198859159466c6f4ef16b1c6_54467314',
  ),
);
public $prepend = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

    <section id="content-hook_order_confirmation" class="card">
      <div class="card-block">
        <div class="row">
          <div class="col-md-12">
            <div class="banner_order_confirmation" style="max-width: 1350px;display:flex;justify-content:center;margin-bottom:2rem;">
              <img src="/img/asd/Content_pages/order-confirmation/orderconf_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['language']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
.webp" style="width: 100%;height:auto;" />
            </div>
          </div>
          <div class="col-md-12" style="padding: 2rem 0;">

            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_150623390966c6f4ef166338_38621575', 'order_confirmation_header', $this->tplIndex);
?>


            <div style="text-align: center;margin-top:2rem;">
              <p style="font-size: 18px;color: #333;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"In the next few minutes, you will receive an order confirmation by email including the delivery costs to allow you to make your payment via the selected method.",'d'=>"Shop.Theme.OrderConfirmation"),$_smarty_tpl ) );?>
</p>
              <br>
              <p style="font-size: 18px;color: #333;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Please pay attention to any comments that may be present on the order confirmation (ETA, availability, modification, etc.).",'d'=>"Shop.Theme.OrderConfirmation"),$_smarty_tpl ) );?>
</p>
              <br>
              <div class="warnig-order-confirmation" style="width: 100%;display:flex;justify-content:center;margin-block: 2rem 1rem;">
                <img src="/img/asd/icon_danger.svg" width="45" height="45" style="width: 45px;height:auto;" />
              </div>
              <p style="font-size: 18px;color: #333;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Please do not make any payment before receiving and checking the order confirmation sent by our sales department.",'d'=>"Shop.Theme.OrderConfirmation"),$_smarty_tpl ) );?>
</p>
              <br>
              <p style="font-size: 18px;color: #333;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Thank you",'d'=>"Shop.Theme.OrderConfirmation"),$_smarty_tpl ) );?>
</p>
              <br>
              <div>
                <a class="btn btn-default btn-view-history" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('my-account'), ENT_QUOTES, 'UTF-8');?>
" title="Go to your order history page"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"View your order history",'d'=>"Shop.Theme.OrderConfirmation"),$_smarty_tpl ) );?>
</a>
              </div>
            </div>

            
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_198859159466c6f4ef16b1c6_54467314', 'hook_order_confirmation', $this->tplIndex);
?>


          </div>
        </div>
      </div>
    </section>
<?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_content_container'} */
class Block_124345007566c6f4ef16c458_63199606 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_124345007566c6f4ef16c458_63199606',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  


<?php
}
}
/* {/block 'page_content_container'} */
}
