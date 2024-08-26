<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:03:47
  from '/home/asw200923/beta/themes/ebusiness/templates/index.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe283d81b34_59007162',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'fc9f3f2e6592d78ad615d19973689d9aa76a3ff9' => 
    array (
      0 => '/home/asw200923/beta/themes/ebusiness/templates/index.tpl',
      1 => 1719912747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe283d81b34_59007162 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_loadInheritance();
$_smarty_tpl->inheritance->init($_smarty_tpl, true);
?>


 <?php $_smarty_tpl->_assignInScope('currentLanguageIso', Context::getContext()->language->iso_code);
$_smarty_tpl->_assignInScope('currentLanguage', Context::getContext()->language->id);
$_smarty_tpl->_assignInScope('categories', Category::getCategories($_smarty_tpl->tpl_vars['currentLanguage']->value));?>


    <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_133256549266cbe283d6cd81_50718153', 'page_content_container');
?>

<?php $_smarty_tpl->inheritance->endChild($_smarty_tpl, 'page.tpl');
}
/* {block 'page_content_top'} */
class Block_21458680466cbe283d6d4c5_68803318 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
}
}
/* {/block 'page_content_top'} */
/* {block 'page_content'} */
class Block_187134583666cbe283d6dbb8_93288786 extends Smarty_Internal_Block
{
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.regex_replace.php','function'=>'smarty_modifier_regex_replace',),));
?>

                      
          

         
          
          <div class="bannersHome">
                    <div class="swiper-container">
            <div class="swiper-wrapper">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['desktop']->value['banners'], 'item', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
                <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['image_en'])) {?>
                <div class="swiper-slide">
                  <img  src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['image_en'], ENT_QUOTES, 'UTF-8');?>
"/>
                </div>
                <?php }?>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            </div>
            <div class="swiper-pagination"></div>
          </div>

          <div class="banners_50">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['desktop']->value['icones_50'], 'item', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
              <div class="banner_50">
                <img src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['image_en'], ENT_QUOTES, 'UTF-8');?>
" />
              </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </div>

          <div class="banners_33">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['desktop']->value['icones_33'], 'item', false, 'key', 'name', array (
));
$_smarty_tpl->tpl_vars['item']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['item']->value) {
$_smarty_tpl->tpl_vars['item']->do_else = false;
?>
              <div class="banner_33">
                <img src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['item']->value['image_en'], ENT_QUOTES, 'UTF-8');?>
" />
              </div>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </div>
          

          <div class="videosContainer">
              <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['desktop']->value['icones_videos'], 'icon', false, 'key');
$_smarty_tpl->tpl_vars['icon']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['icon']->value) {
$_smarty_tpl->tpl_vars['icon']->do_else = false;
?>
                <div class="video3 video">
                  <div class="firstDiv" onclick="this.nextElementSibling.style.display='block'; this.style.display='none'">
                  <img src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['icon']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
" loading="lazy" alt="banner_<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['icon']->value['youtube_code'], ENT_QUOTES, 'UTF-8');?>
"/>
                    <div class="play">
                      <img class="image_play" alt="video player" src="/img/youtube_play.png" loading="lazy" />
                    </div>
                  </div>
                  <div  class="iframeClass"  style="display:none">
                    <iframe allowfullscreen frameborder="0" src="https://www.youtube.com/embed/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['icon']->value['youtube_code'], ENT_QUOTES, 'UTF-8');?>
?autoplay=0&mute=1&rel=0" loading="lazy">
                    </iframe>
                  </div>
                </div>
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          </div>

          </div>

          <div class="bannersHomeMobile">

            <div class="cards-menu">
              <div class="card-yourcar" onclick="toggleMenuCars(this)"></div>
              <?php echo $_smarty_tpl->tpl_vars['HOOK_HOME']->value;?>

              <div class="cards-menuLink">
                <div class="card-news" onclick="window.location = '<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('new-products',true), ENT_QUOTES, 'UTF-8');?>
';"></div>
                <div class="card-brands" onclick="window.location = '<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('manufacturer',true), ENT_QUOTES, 'UTF-8');?>
