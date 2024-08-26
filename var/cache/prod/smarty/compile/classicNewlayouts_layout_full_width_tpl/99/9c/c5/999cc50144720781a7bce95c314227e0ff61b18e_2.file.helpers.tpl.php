<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:05:43
  from '/home/asw200923/beta/themes/classicNew/templates/_partials/helpers.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe2f79c1bd6_89097410',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '999cc50144720781a7bce95c314227e0ff61b18e' => 
    array (
      0 => '/home/asw200923/beta/themes/classicNew/templates/_partials/helpers.tpl',
      1 => 1719912747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe2f79c1bd6_89097410 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'renderLogo' => 
  array (
    'compiled_filepath' => '/home/asw200923/beta/var/cache/prod/smarty/compile/classicNewlayouts_layout_full_width_tpl/99/9c/c5/999cc50144720781a7bce95c314227e0ff61b18e_2.file.helpers.tpl.php',
    'uid' => '999cc50144720781a7bce95c314227e0ff61b18e',
    'call_name' => 'smarty_template_function_renderLogo_67637069366cbe2f79be127_10989550',
  ),
));
?> 

<?php }
/* smarty_template_function_renderLogo_67637069366cbe2f79be127_10989550 */
if (!function_exists('smarty_template_function_renderLogo_67637069366cbe2f79be127_10989550')) {
function smarty_template_function_renderLogo_67637069366cbe2f79be127_10989550(Smarty_Internal_Template $_smarty_tpl,$params) {
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
?>

  <a href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['urls']->value['pages']['index'], ENT_QUOTES, 'UTF-8');?>
">
    <img
      class="logo img-fluid"
      src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['logo_details']['src'], ENT_QUOTES, 'UTF-8');?>
"
      alt="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['name'], ENT_QUOTES, 'UTF-8');?>
"
      width="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['shop']->value['logo_details']['width'], ENT_QUOTES, 'UTF-8');?>
"
      height="auto">
  </a>
<?php
}}
/*/ smarty_template_function_renderLogo_67637069366cbe2f79be127_10989550 */
}
