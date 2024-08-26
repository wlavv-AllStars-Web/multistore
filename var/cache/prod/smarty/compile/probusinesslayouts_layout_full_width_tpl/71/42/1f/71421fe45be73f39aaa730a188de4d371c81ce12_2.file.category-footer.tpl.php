<?php
/* Smarty version 4.3.4, created on 2024-08-22 19:10:34
  from '/home/asw200923/beta/themes/probusiness/templates/catalog/_partials/category-footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c77f1a39f940_63755166',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '71421fe45be73f39aaa730a188de4d371c81ce12' => 
    array (
      0 => '/home/asw200923/beta/themes/probusiness/templates/catalog/_partials/category-footer.tpl',
      1 => 1719912747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c77f1a39f940_63755166 (Smarty_Internal_Template $_smarty_tpl) {
?><div id="js-product-list-footer">
    <?php if ((isset($_smarty_tpl->tpl_vars['category']->value)) && $_smarty_tpl->tpl_vars['category']->value['additional_description'] && $_smarty_tpl->tpl_vars['listing']->value['pagination']['items_shown_from'] == 1) {?>
        <div class="card">
            <div class="card-block category-additional-description">
                <?php echo $_smarty_tpl->tpl_vars['category']->value['additional_description'];?>

            </div>
        </div>
    <?php }?>
</div>
<?php }
}
