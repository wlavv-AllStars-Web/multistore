<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:05:43
  from '/home/asw200923/beta/themes/classicNew/templates/_partials/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe2f7c83452_80539493',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '0e280f99b88cdc6b322eb4473b3fbb43868c3b76' => 
    array (
      0 => '/home/asw200923/beta/themes/classicNew/templates/_partials/footer.tpl',
      1 => 1719912747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe2f7c83452_80539493 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, false);
?>
 <div class="hidden-md-up" style="border-top:4px solid #103054;border-bottom:4px solid #ee302e;padding-block:2px;width: 100%;background:#fff;"></div>
<div class="container">
<div id="scrollToTopBtn" onclick="scrollToTop()" >
            <i class="fa-solid fa-arrow-up"></i>
    </div>
  <div class="row" style="display: none;">
    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_131313740466cbe2f7c7dc62_33885157', 'hook_footer_before');
?>

  </div>
</div>
<div class="footer-container">
    <div class="lines">
    <div class="line1"></div>
    <div class="line2"></div>
    <div class="line3"></div>
  </div>
  <div class="container-md container-fluid">
    <div class="row footer-row">
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_189231220666cbe2f7c7edc0_90125750', 'hook_footer');
?>

      <div class="socials hidden-md-down">
        <a aria-label="Facebook" id="footer_facebook" class="social-icon" style="margin-right: 5px;" href="https://www.facebook.com/people/Euro-muscle-partscom/61551422408680/" target="_NEW">
          <i class="fa-brands fa-square-facebook"></i>
        </a>
        <a aria-label="Instagram" id="footer_insta" class="social-icon" style="margin-right: 5px;" href="https://www.instagram.com/euromusclepart" target="_NEW">
          <i class="fa-brands fa-instagram"></i>
        </a>
        <a aria-label="Flickr" id="footer_flickr" class="social-icon" style="margin-right: 5px;" href="https://www.flickr.com/photos/allstarsmotorsport/" target="_NEW">
          <i class="fa-brands fa-flickr"></i>
        </a>
        <a aria-label="Youtube" id="footer_youtube" class="social-icon" style="margin-right: 5px;" href="https://www.youtube.com/user/allstarsmotorsport" target="_NEW">
          <i class="fa-brands fa-youtube"></i>
        </a>
      </div>
    </div>
    <div class="row">
      <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_207556944066cbe2f7c80050_77848705', 'hook_footer_after');
?>

    </div>
    <div class="row">
      <div class="col-md-12 socialsMobile">
      <a aria-label="Facebook" id="footer_facebook" class="social-icon" style="margin-right: 5px;" href="https://www.facebook.com/people/Euro-muscle-partscom/61551422408680/" target="_NEW">
        <i class="fa-brands fa-square-facebook"></i>
      </a>
      <a aria-label="Instagram" id="footer_insta" class="social-icon" style="margin-right: 5px;" href="https://www.instagram.com/euromusclepart" target="_NEW">
        <i class="fa-brands fa-instagram"></i>
      </a>
      <a aria-label="Flickr" id="footer_flickr" class="social-icon" style="margin-right: 5px;" href="https://www.flickr.com/photos/allstarsmotorsport/" target="_NEW">
        <i class="fa-brands fa-flickr"></i>
      </a>
      <a aria-label="Youtube" id="footer_youtube" class="social-icon" style="margin-right: 5px;" href="https://www.youtube.com/user/allstarsmotorsport" target="_NEW">
        <i class="fa-brands fa-youtube"></i>
      </a>
      </div>
      <div class="col-md-12 copyrights">
        <p class="text-sm-center">
          <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_91279983866cbe2f7c80fe6_01151979', 'copyright_link');
?>

        </p>
      </div>
    </div>
  </div>
</div>

<?php echo '<script'; ?>
>
document.addEventListener("scroll", (event) => {
  const buttonTop = document.querySelector('#scrollToTopBtn')
  const currentScroll = document.documentElement.scrollTop || document.body.scrollTop;
  if(currentScroll > 0){
    buttonTop.style.display = "flex";
  } else {
    buttonTop.style.display = "none";
  }
})

function scrollToTop() {
        window.scrollTo({
        top: 0,
        behavior: 'smooth',
      });
    }

  window.addEventListener('load', () => {
  const footer = document.querySelector('#footer.js-footer');
  const menuMobile = document.querySelector('#mobile_top_menu_wrapper');
  
  if(menuMobile.style.display === "none"){
    footer.style.display = "block"
  
  } else {
    footer.style.display = "none"

  }
})





<?php echo '</script'; ?>
><?php }
/* {block 'hook_footer_before'} */
class Block_131313740466cbe2f7c7dc62_33885157 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_before' => 
  array (
    0 => 'Block_131313740466cbe2f7c7dc62_33885157',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterBefore'),$_smarty_tpl ) );?>

    <?php
}
}
/* {/block 'hook_footer_before'} */
/* {block 'hook_footer'} */
class Block_189231220666cbe2f7c7edc0_90125750 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer' => 
  array (
    0 => 'Block_189231220666cbe2f7c7edc0_90125750',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooter'),$_smarty_tpl ) );?>

      <?php
}
}
/* {/block 'hook_footer'} */
/* {block 'hook_footer_after'} */
class Block_207556944066cbe2f7c80050_77848705 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'hook_footer_after' => 
  array (
    0 => 'Block_207556944066cbe2f7c80050_77848705',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

        <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterAfter'),$_smarty_tpl ) );?>

      <?php
}
}
/* {/block 'hook_footer_after'} */
/* {block 'copyright_link'} */
class Block_91279983866cbe2f7c80fe6_01151979 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'copyright_link' => 
  array (
    0 => 'Block_91279983866cbe2f7c80fe6_01151979',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

            <a href="/" target="_blank" rel="noopener noreferrer nofollow" style="color: #fff;text-decoration:underline;text-decoration-color:#ee302e">
              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'%copyright% %year% - Euro Muscle Parts','sprintf'=>array('%prestashop%'=>'PrestaShop™','%year%'=>call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'date' ][ 0 ], array( 'Y' )),'%copyright%'=>'©'),'d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>

            </a>
            <p style="color: #fff;"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'All Rights Reserved','d'=>'Shop.Theme.Global'),$_smarty_tpl ) );?>
</p>
          <?php
}
}
/* {/block 'copyright_link'} */
}
