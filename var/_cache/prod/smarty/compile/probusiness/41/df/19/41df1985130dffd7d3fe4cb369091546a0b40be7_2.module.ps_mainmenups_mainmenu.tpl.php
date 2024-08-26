<?php
/* Smarty version 4.3.4, created on 2024-08-21 12:23:24
  from 'module:ps_mainmenups_mainmenu.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c5ce2c45e3f7_00471925',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '41df1985130dffd7d3fe4cb369091546a0b40be7' => 
    array (
      0 => 'module:ps_mainmenups_mainmenu.tpl',
      1 => 1723459306,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c5ce2c45e3f7_00471925 (Smarty_Internal_Template $_smarty_tpl) {
$_smarty_tpl->smarty->ext->_tplFunction->registerTplFunctions($_smarty_tpl, array (
  'menu' => 
  array (
    'compiled_filepath' => '/home/asw200923/beta/var/cache/prod/smarty/compile/probusiness/41/df/19/41df1985130dffd7d3fe4cb369091546a0b40be7_2.module.ps_mainmenups_mainmenu.tpl.php',
    'uid' => '41df1985130dffd7d3fe4cb369091546a0b40be7',
    'call_name' => 'smarty_template_function_menu_48724347266c5ce2c4353c5_66881945',
  ),
));
?><style>
  @media (min-width: 901px) {
    .deformula {
      display: none !important;
    }
  }

  @media (max-width: 900px) {
    .colu {
      flex-direction: column;
    }
  }
</style>

  <div style="width: 80vw;" class="menu js-top-menu position-static formula row" id="_desktop_top_menu_desktop">
  <?php if (Context::getContext()->customer->logged) {?>
    <ul style="width:100%; display:flex; justify-content: space-between; margin-bottom:4px;overflow:hidden;" class="top-menu colu" id="top-menu" data-depth="0">
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-23">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item <?php if ($_smarty_tpl->tpl_vars['showNotificationBall']->value === 1) {?> ball_notification<?php }?>" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('myaccount',true), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
            <span>
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My Account','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

            </span>
          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-24">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('new-products',true), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'News','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('manufacturer'), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Brands','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('catalog',true), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Catalogs','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-25">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getCategoryLink(16),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Clearence','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>

    </ul>
  <?php } else { ?>
    <ul style="width:100%; display:flex; justify-content: space-between; margin-bottom:5px" class="top-menu colu" id="top-menu" data-depth="0">
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-23">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(8), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'About Us','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-24">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(14), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Become a dealer','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-25">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(15), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Become a suplier','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>

      <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 700;line-height:50px;" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('manufacturer'), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Brands','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>
    </ul>
  <?php }?>
  <div class="clearfix"></div>
</div>


<div style="width: 100vw; display: flex; flex-direction: column" class="deformula ">
  <div style="width:100vw;" class="menu js-top-menu position-static row" id="_desktop_top_mobile">
    <button style="float: left; " class="navbar-toggler" type="button" data-toggle="collapse"
      data-target="#_desktop_top_menu" aria-controls="_desktop_top_menu" aria-expanded="false"
      aria-label="Toggle mobile menu">
      <i style="color: white; float:left; font-size:xx-large;" class="material-icons">&#xE5D2;</i>
    </button>
    <?php if (Context::getContext()->customer->logged) {?>

      <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displaySearch'),$_smarty_tpl ) );?>


    <?php } else { ?>
      <button style="float: right; padding-left:24px; padding-top: 15px; color: white " class="navbar-toggler"
        type="button" data-toggle="collapse" data-target="#login_block" aria-controls="login_block" aria-expanded="false"
        aria-label="Toggle mobile menu">
        <span class="logtext"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Login','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>
</span>
      </button>
    <?php }?>
  </div>
  <?php if (Context::getContext()->customer->logged) {?>
    <div style="margin: 0; width: 100vw;" class="js-top-menu collapse navbar-collapse row" id="_desktop_top_menu">
      <ul style="width:100%; display:flex; justify-content: space-between; margin-bottom:5px" class="top-menu colu" id="top-menu" data-depth="0">
        <li style="width: 100%" class="mxsz cms-page" id="cms-page-23">
            <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('myaccount',true), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'My Account','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

            </a>
        </li>
        <li style="width: 100%" class="mxsz cms-page" id="cms-page-24">
            <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('new-products',true), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'News','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

            </a>
        </li>
        <li style="width: 100%" class="mxsz cms-page" id="cms-page-25">
            <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('manufacturer'), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Brands','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

            </a>
        </li>

        <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
            <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value->getCategoryLink(16),'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Clearence','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

            </a>
        </li>
        <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
            <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('catalog',true), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Catalogs','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

            </a>
        </li>
      </ul>
      <div class="clearfix"></div>
    </div>
  <?php } else { ?>
  <div style="margin: 0; width: 100vw;" class="js-top-menu collapse navbar-collapse row" id="_desktop_top_menu">
    <ul style="width:100%; display:flex; justify-content: space-between; margin-bottom:5px" class="top-menu colu" id="top-menu" data-depth="0">
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-23">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(8), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'About Us','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-24">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(14), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Become a dealer','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>
      <li style="width: 100%" class="mxsz cms-page" id="cms-page-25">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(15), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Become a suplier','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>

      <li style="width: 100%" class="mxsz cms-page" id="cms-page-26">
          <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600" class="bortextalign dropdown-item" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('manufacturer'), ENT_QUOTES, 'UTF-8');?>
" data-depth="0">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Brands','d'=>'Shop.Theme.Menu'),$_smarty_tpl ) );?>

          </a>
      </li>
    </ul>
    <div class="clearfix"></div>
  </div>
  <?php }?>
  

  <div
    style="text-align: end; padding-top: 12px; width: 100% !important; padding-left: 25px; padding-right: 25px; background-color:white"
    id="login_block" class="collapse navbar-collapse mxsz">

    <form style="display:flex;flex-direction: column; width: 100%" id="login-form" action="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getPageLink('authentication',true), ENT_QUOTES, 'UTF-8');?>
" method="post"
    name="continue"
    data-link-action="sign-in"
    type="submit"
    value="1">
    
      <div style="display:flex; width:100%; height: min-content" class="form-group col">
        <i class="fa fa-user" style="font-size: 25px; padding: 5px 7px; background-color: #0273eb; color: white"></i>
        <input type="text" class="form-control whtbl" id="email" name="email" placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Email"),$_smarty_tpl ) );?>
">
      </div>
      <div style="margin-bottom:0 ;  display: flex; flex-direction: column ; width: 100%; margin-top: 20px"
        class="form-group col">
        <div style="display:flex; flex-direction: row">
          <i class="fa fa-unlock"
            style="font-size: 25px; padding: 5px 7px;  background-color: #0273eb; color: white "></i>
          <input class="form-control js-child-focus js-visible-password whtbl" name="password" type="password" value=""
            required placeholder="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Password"),$_smarty_tpl ) );?>
">
        </div>
        <div style="justify-content:end">
          <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayPaCaptcha','posTo'=>'login'),$_smarty_tpl ) );?>

          <a href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['urls']->value['pages']['password'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" rel="nofollow" style="color: #0273EB">
            <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Forgot your password?','d'=>'Shop.Theme.Actions'),$_smarty_tpl ) );?>

          </a>
        </div>
      </div>
      <div style="width: 100% ; margin-top: 20px" class="form-group col">
        <input type="hidden" name="submitLogin" value="1">
        <button style=" width: 100%; " type="submit" class="btn whtbl"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Login"),$_smarty_tpl ) );?>
</button>
      </div>
    </form>

  </div>
</div>


<?php }
/* smarty_template_function_menu_48724347266c5ce2c4353c5_66881945 */
if (!function_exists('smarty_template_function_menu_48724347266c5ce2c4353c5_66881945')) {
function smarty_template_function_menu_48724347266c5ce2c4353c5_66881945(Smarty_Internal_Template $_smarty_tpl,$params) {
$params = array_merge(array('nodes'=>array(),'depth'=>0,'parent'=>null), $params);
foreach ($params as $key => $value) {
$_smarty_tpl->tpl_vars[$key] = new Smarty_Variable($value, $_smarty_tpl->isRenderingCache);
}
$_smarty_tpl->_checkPlugins(array(0=>array('file'=>'/home/asw200923/beta/vendor/smarty/smarty/libs/plugins/modifier.count.php','function'=>'smarty_modifier_count',),));
?>

  <?php if (smarty_modifier_count($_smarty_tpl->tpl_vars['nodes']->value)) {?>

    <ul style="width:100%; display:flex; justify-content: space-between; margin-bottom:4px;overflow:hidden;" class="top-menu colu"
      <?php if ($_smarty_tpl->tpl_vars['depth']->value == 0) {?>id="top-menu" <?php }?> data-depth="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['depth']->value, ENT_QUOTES, 'UTF-8');?>
">

      <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['nodes']->value, 'node');
$_smarty_tpl->tpl_vars['node']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['node']->value) {
$_smarty_tpl->tpl_vars['node']->do_else = false;
?>

        <?php if (Context::getContext()->customer->logged == 1) {?>
          <?php if ($_smarty_tpl->tpl_vars['node']->value['label'] == "Logged") {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['node']->value['children'], 'children');
$_smarty_tpl->tpl_vars['children']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['children']->value) {
$_smarty_tpl->tpl_vars['children']->do_else = false;
?>
              <?php if ($_smarty_tpl->tpl_vars['children']->value['label'] == "Brands") {?>

                <li style="width: 100%" class="mxsz <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['type'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['children']->value['current']) {?> current <?php }?>"
                  id="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['page_identifier'], ENT_QUOTES, 'UTF-8');?>
">
                  <?php $_smarty_tpl->_assignInScope('_counter', $_smarty_tpl->tpl_vars['_counter']->value+1);?>
                  <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600"
                    class="bortextalign <?php if ($_smarty_tpl->tpl_vars['depth']->value >= 0) {?>dropdown-item<?php }
if ($_smarty_tpl->tpl_vars['depth']->value === 1) {?> dropdown-submenu<?php }?>" href="/brands"
                    data-depth="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['depth']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['children']->value['open_in_new_window']) {?> target="_blank" <?php }?>>

                    <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['label'], ENT_QUOTES, 'UTF-8');?>

                  </a>
                </li>
              <?php } else { ?>

                <li style="width: 100%" class="mxsz <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['type'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['children']->value['current']) {?> current <?php }?>"
                  id="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['page_identifier'], ENT_QUOTES, 'UTF-8');?>
">
                  <?php $_smarty_tpl->_assignInScope('_counter', $_smarty_tpl->tpl_vars['_counter']->value+1);?>
                  <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600"
                    class="bortextalign <?php if ($_smarty_tpl->tpl_vars['depth']->value >= 0) {?>dropdown-item<?php }
if ($_smarty_tpl->tpl_vars['depth']->value === 1) {?> dropdown-submenu<?php }?>"
                    href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['url'], ENT_QUOTES, 'UTF-8');?>
" data-depth="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['depth']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['children']->value['open_in_new_window']) {?> target="_blank" <?php }?>>

                    <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['label'], ENT_QUOTES, 'UTF-8');?>

                  </a>
                </li>
              <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php }?>
        <?php } elseif (Context::getContext()->customer->logged == 0) {?>


          <?php if ($_smarty_tpl->tpl_vars['node']->value['label'] == "NotLogged") {?>
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['node']->value['children'], 'children');
$_smarty_tpl->tpl_vars['children']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['children']->value) {
$_smarty_tpl->tpl_vars['children']->do_else = false;
?>
              <?php if ($_smarty_tpl->tpl_vars['children']->value['label'] == "Brands") {?>

                <li style="width: 100%" class="mxsz <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['type'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['children']->value['current']) {?> current <?php }?>"
                  id="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['page_identifier'], ENT_QUOTES, 'UTF-8');?>
">
                  <?php $_smarty_tpl->_assignInScope('_counter', $_smarty_tpl->tpl_vars['_counter']->value+1);?>
                  <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600"
                    class="bortextalign <?php if ($_smarty_tpl->tpl_vars['depth']->value >= 0) {?>dropdown-item<?php }
if ($_smarty_tpl->tpl_vars['depth']->value === 1) {?> dropdown-submenu<?php }?>" href="/brands"
                    data-depth="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['depth']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['children']->value['open_in_new_window']) {?> target="_blank" <?php }?>>

                    <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['label'], ENT_QUOTES, 'UTF-8');?>

                  </a>
                </li>
              <?php } else { ?>
                <li style="width: 100%" class="mxsz <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['type'], ENT_QUOTES, 'UTF-8');
if ($_smarty_tpl->tpl_vars['children']->value['current']) {?> current <?php }?>"
                  id="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['page_identifier'], ENT_QUOTES, 'UTF-8');?>
">
                  <?php $_smarty_tpl->_assignInScope('_counter', $_smarty_tpl->tpl_vars['_counter']->value+1);?>
                  <a style="color: white; text-align:center; padding-top: 6px; font-size: 16px; font-weight: 600"
                    class="bortextalign <?php if ($_smarty_tpl->tpl_vars['depth']->value >= 0) {?>dropdown-item<?php }
if ($_smarty_tpl->tpl_vars['depth']->value === 1) {?> dropdown-submenu<?php }?>"
                    href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['url'], ENT_QUOTES, 'UTF-8');?>
" data-depth="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['depth']->value, ENT_QUOTES, 'UTF-8');?>
" <?php if ($_smarty_tpl->tpl_vars['children']->value['open_in_new_window']) {?> target="_blank" <?php }?>>

                    <?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['children']->value['label'], ENT_QUOTES, 'UTF-8');?>

                  </a>
                </li>
              <?php }?>
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
          <?php }?>
        <?php }?>
      <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    </ul>
  <?php }
}}
/*/ smarty_template_function_menu_48724347266c5ce2c4353c5_66881945 */
}
