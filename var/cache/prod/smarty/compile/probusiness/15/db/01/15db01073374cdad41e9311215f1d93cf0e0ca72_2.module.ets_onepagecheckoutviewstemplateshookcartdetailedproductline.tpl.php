<?php
/* Smarty version 4.3.4, created on 2024-08-22 09:20:46
  from 'module:ets_onepagecheckoutviewstemplateshookcartdetailedproductline.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c6f4deeb15d8_24461232',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '15db01073374cdad41e9311215f1d93cf0e0ca72' => 
    array (
      0 => 'module:ets_onepagecheckoutviewstemplateshookcartdetailedproductline.tpl',
      1 => 1723478639,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c6f4deeb15d8_24461232 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
?>

      <tr id="product_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
" class="cart_item last_item even first_item">
      <td class="cart_delete text-center">
        <div style="display: flex;justify-content: center;"> 
          <a 
            class                       = "remove-from-cart"
            rel                         = "nofollow"
            href                        = "<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['remove_from_cart_url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
            data-link-action            = "ets-delete-from-cart"
            data-id-product             = "<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['id_product'] )), ENT_QUOTES, 'UTF-8');?>
"
            data-id-product-attribute   = "<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'] )), ENT_QUOTES, 'UTF-8');?>
"
            data-id-customization   	  = "<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['id_customization'] )), ENT_QUOTES, 'UTF-8');?>
"
            >
            <?php if (empty($_smarty_tpl->tpl_vars['product']->value['is_gift'])) {?>
              <i class="material-icons float-xs-left">delete</i>
            <?php }?>
          </a>
        </div>
      </td>
      <td class="cart_product" style="width: 125px;"> 
        <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['link'], ENT_QUOTES, 'UTF-8');?>
"> 
          <span class="product-image media-middle">
            <?php if ($_smarty_tpl->tpl_vars['product']->value['default_image']) {?>
            
              
              <img
              class="js-qv-product-cover img-fluid"
              src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['reference'],$_smarty_tpl->tpl_vars['product']->value['id_image'],null,'jpg',$_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['id_manufacturer'],'thumb'), ENT_QUOTES, 'UTF-8');?>
"
              alt="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
"
              loading="lazy"
              width="125"
              height="125"
            >
             
            <?php } else { ?>
              <img
              class="js-qv-product-cover img-fluid"
              src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['reference'],$_smarty_tpl->tpl_vars['product']->value['id_image'],null,'jpg',$_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['id_manufacturer'],'thumb'), ENT_QUOTES, 'UTF-8');?>
"
              alt="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
"
              loading="lazy"
              width="125"
              height="125"
            >
            <?php }?>
          </span>
        </a>
      </td>
      <td class="cart_description" data-title="Descrição">
        <div class="product-line-info">
          <a class="label" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
"
            data-id_customization="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'intval' ][ 0 ], array( $_smarty_tpl->tpl_vars['product']->value['id_customization'] )), ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a>
          <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Reference",'d'=>"Shop.Theme.Checkout"),$_smarty_tpl ) );?>
: <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['reference'], ENT_QUOTES, 'UTF-8');?>
</span>
        </div>
      </td>
      <td class="cart_unit" data-title="Preço unitário">
        <div class="product-line-info product-price h5 desktop <?php if ($_smarty_tpl->tpl_vars['product']->value['has_discount']) {?>has-discount<?php }?>">
                              
          <div class="current-price">
            <span class="price"><?php echo htmlspecialchars((string) smarty_modifier_number_format($_smarty_tpl->tpl_vars['product']->value['price_with_reduction_without_tax'],2), ENT_QUOTES, 'UTF-8');?>
&nbsp;€ </span>
            <?php if ($_smarty_tpl->tpl_vars['product']->value['unit_price_full']) {?>
              <div class="unit-price-cart"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['unit_price_full'], ENT_QUOTES, 'UTF-8');?>
</div>
            <?php }?>
          </div>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"unit_price"),$_smarty_tpl ) );?>

        </div>
      </td>
      <td class="cart_quantity" data-title="Qty" style="width: 200px;"> 
        <div class="qty-price">
          <div class=" shopping-cart-row ">
            <div class="qty" style="margin: auto;width:150px;">
              <?php if (!empty($_smarty_tpl->tpl_vars['product']->value['is_gift'])) {?>
                <span class="gift-quantity"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['quantity'], ENT_QUOTES, 'UTF-8');?>
</span>
              <?php } else { ?>
                <input class="js-cart-line-product-quantity" data-down-url="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['down_quantity_url'], ENT_QUOTES, 'UTF-8');?>
"
                  data-up-url="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['up_quantity_url'], ENT_QUOTES, 'UTF-8');?>
" data-update-url="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['update_quantity_url'], ENT_QUOTES, 'UTF-8');?>
"
                  data-product-id="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
" type="number" inputmode="numeric" pattern="[0-9]*"
                  value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['quantity'], ENT_QUOTES, 'UTF-8');?>
" name="product-quantity-spin"
                  min="1"
                  aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%productName% product quantity field','sprintf'=>array('%productName%'=>$_smarty_tpl->tpl_vars['product']->value['name']),'d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
" />
              <?php }?>
            </div>
            
          </div>
                  </div>
      </td>
            <td class="cart_total" data-title="Total"> 
        <div class="price desktop">
          <span class="product-price">
            <strong>
              <?php if (!empty($_smarty_tpl->tpl_vars['product']->value['is_gift'])) {?>
                <span class="gift"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Gift','d'=>'Shop.Theme.Checkout'),$_smarty_tpl ) );?>
</span>
              <?php } else { ?>
                                <?php echo htmlspecialchars((string) smarty_modifier_number_format(($_smarty_tpl->tpl_vars['product']->value['price_with_reduction_without_tax']*$_smarty_tpl->tpl_vars['product']->value['quantity']),2), ENT_QUOTES, 'UTF-8');?>
 €
              <?php }?>
            </strong>
          </span>
        </div>
      </td>
    </tr>


<div class="clearfix"></div>

<?php }
}
