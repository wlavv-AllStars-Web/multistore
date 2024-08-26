<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:03:48
  from '/home/asw200923/beta/themes/ebusiness/templates/_partials/breadcrumb.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe2841dfa36_47596301',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    'c03e0d24b6b82464d8752f48ad38da4fceddc000' => 
    array (
      0 => '/home/asw200923/beta/themes/ebusiness/templates/_partials/breadcrumb.tpl',
      1 => 1719912747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe2841dfa36_47596301 (Smarty_Internal_Template $_smarty_tpl) {
?> <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] != 'index') {?>
  
  <div class="breadcrumb_wrapper" data-depth="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['breadcrumb']->value['count'], ENT_QUOTES, 'UTF-8');?>
">
    <div class="">
        <nav data-depth="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['breadcrumb']->value['count'], ENT_QUOTES, 'UTF-8');?>
" class="breadcrumb">
          <ol itemscope itemtype="http://schema.org/BreadcrumbList">
                      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['breadcrumb']->value['links'], 'path', false, NULL, 'breadcrumb', array (
  'iteration' => true,
));
$_smarty_tpl->tpl_vars['path']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['path']->value) {
$_smarty_tpl->tpl_vars['path']->do_else = false;
$_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumb']->value['iteration']++;
?>
              <?php if (str_contains($_smarty_tpl->tpl_vars['path']->value['title'],'Home') == true || str_contains($_smarty_tpl->tpl_vars['path']->value['title'],'Accueil') == true || str_contains($_smarty_tpl->tpl_vars['path']->value['title'],'Inicio') == true) {?>
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                  <a itemprop="item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['path']->value['url'], ENT_QUOTES, 'UTF-8');?>
">
                  <i class="fa-solid fa-house" ></i>
                  </a>
                  <meta itemprop="position" content="<?php echo htmlspecialchars((string) (isset($_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumb']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumb']->value['iteration'] : null), ENT_QUOTES, 'UTF-8');?>
" />
                </li>
              <?php } elseif (str_contains($_smarty_tpl->tpl_vars['path']->value['title'],'Brands') == true) {?>
                              <?php } else { ?>
                <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                  <a itemprop="item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['path']->value['url'], ENT_QUOTES, 'UTF-8');?>
">
                    <span itemprop="name"><?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['path']->value['title'], ENT_QUOTES, 'UTF-8');?>
</span>
                  </a>
                  <meta itemprop="position" content="<?php echo htmlspecialchars((string) (isset($_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumb']->value['iteration']) ? $_smarty_tpl->tpl_vars['__smarty_foreach_breadcrumb']->value['iteration'] : null), ENT_QUOTES, 'UTF-8');?>
" />
                </li>
              
              <?php }?>
              
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
            <?php if ($_smarty_tpl->tpl_vars['page']->value['page_name'] == 'cart') {?>
                <li itemtype="http://schema.org/ListItem" itemscope="" itemprop="itemListElement">
                    <a>
                      <span itemprop="name"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Shopping Cart','d'=>'Shop.Theme'),$_smarty_tpl ) );?>
</span>
                    </a>
                  </li>
            <?php }?>
          </ol>
        </nav>
    </div>
</div>
<style>
  .breadcrumb_wrapper{
    padding: 0;
    border-bottom: none;
    background: #f5f5f5;
    font-size: 12px;
    border: 1px solid #d8d8d8;
  }

  .breadcrumb_wrapper nav{
    background: var(--color-grey_light);
  }

  .breadcrumb_wrapper a span {
    color: var(--color-text);
  }
  .breadcrumb_wrapper a span:hover {
    color: var(--asm-color)
  }

  .breadcrumb_wrapper .fa-house {
    color: var(--color-text);
  }

  .breadcrumb_wrapper .fa-house:hover {
    color: var(--asm-color)
  }

  @media screen and (min-width:992px){
    .breadcrumb_wrapper{
    border-top: 3px solid var(--asm-color)
    padding-bottom: 0;
    margin-bottom: 0;
  }
  }

  @media screen and (max-width:991px){
    .breadcrumb_wrapper {
      margin-bottom: 0;
      display: none;
    }
    #cms #main {
      padding: 0;
    }
    #cms #content {
      padding: 0;
    }
  }

</style>

<?php }
}
}
