<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:09:59
  from '/home/asw200923/beta/themes/probusiness/templates/catalog/_partials/miniatures/product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc3857748e05_44492860',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'cf43e950a4d0aa21cdbc9d9e2afca3e90db71cb1' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/catalog/_partials/miniatures/product.tpl',
      1 => 1723650859,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cc3857748e05_44492860 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_2551112466cc385772c526_49283697', 'product_miniature_item');
?>

 <?php }
/* {block 'product_thumbnail'} */
class Block_112634181566cc385772e261_04135320 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

           <?php if ($_smarty_tpl->tpl_vars['product']->value['cover']) {?>
             <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="thumbnail product-thumbnail">
               <picture>
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
                   style="width:125px;height:auto;border: 2px solid #dedede;"
                 />
               </picture>
             </a>
           <?php } else { ?>
             <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" class="thumbnail product-thumbnail">
               <picture>
                 <img
                   src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['reference'],$_smarty_tpl->tpl_vars['product']->value['id_image'],null,'jpg',$_smarty_tpl->tpl_vars['product']->value['id_product'],$_smarty_tpl->tpl_vars['product']->value['id_manufacturer'],'thumb'), ENT_QUOTES, 'UTF-8');?>
"
                   loading="lazy"
                   width="125"
                   height="125"
                   style="width:125px;height:auto;border: 2px solid #dedede;"
                 />
               </picture>
             </a>
           <?php }?>
         <?php
}
}
/* {/block 'product_thumbnail'} */
/* {block 'product_name'} */
class Block_142005205666cc3857735660_76662516 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'index') {?>
                  <h3 class="h3 product-title-list"><a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" content="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" style="font-weight: 400;font-size:16px;line-height:18px;color:#444;" title="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a></h3>
                <?php } else { ?>
                  <h2 class="h3 product-title-list"><a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" content="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
" style="font-weight: 400;font-size:16px;line-height:18px;color:#444;" title="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');?>
</a></h2>
                <?php }?>
              <?php
}
}
/* {/block 'product_name'} */
/* {block 'product_quantity'} */
class Block_120202898766cc385773dc42_23751455 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                        <div class="product-quantity clearfix">
                          <div class="qty">
                            <input
                              type="number"
                              name="qty"
                              id="quantity_wanted"
                              inputmode="numeric"
                              pattern="[0-9]*"
                              <?php if ($_smarty_tpl->tpl_vars['product']->value['quantity_wanted']) {?>
                                value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['quantity_wanted'], ENT_QUOTES, 'UTF-8');?>
"
                                min="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['minimal_quantity'], ENT_QUOTES, 'UTF-8');?>
"
                              <?php } else { ?>
                                value="1"
                                min="1"
                              <?php }?>
                              class="input-group"
                              aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Quantity','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
"
                            >
                          </div>
                  
                          <div class="add">
                            <button
                              class="btn btn-primary add-to-cart"
                              data-button-action="add-to-cart"
                              type="submit"
                              <?php if (!$_smarty_tpl->tpl_vars['product']->value['add_to_cart_url']) {?>
                                disabled
                              <?php }?>
                              style="display: flex;"
                            >
                              <i class="material-icons shopping-cart" style="margin-right: 0;">&#xE547;</i>
                            </button>
                          </div>
                  
                                                  </div>
                      <?php
}
}
/* {/block 'product_quantity'} */
/* {block 'product_refresh'} */
class Block_111373922166cc3857740201_85555900 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'product_refresh'} */
/* {block 'product_buy'} */
class Block_6436414566cc385773c7c3_14752600 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                        
                                        <div class="product-add-to-cart js-product-add-to-cart">
                      <form action="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['cart'], ENT_QUOTES, 'UTF-8');?>
" method="post" id="add-to-cart-or-refresh">
                      <input type="hidden" name="token" value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['static_token']->value, ENT_QUOTES, 'UTF-8');?>
">
                      <input type="hidden" name="id_product" value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id'], ENT_QUOTES, 'UTF-8');?>
" id="product_page_product_id">
                      <input type="hidden" name="id_customization" value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_customization'], ENT_QUOTES, 'UTF-8');?>
