<?php
/* Smarty version 4.3.4, created on 2024-08-26 09:10:03
  from '/home/asw200923/beta/themes/probusiness/templates/catalog/product.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cc385b385436_90829744',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '789e51bdcd33f8b74969c5a3c2eaa2f1601826f3' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/catalog/product.tpl',
      1 => 1724408855,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
    'file:_partials/microdata/product-jsonld.tpl' => 1,
    'file:catalog/_partials/product-cover-thumbnails.tpl' => 1,
    'file:catalog/_partials/product-prices.tpl' => 1,
    'file:catalog/_partials/product-variants.tpl' => 1,
    'file:catalog/_partials/miniatures/pack-product.tpl' => 1,
    'file:catalog/_partials/product-add-to-cart.tpl' => 1,
    'file:catalog/_partials/product-additional-info.tpl' => 1,
    'file:catalog/_partials/product-images-modal.tpl' => 1,
  ),
),false)) {
function content_66cc385b385436_90829744 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_102875531866cc385b364724_33645408', 'head');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_93121890466cc385b36aff8_47174211', 'head_microdata_special');
?>


<?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_132058992666cc385b36d1d4_30224681', 'content');
?>



<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, $_smarty_tpl->tpl_vars['layout']->value);
}
/* {block 'head'} */
class Block_102875531866cc385b364724_33645408 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head' => 
  array (
    0 => 'Block_102875531866cc385b364724_33645408',
  ),
);
public $append = 'true';
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <meta property="og:type" content="product">
  <?php if ($_smarty_tpl->tpl_vars['product']->value['cover']) {?>
    <meta property="og:image" content="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['cover']['large']['url'], ENT_QUOTES, 'UTF-8');?>
">
  <?php }?>

  <?php if ($_smarty_tpl->tpl_vars['product']->value['show_price']) {?>
    <meta property="product:pretax_price:amount" content="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['price_tax_exc'], ENT_QUOTES, 'UTF-8');?>
">
    <meta property="product:pretax_price:currency" content="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currency']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
">
    <meta property="product:price:amount" content="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['price_amount'], ENT_QUOTES, 'UTF-8');?>
">
    <meta property="product:price:currency" content="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currency']->value['iso_code'], ENT_QUOTES, 'UTF-8');?>
">
  <?php }?>
  <?php if ((isset($_smarty_tpl->tpl_vars['product']->value['weight'])) && ($_smarty_tpl->tpl_vars['product']->value['weight'] != 0)) {?>
  <meta property="product:weight:value" content="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['weight'], ENT_QUOTES, 'UTF-8');?>
">
  <meta property="product:weight:units" content="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['weight_unit'], ENT_QUOTES, 'UTF-8');?>
">
  <?php }
}
}
/* {/block 'head'} */
/* {block 'head_microdata_special'} */
class Block_93121890466cc385b36aff8_47174211 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'head_microdata_special' => 
  array (
    0 => 'Block_93121890466cc385b36aff8_47174211',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

  <?php $_smarty_tpl->_subTemplateRender('file:_partials/microdata/product-jsonld.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
}
}
/* {/block 'head_microdata_special'} */
/* {block 'product_cover_thumbnails'} */
class Block_178580220766cc385b371002_69703708 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-cover-thumbnails.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?>
                            <?php
}
}
/* {/block 'product_cover_thumbnails'} */
/* {block 'page_content'} */
class Block_153833694666cc385b370c56_80197716 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_178580220766cc385b371002_69703708', 'product_cover_thumbnails', $this->tplIndex);
?>

                            <div class="scroll-box-arrows">
                                <i class="material-icons left">&#xE314;</i>
                                <i class="material-icons right">&#xE315;</i>
                            </div>
                        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_35248996366cc385b370842_90378098 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                    <section class="page-content" id="content">
                        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_153833694666cc385b370c56_80197716', 'page_content', $this->tplIndex);
?>

                    </section>
                <?php
}
}
/* {/block 'page_content_container'} */
/* {block 'page_title'} */
class Block_7650369366cc385b371ed2_19792981 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['name'], ENT_QUOTES, 'UTF-8');
}
}
/* {/block 'page_title'} */
/* {block 'product_prices'} */
class Block_701279566cc385b375a56_25976434 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-prices.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> <?php
}
}
/* {/block 'product_prices'} */
/* {block 'product_variants'} */
class Block_99158483866cc385b377b85_99987507 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-variants.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> <?php
}
}
/* {/block 'product_variants'} */
/* {block 'product_miniature'} */
class Block_109037799566cc385b37c4b0_44084145 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/miniatures/pack-product.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('product'=>$_smarty_tpl->tpl_vars['product_pack']->value,'showPackProductsPrice'=>$_smarty_tpl->tpl_vars['product']->value['show_price']), 0, true);
?> <?php
}
}
/* {/block 'product_miniature'} */
/* {block 'product_pack'} */
class Block_51481337466cc385b378559_08658135 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                                <?php if ($_smarty_tpl->tpl_vars['packItems']->value) {?>
                                    <section class="product-pack">
                                        <p class="h4"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'This pack contains','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</p>
                                        <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['packItems']->value, 'product_pack');
