<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:05:44
  from '/home/asw200923/beta/modules/wmmodule_homepage/views/templates/hook/slider_script.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe2f80d52f2_80492942',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '86d345df35444772ba80c2df4134e75e931251d8' => 
    array (
      0 => '/home/asw200923/beta/modules/wmmodule_homepage/views/templates/hook/slider_script.tpl',
      1 => 1711365626,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe2f80d52f2_80492942 (Smarty_Internal_Template $_smarty_tpl) {
echo '<script'; ?>
>
$(window).load(function(){
		$('#angarslider').bxSlider({
			maxSlides: 1,
			slideWidth: 1920,
			infiniteLoop: true,
			auto: true,
			pager: <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['pager']->value, ENT_QUOTES, 'UTF-8');?>
,
			autoHover: <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['pause_hover']->value, ENT_QUOTES, 'UTF-8');?>
,
			speed: 500,
			pause: <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['pause']->value, ENT_QUOTES, 'UTF-8');?>
,
			adaptiveHeight: true,
			touchEnabled: true
		});
});
<?php echo '</script'; ?>
>
<?php }
}