" id="product_customization_id" class="js-product-customization-id">
    
                      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_120202898766cc385773dc42_23751455', 'product_quantity', $this->tplIndex);
?>

    
                      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_111373922166cc3857740201_85555900', 'product_refresh', $this->tplIndex);
?>

                    </form>
                    </div>
                                      <?php
}
}
/* {/block 'product_buy'} */
/* {block 'product_price_and_shipping'} */
class Block_189433831766cc3857738a61_23162096 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

              <?php if ($_smarty_tpl->tpl_vars['product']->value['show_price']) {?>
                <div class="product-price-and-shipping" style="display: flex;flex-direction:column;align-items:end;">
                                    <div style="font-size: 16px;padding: 3px 0;display:flex;align-items:center;gap:0.25rem;line-height:18px;font-weight:400;color:#444;" class="list-name">
                    <div style="text-transform: uppercase;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Stock','d'=>"Shop.Theme.ProductList"),$_smarty_tpl ) );?>
:</div>
                    <?php if (($_smarty_tpl->tpl_vars['product']->value['quantity'] == 1)) {?>
                          <div style="color: orange;font-weight:600;font-size:16px;"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['quantity'], ENT_QUOTES, 'UTF-8');?>
</div>
                    <?php } elseif (($_smarty_tpl->tpl_vars['product']->value['quantity'] > 1)) {?>
                        <div style="color: green;font-weight:600;font-size:16px;"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['quantity'], ENT_QUOTES, 'UTF-8');?>
</div>
                    <?php } elseif ($_smarty_tpl->tpl_vars['product']->value['quantity'] < 1) {?>
                          <div style="color: red;font-weight:600;font-size:16px;">0</div>
                    <?php }?>
                  </div>

                      
                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'unit_price'),$_smarty_tpl ) );?>

    
                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'weight'),$_smarty_tpl ) );?>

    
                  
    
                  <div class="product-actions js-product-actions">
                  <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_6436414566cc385773c7c3_14752600', 'product_buy', $this->tplIndex);
?>

    
                </div>
                  
                </div>
              <?php }?>
            <?php
}
}
/* {/block 'product_price_and_shipping'} */
/* {block 'product_miniature_item'} */
class Block_2551112466cc385772c526_49283697 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'product_miniature_item' => 
  array (
    0 => 'Block_2551112466cc385772c526_49283697',
  ),
  'product_thumbnail' => 
  array (
    0 => 'Block_112634181566cc385772e261_04135320',
  ),
  'product_name' => 
  array (
    0 => 'Block_142005205666cc3857735660_76662516',
  ),
  'product_price_and_shipping' => 
  array (
    0 => 'Block_189433831766cc3857738a61_23162096',
  ),
  'product_buy' => 
  array (
    0 => 'Block_6436414566cc385773c7c3_14752600',
  ),
  'product_quantity' => 
  array (
    0 => 'Block_120202898766cc385773dc42_23751455',
  ),
  'product_refresh' => 
  array (
    0 => 'Block_111373922166cc3857740201_85555900',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.number_format.php','function'=>'smarty_modifier_number_format',),));
?>

 <div class="js-product product<?php if (!empty($_smarty_tpl->tpl_vars['productClasses']->value)) {?> <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['productClasses']->value, ENT_QUOTES, 'UTF-8');
}?>" style="padding:0;">
 
 <article class="product-miniature js-product-miniature" data-id-product="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_product'], ENT_QUOTES, 'UTF-8');?>
" data-id-product-attribute="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_product_attribute'], ENT_QUOTES, 'UTF-8');?>
" style="display: flex;width:100%;height:139px;<?php if ($_smarty_tpl->tpl_vars['position']->value%2 != 0) {?>border-left: 2px solid #0273EB<?php }?>" >
 
     <div class="thumbnail-container" style="display: flex;align-items:center;">
     
       <div class="thumbnail-top col-lg-2 col-md-3 col-sm-6 col-xs-6 px-0" style="display: flex !important;justify-content:center;" >
         <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_112634181566cc385772e261_04135320', 'product_thumbnail', $this->tplIndex);
?>

       </div>
 
       <div class="col-lg-10" style="display: flex;flex-direction:column;height:100%;">
         <div class="col-lg-12 px-0" style="display: flex;align-items:center;flex:1;">
          <div class="information-product col-lg-8 col-md-5 col-sm-12 col-xs-12 px-0" onclick="window.location.href='<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
'">
                              <div class="brand-product" style="font-weight: 700;font-size:16px;line-height:18px;color:#111;text-transform:uppercase;" ><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['manufacturer_name'], ENT_QUOTES, 'UTF-8');?>
