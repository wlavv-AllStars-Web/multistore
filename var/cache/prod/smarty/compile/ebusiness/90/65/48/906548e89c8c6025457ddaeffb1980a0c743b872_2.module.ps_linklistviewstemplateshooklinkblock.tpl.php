<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:03:48
  from 'module:ps_linklistviewstemplateshooklinkblock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe2844c3640_00804809',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '906548e89c8c6025457ddaeffb1980a0c743b872' => 
    array (
      0 => 'module:ps_linklistviewstemplateshooklinkblock.tpl',
      1 => 1719912747,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe2844c3640_00804809 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="footer-asm col-lg-12" style="position: relative;">
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['linkBlocks']->value, 'linkBlock');
$_smarty_tpl->tpl_vars['linkBlock']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['linkBlock']->value) {
$_smarty_tpl->tpl_vars['linkBlock']->do_else = false;
?>

      <?php if ($_smarty_tpl->tpl_vars['linkBlock']->value['title'] === 'Support') {?>
        <div class="links">
      <?php } else { ?>
        <div class="col-md-6 col-lg-12 links">
        <?php }?>
        <div class="row">
      <div class="col-md-6 col-lg-12 wrapper">
        <div class="title clearfix hidden-md-up" data-target="#footer_sub_menu_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBlock']->value['id'], ENT_QUOTES, 'UTF-8');?>
" data-toggle="collapse">
          <span class="h3"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBlock']->value['title'], ENT_QUOTES, 'UTF-8');?>
</span>
          <span class="float-xs-right">
            <span class="navbar-toggler collapse-icons">
              <i class="material-icons add">&#xE313;</i>
              <i class="material-icons remove">&#xE316;</i>
            </span>
          </span>
        </div>
        <ul id="footer_sub_menu_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBlock']->value['id'], ENT_QUOTES, 'UTF-8');?>
" class="collapse">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['linkBlock']->value['links'], 'link');
$_smarty_tpl->tpl_vars['link']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->do_else = false;
?>
            <li>
            
              <a
                  id="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value['id'], ENT_QUOTES, 'UTF-8');?>
-<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBlock']->value['id'], ENT_QUOTES, 'UTF-8');?>
"
                  class="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value['class'], ENT_QUOTES, 'UTF-8');?>
"
                  href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value['url'], ENT_QUOTES, 'UTF-8');?>
"
                  title="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value['description'], ENT_QUOTES, 'UTF-8');?>
"
                  <?php if (!empty($_smarty_tpl->tpl_vars['link']->value['target'])) {?> target="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value['target'], ENT_QUOTES, 'UTF-8');?>
" <?php }?>
              >
              <i class="fa-solid fa-circle-arrow-right hidden-md-down"></i>
                <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value['title'], ENT_QUOTES, 'UTF-8');?>

              </a>
            </li>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <li class="mobile">
            <a onclick="showSocials()">Social Media</a>
          </li>

            <li class="socials-footer desktop col-lg-2">
              <div style="display: flex;">
              <a title="Facebook" aria-label="Facebook" id="footer_facebook" class="social-icon" style="margin-right: 5px;" href="https://www.facebook.com/all-stars-motorsport" target="_NEW"> 
                <img class="desktop" alt="Facebook" src="https://www.all-stars-motorsport.com/img/facebook.png" style="width: 30px; height: 30px;" onmouseover="this.src='https://www.all-stars-motorsport.com/img/facebook2.png'" onmouseout="this.src='https://www.all-stars-motorsport.com/img/facebook.png' "> 
                <img class="mobile" alt="Facebook" src="https://www.all-stars-motorsport.com/img/cms/Mobile_pages/social/facebook_r.png" style="width: 50px;height:50px;" />
              </a> 
              <a title="Instagram" aria-label="Instagram" id="footer_insta" class="social-icon" style="margin-right: 5px;" href="https://instagram.com/allstarsmotorsport" target="_NEW"> 
                <img class="desktop"  alt="Instagram" src="https://www.all-stars-motorsport.com/img/instagram.png" style="width: 30px; height: 30px;" onmouseover="this.src='https://www.all-stars-motorsport.com/img/instagram2.png'" onmouseout="this.src='https://www.all-stars-motorsport.com/img/instagram.png' "> 
                <img class="mobile" alt="Instagram" src="https://www.all-stars-motorsport.com/img/cms/Mobile_pages/social/instagram_r.png"  style="width: 50px;height:50px;"/>
              </a> 
              <a title="Flickr" aria-label="Flickr" id="footer_flickr" class="social-icon" style="margin-right: 5px;" href="https://www.flickr.com/photos/allstarsmotorsport/" target="_NEW"> 
                <img class="desktop"  alt="Flickr" src="https://www.all-stars-motorsport.com/img/flickr.png" style="width: 30px; height: 30px;" onmouseover="this.src='https://www.all-stars-motorsport.com/img/flickr2.png'" onmouseout="this.src='https://www.all-stars-motorsport.com/img/flickr.png' "> 
                <img class="mobile" alt="Flickr" src="https://www.all-stars-motorsport.com/img/cms/Mobile_pages/social/flickr_r.png"  style="width: 50px;height:50px;"/>
              </a> 
              <a title="Youtube" aria-label="Youtube" id="footer_youtube" class="social-icon" style="margin-right: 5px;" href="https://www.youtube.com/user/all-stars-motorsport" target="_NEW"> 
                <img class="desktop"  alt="Youtube" src="https://www.all-stars-motorsport.com/img/youtube.png" style="width: 30px; height: 30px;" onmouseover="this.src='https://www.all-stars-motorsport.com/img/youtube2.png'" onmouseout="this.src='https://www.all-stars-motorsport.com/img/youtube.png' "> 
                <img class="mobile" alt="Youtube" src="https://www.all-stars-motorsport.com/img/cms/Mobile_pages/social/youtube_r.png" style="width: 50px;height:50px;" />
              </a> 
              <a title="Whatsapp" class="social-icon" style="margin-right: 8px;" href="https://wa.me/+351912201753" target="_blank"> 
                <img class="desktop"  alt="Whatsapp" src="https://www.all-stars-motorsport.com/img/whatsapp.png" style="width: 30px; height: 30px;" onmouseover="this.src='https://www.all-stars-motorsport.com/img/whatsapp2.png'" onmouseout="this.src='https://www.all-stars-motorsport.com/img/whatsapp.png' "> 
                <img class="mobile" alt="Whatsapp" src="https://www.all-stars-motorsport.com/img/whatsapp_mobile.png" style="width: 50px;height:50px;"/>
              </a>
            </div>
          </li>
        </ul>

      </div>
      </div>
      </div>

  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

  
</div>	<?php }
}