$_smarty_tpl->tpl_vars['product_pack']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['product_pack']->value) {
$_smarty_tpl->tpl_vars['product_pack']->do_else = false;
?>
                                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_109037799566cc385b37c4b0_44084145', 'product_miniature', $this->tplIndex);
?>

                                        <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
                                    </section>
                                <?php }?>
                          <?php
}
}
/* {/block 'product_pack'} */
/* {block 'product_add_to_cart'} */
class Block_83486943966cc385b37dea9_77403600 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-add-to-cart.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> <?php
}
}
/* {/block 'product_add_to_cart'} */
/* {block 'product_additional_info'} */
class Block_129397977066cc385b37eb45_73544033 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-additional-info.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> <?php
}
}
/* {/block 'product_additional_info'} */
/* {block 'product_refresh'} */
class Block_97137248866cc385b37f4e6_08150134 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'product_refresh'} */
/* {block 'product_buy'} */
class Block_100586589466cc385b3767c4_46791431 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

                        <form action="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['cart'], ENT_QUOTES, 'UTF-8');?>
" method="post" id="add-to-cart-or-refresh">
                            <input type="hidden" name="token" value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['static_token']->value, ENT_QUOTES, 'UTF-8');?>
">
                            <input type="hidden" name="id_product" value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id'], ENT_QUOTES, 'UTF-8');?>
" id="product_page_product_id">
                            <input type="hidden" name="id_customization" value="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_customization'], ENT_QUOTES, 'UTF-8');?>
" id="product_customization_id" class="js-product-customization-id">
        
                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_99158483866cc385b377b85_99987507', 'product_variants', $this->tplIndex);
?>

        
                            <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_51481337466cc385b378559_08658135', 'product_pack', $this->tplIndex);
?>

        
                          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_83486943966cc385b37dea9_77403600', 'product_add_to_cart', $this->tplIndex);
?>

                          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_129397977066cc385b37eb45_73544033', 'product_additional_info', $this->tplIndex);
?>

                          
                          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_97137248866cc385b37f4e6_08150134', 'product_refresh', $this->tplIndex);
?>

                        </form>
                    <?php
}
}
/* {/block 'product_buy'} */
/* {block 'product_images_modal'} */
class Block_39940375766cc385b384258_07676053 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>
 <?php $_smarty_tpl->_subTemplateRender('file:catalog/_partials/product-images-modal.tpl', $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0, false);
?> <?php
}
}
/* {/block 'product_images_modal'} */
/* {block 'content'} */
class Block_132058992666cc385b36d1d4_30224681 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'content' => 
  array (
    0 => 'Block_132058992666cc385b36d1d4_30224681',
  ),
  'page_content_container' => 
  array (
    0 => 'Block_35248996366cc385b370842_90378098',
  ),
  'page_content' => 
  array (
    0 => 'Block_153833694666cc385b370c56_80197716',
  ),
  'product_cover_thumbnails' => 
  array (
    0 => 'Block_178580220766cc385b371002_69703708',
  ),
  'page_title' => 
  array (
    0 => 'Block_7650369366cc385b371ed2_19792981',
  ),
  'product_prices' => 
  array (
    0 => 'Block_701279566cc385b375a56_25976434',
  ),
  'product_buy' => 
  array (
    0 => 'Block_100586589466cc385b3767c4_46791431',
  ),
  'product_variants' => 
  array (
    0 => 'Block_99158483866cc385b377b85_99987507',
  ),
  'product_pack' => 
  array (
    0 => 'Block_51481337466cc385b378559_08658135',
  ),
  'product_miniature' => 
  array (
    0 => 'Block_109037799566cc385b37c4b0_44084145',
  ),
  'product_add_to_cart' => 
  array (
    0 => 'Block_83486943966cc385b37dea9_77403600',
  ),
  'product_additional_info' => 
  array (
    0 => 'Block_129397977066cc385b37eb45_73544033',
  ),
  'product_refresh' => 
  array (
    0 => 'Block_97137248866cc385b37f4e6_08150134',
  ),
  'product_images_modal' => 
  array (
    0 => 'Block_39940375766cc385b384258_07676053',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.replace.php','function'=>'smarty_modifier_replace',),));
?>


    <meta content="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['url'], ENT_QUOTES, 'UTF-8');?>
">

    <section id="main" style="max-width:1350px;margin:auto;">

        <div class="row" style="text-align: center;">
            <div class="col-lg-2">
                <img src="/img/asd/product/exclusive.webp" style="width: 120px;padding: 25px 0;" alt="Distributor"/>
            </div>
            <div class="col-lg-8">
                <img src="http://webtools.euromuscleparts.com/uploads/manufacturer/ASD/<?php echo htmlspecialchars((string) smarty_modifier_replace($_smarty_tpl->tpl_vars['product']->value->manufacturer_name,' ',''), ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['id_manufacturer'], ENT_QUOTES, 'UTF-8');?>
.webp" style="width: 90%; margin: 0 auto;" alt="Brand banner"/>
            </div>
            <div class="col-lg-2">
                <img src="/img/asd/product/exclusive.webp" style="width: 120px;padding: 25px 0;" alt="Origin"/>
            </div>
        </div>

        <div class="row" style="text-align: center;margin-top: 50px;">
            <div class="col-lg-4">
                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_35248996366cc385b370842_90378098', 'page_content_container', $this->tplIndex);
?>

            </div>
            <div class="col-lg-8">
                
                <div style="margin-bottom: 30px;">
                    <h1 class="h1" style="text-align: center;font-size:30px;color: #666;font-weight:bold;line-height:1.15;text-transform:uppercase;"><?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_7650369366cc385b371ed2_19792981', 'page_title', $this->tplIndex);
?>
</h1>
                    
                    <div class="product-details" >
                        <div class="product-manufacturer"> <span style="font-size: 18px;font-weight:600;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'BRAND:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
 <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value->manufacturer_name, ENT_QUOTES, 'UTF-8');?>