';"></div>
              </div>
            </div>
            

            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['mobile']->value, 'mobileItem', false, 'mobilekey', 'mobilename', array (
));
$_smarty_tpl->tpl_vars['mobileItem']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['mobilekey']->value => $_smarty_tpl->tpl_vars['mobileItem']->value) {
$_smarty_tpl->tpl_vars['mobileItem']->do_else = false;
?>
              <?php $_smarty_tpl->_assignInScope('url', $_smarty_tpl->tpl_vars['mobileItem']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)]);?>
              <?php $_smarty_tpl->_assignInScope('numberString', smarty_modifier_regex_replace(((string)$_smarty_tpl->tpl_vars['url']->value),"/.*\/(\d+)_(\d+)_(\d+)_(\d+)_.*"."$"."/","$"."1,"."$"."2,"."$"."3,"."$"."4"));?>
              <?php $_smarty_tpl->_assignInScope('linkBrand', $_smarty_tpl->tpl_vars['mobileItem']->value["link"]);?>

              

              <?php if ($_smarty_tpl->tpl_vars['numberString']->value != $_smarty_tpl->tpl_vars['url']->value) {?>
                <?php $_smarty_tpl->_assignInScope('numbers', array());?>
                  <?php $_smarty_tpl->_assignInScope('numbers', explode(",",$_smarty_tpl->tpl_vars['numberString']->value));?>
              <?php }?>

                <?php if ($_smarty_tpl->tpl_vars['numberString']->value != $_smarty_tpl->tpl_vars['url']->value) {?>
                <a class="card-img card-itemMobile" style="cursor: pointer; position: relative;"
                onclick="setCarAndSearch(<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[0], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[1], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[2], ENT_QUOTES, 'UTF-8');?>
,<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['numbers']->value[3], ENT_QUOTES, 'UTF-8');?>
)">
                <?php } elseif ($_smarty_tpl->tpl_vars['linkBrand']->value != '') {?>
                  <?php if (is_numeric($_smarty_tpl->tpl_vars['linkBrand']->value)) {?>
                    <a class="card-itemMobile" href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currentLanguageIso']->value, ENT_QUOTES, 'UTF-8');?>
/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBrand']->value, ENT_QUOTES, 'UTF-8');?>
-product.html" style="position: relative;">
                  <?php } else { ?>
                    <a class="card-itemMobile" href="/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['currentLanguageIso']->value, ENT_QUOTES, 'UTF-8');?>
/brand/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['linkBrand']->value, ENT_QUOTES, 'UTF-8');?>
" style="position: relative;">
                  <?php }?>
                <?php } else { ?>
                  <a class="card-itemMobile" style="position: relative;">
                <?php }?>

                  <img src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['mobileItem']->value["image_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
" style="width: 100%;" loading="lazy" alt="banner<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['mobilekey']->value, ENT_QUOTES, 'UTF-8');?>
"/>
                  <div class="layerHovermobile"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['mobileItem']->value["title_".((string)$_smarty_tpl->tpl_vars['currentLanguageIso']->value)], ENT_QUOTES, 'UTF-8');?>
</div>

                <?php if ((isset($_smarty_tpl->tpl_vars['numbers']->value))) {?>
                </a>
                <?php } elseif ($_smarty_tpl->tpl_vars['linkBrand']->value != '') {?>
                  </a>
                <?php }?>
                
              <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>

              <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooter','mod'=>'ps_linklist'),$_smarty_tpl ) );?>

          
          </div>


        <?php
}
}
/* {/block 'page_content'} */
/* {block 'page_content_container'} */
class Block_133256549266cbe283d6cd81_50718153 extends Smarty_Internal_Block
{
public $subBlocks = array (
  'page_content_container' => 
  array (
    0 => 'Block_133256549266cbe283d6cd81_50718153',
  ),
  'page_content_top' => 
  array (
    0 => 'Block_21458680466cbe283d6d4c5_68803318',
  ),
  'page_content' => 
  array (
    0 => 'Block_187134583666cbe283d6dbb8_93288786',
  ),
);
public function callBlock(Smarty_Internal_Template $_smarty_tpl) {
?>

      <section id="content" class="page-home" style="">
        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_21458680466cbe283d6d4c5_68803318', 'page_content_top', $this->tplIndex);
?>

        <?php 
$_smarty_tpl->inheritance->instanceBlock($_smarty_tpl, 'Block_187134583666cbe283d6dbb8_93288786', 'page_content', $this->tplIndex);
?>

      </section>
      <style>

      /* @media screen and (max-width:560px) {
        #content{
          display: flex;justify-content:center;width:100%;padding:1rem;
        }
      } */
      .swiper-container {
    width: 100dvw;
    position: relative;
    overflow: hidden;
    }

    .swiper-slide {
        background-size: cover;
        background-position: 50%;
        min-height: 20vh;
        max-width: 100dvw;
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        overflow: hidden !important;
    }
    .swiper-slide img {
      width: 100%;
    }

    .banners_50{
      display: flex;
      gap: .5rem;
      padding: 0.25rem;
    }
    
    .banners_50 .banner_50{
      flex: 1;
    }
    
    .banners_50 .banner_50 img{
      width: 100%;
    }

    .banners_33{
      display: flex;
      gap: .5rem;
      padding: 0.25rem;
    }
    
    .banners_33 .banner_33{
      flex: 1;
    }
    
    .banners_33 .banner_33 img{
      width: 100%;
    }



      </style>
    <?php
}
}
/* {/block 'page_content_container'} */
}