</div>
              <div class="referencia" style="font-weight: 400;font-size:16px;line-height:18px;color: #0273EB;"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['reference'], ENT_QUOTES, 'UTF-8');?>
</div>
              <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_142005205666cc3857735660_76662516', 'product_name', $this->tplIndex);
?>

    
          </div>
            
          <div class="product-description col-lg-4 col-md-4 col-sm-12 col-xs-12" >
    
            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_189433831766cc3857738a61_23162096', 'product_price_and_shipping', $this->tplIndex);
?>

    
                      </div>
        </div>

        <div class="product-prices-bottom col-lg-12 px-0" style="display: flex;justify-content:space-between;padding-top: 0.25rem;cursor:pointer;"  onclick="window.location.href='<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
'">
                      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"old_price"),$_smarty_tpl ) );?>

            <div class="old_price" style="display: flex;align-items:center;gap:0.5rem;font-size:16px;font-weight:400;justify-content:center;color:#444;">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"RRP / PVP",'d'=>"Shop.Theme.ProductList"),$_smarty_tpl ) );?>

            <span class="regular-price" aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Regular price','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
" style="font-size: 16px;font-weight:600;color:#444;margin-bottom:0;text-decoration: line-through;"><?php echo htmlspecialchars((string) smarty_modifier_number_format($_smarty_tpl->tpl_vars['product']->value['price_without_reduction_without_tax'],2), ENT_QUOTES, 'UTF-8');?>
€</span>
            </div>

          
          <div class="discount" style="color:#444;font-size: 16px;font-weight:400;line-height:21px;text-transform:uppercase;display:flex;align-items:center;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Discount:",'d'=>"Shop.Theme.ProductList"),$_smarty_tpl ) );?>
<span style="font-size: 16px;font-weight:400;line-height:24px;margin:0;"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['discount_percentage'], ENT_QUOTES, 'UTF-8');?>
</span></div>
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>"before_price"),$_smarty_tpl ) );?>


          <span class="price" aria-label="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Price','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
" style="line-height:26px;margin:0;display:flex;align-items:center;gap:0.5rem">
            <?php $_smarty_tpl->smarty->ext->_capture->open($_smarty_tpl, 'custom_price', null, null);
echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayProductPriceBlock','product'=>$_smarty_tpl->tpl_vars['product']->value,'type'=>'custom_price','hook_origin'=>'products_list'),$_smarty_tpl ) );
$_smarty_tpl->smarty->ext->_capture->close($_smarty_tpl);?>
            <?php if ('' !== $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'custom_price')) {?>
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Price",'d'=>"Shop.Theme.ProductList"),$_smarty_tpl ) );?>
: <?php echo $_smarty_tpl->smarty->ext->_capture->getBuffer($_smarty_tpl, 'custom_price');?>

            <?php } else { ?>
              <span style="font-size:16px;color: #444;text-transform:uppercase;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Price",'d'=>"Shop.Theme.ProductList"),$_smarty_tpl ) );?>
:</span> <span style="font-size: 21px;font-weight:700;color:#0273EB;"><?php echo htmlspecialchars((string) smarty_modifier_number_format(($_smarty_tpl->tpl_vars['product']->value['price_without_reduction_without_tax']-$_smarty_tpl->tpl_vars['product']->value['reduction_without_tax']),2), ENT_QUOTES, 'UTF-8');?>
€</span>
            <?php }?>
          </span>
        </div>

       </div>

       
 
            </div>
   </article>
 </div>

  <?php
}
}
/* {/block 'product_miniature_item'} */
}