</span> </div>
                        <span class="separator">|</span>
                        <div class="product-reference">    <span style="font-size: 18px;font-weight:600;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'SKU:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
 <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value['reference'], ENT_QUOTES, 'UTF-8');?>
</span> </div>
                    </div>
                    
                    <?php if ($_smarty_tpl->tpl_vars['product']->value->ean13 != '') {?>
                    <div class="product-details" >
                        <div class="product-manufacturer"> <span style="font-size: 18px;font-weight:600;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'UPC:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
 <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['product']->value->ean13, ENT_QUOTES, 'UTF-8');?>
</span> </div>
                    </div>
                    <?php }?>
                    
                    <div style="width: 150px; height: 3px; background-color: lightgrey; margin: 30px auto;"></div>
                </div>

                <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_701279566cc385b375a56_25976434', 'product_prices', $this->tplIndex);
?>



                <div class="product-actions js-product-actions">
                    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_100586589466cc385b3767c4_46791431', 'product_buy', $this->tplIndex);
?>

                </div>
            </div>
            <div class="col-lg-12">
                <div style="width: 80%; height: 3px; background-color: lightgrey; margin: 30px auto;"></div>
            </div>
        </div>

        <div class="row" style="text-align: left;margin-top: 30px;">
            <div class="col-lg-3">
                <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'DISPONIBILITY:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</h1>
                <div style="width: 20%; height: 2px; background-color: #0273eb"></div>
                <div style="font-size: 22px; color: #666;line-height: 1.7; font-weight: bolder;">
                    <div>
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Stock:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span> 
                        <span style="color: green">1000</span>
                    </div>
                    <div>
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Arrive:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span> 
                        <span>15</span>
                    </div>
                    <div>
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'ETA:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span> 
                        <span>12/04/2024</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'PACKAGE:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</h1>
                <div style="width: 20%; height: 2px; background-color: #0273eb"></div>
                <div style="font-size: 22px; color: #666;line-height: 1.7; font-weight: bolder;">
                    <div>
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Volume:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span> 
                        <span>1</span>
                    </div>
                    <div>
                        <span>100x100x100cm</span>
                    </div>
                    <div>
                        <span>32kg</span>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-3">
                <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'INFO:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</h1>
                <div style="width: 20%; height: 2px; background-color: #0273eb"></div>
                <div style="font-size: 22px; color: #666;line-height: 1.7; font-weight: bolder;">
                    <div>
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Origin:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span> 
                        <span>UK</span>
                    </div>
                    <div>
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Rate:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span> 
                        <span>15</span>
                    </div>
                    <div>
                        <span><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Status:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</span> 
                        <span style="color: green">Active</span>
                    </div>
                </div>
                
            </div>
            <div class="col-lg-3">
                <h1><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'LINKS:','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</h1>
                <div style="width: 20%; height: 2px; background-color: #0273eb"></div>
                <div style="font-size: 22px; color: #666;line-height: 1.7; font-weight: bolder;">
                    <div>
                        <a style="color: #666;" href=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Catalogue','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</a> 
                    </div>
                    <div>
                        <a style="color: #666;" href=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Manufacturer website','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</a> 
                    </div>
                    <div>
                        <a style="color: #666;" href=""><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Transport prices','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</a> 
                    </div>
                </div>
            </div>
            
            <div class="col-lg-12">
                <div style="width: 80%; height: 3px; background-color: lightgrey; margin: 50px auto;"></div>
            </div>
            
            <div class="col-lg-12" style="text-align: center;">
                <h1 style="color: #0273eb;font-size:28px"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'DETAILS','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</h1>
                <div style="margin-top: 30px; font-size: 20px; color: #666;line-height: 1.7; font-weight: bolder;">
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. In ultricies, ante id pulvinar porttitor, lacus tellus malesuada tellus, id pretium lorem ligula tincidunt ipsum. Aliquam facilisis et metus eget imperdiet. Suspendisse eleifend ullamcorper nisl, ac posuere nulla sollicitudin non. Proin vulputate accumsan ante in ornare. Suspendisse non tristique est. Cras sollicitudin augue magna, ac congue massa elementum ut. Sed malesuada volutpat ullamcorper. Sed lacinia orci et justo tempus venenatis. Etiam mollis sodales quam sit amet volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Etiam tortor dui, ultrices vel consequat sed, pretium id sapien. Nam vel nisl vel odio egestas tempus a ac orci. Maecenas quam enim, accumsan vehicula euismod hendrerit, dapibus vitae dolor. Suspendisse feugiat odio ac lacinia ultrices. Ut at elementum lacus, quis placerat mauris.
                    <br><br>
                    Proin ultrices, nibh eget dignissim aliquam, enim magna condimentum diam, quis consectetur quam mauris et purus. In at ultrices enim. Proin faucibus imperdiet dui, eget posuere arcu facilisis non. Phasellus ante ligula, iaculis vel gravida ac, tristique sit amet urna. Quisque pharetra, ante eu blandit varius, risus quam scelerisque dui, sit amet sagittis eros purus sed purus. Curabitur diam magna, pulvinar ut leo in, varius blandit tellus. Pellentesque orci dui, semper a gravida vitae, pulvinar id lectus. Sed felis lacus, gravida congue purus id, tempor dictum orci. Suspendisse nec viverra enim. In sit amet lectus est. Morbi sagittis sit amet nibh at ullamcorper. Ut commodo auctor elit eget varius. Nam non varius turpis.
                    <br><br>
                    In risus mi, elementum at lobortis vitae, euismod vel lacus. Nam ut consequat turpis. Sed cursus rutrum ante. Maecenas at leo vulputate, malesuada elit vel, lobortis justo. Cras convallis turpis nec rhoncus dapibus. Pellentesque vulputate pulvinar rutrum. Fusce aliquam maximus fermentum. Aenean tincidunt scelerisque magna quis hendrerit. Curabitur quis congue sapien. Proin sed orci rhoncus justo fringilla porttitor. Fusce vitae gravida erat, id ornare neque. In consectetur accumsan fermentum. Fusce blandit ligula eget mauris ultricies porta.
                    <br><br>
                    Aenean ultrices lacus a quam pretium fringilla. Curabitur a facilisis est. Sed facilisis fringilla tortor. Integer id eleifend nisl, et pharetra metus. Pellentesque eget pretium nunc. Suspendisse potenti. Nulla ut sem varius, tincidunt mauris ut, imperdiet nibh. 
                </div>
            </div>
            
            <div class="col-lg-12">
                <div style="width: 80%; height: 3px; background-color: lightgrey; margin: 50px auto;"></div>
            </div>
            
            <div class="col-lg-12" style="text-align: center;">
                <h1 style="color: #0273eb;font-size:28px"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'NOTE','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
</h1>
                <div style="margin-top: 30px; font-size: 20px; color: #666;line-height: 1.7; font-weight: bolder;">
                    <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Fusce sodales, lorem eget tincidunt eleifend, magna urna vehicula lectus, eu ultrices nunc nulla a turpis. In hac habitasse platea dictumst. Nulla a posuere felis. Vestibulum molestie lectus orci. Suspendisse dapibus nulla ex, sit amet efficitur tellus facilisis id. Etiam suscipit bibendum purus quis gravida. Mauris congue, ante non finibus scelerisque, lorem diam aliquam arcu, aliquam auctor dui nulla ac dui. Vivamus in eros risus. Curabitur vitae massa euismod quam sodales fermentum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Maecenas faucibus, mi non accumsan tincidunt, justo ante fermentum ligula, sit amet accumsan nisi lacus vel purus. Etiam non interdum metus.','d'=>'Shop.Theme.Catalog'),$_smarty_tpl ) );?>
 
                </div>
            </div>
            <div class="col-lg-12">
                <div style="margin: 50px auto;"></div>
            </div>            
        </div>
        
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_39940375766cc385b384258_07676053', 'product_images_modal', $this->tplIndex);
?>

    
    </section>

<?php
}
}
/* {/block 'content'} */
}
