<?php
/* Smarty version 4.3.4, created on 2024-08-21 12:23:24
  from 'module:ps_linklistviewstemplateshooklinkblock.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66c5ce2c5243c9_32310339',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '906548e89c8c6025457ddaeffb1980a0c743b872' => 
    array (
      0 => 'module:ps_linklistviewstemplateshooklinkblock.tpl',
      1 => 1721728821,
      2 => 'module',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66c5ce2c5243c9_32310339 (Smarty_Internal_Template $_smarty_tpl) {
?><style>
  .text {
    color: white !important;
    text-transform: uppercase;
    font-weight: 600;
    font-size: 16px !important;
  }

  .footer-container .links li a:before {
    display: none;
  }

  @media (max-width: 760px) {
    .alignment {
      width: 100%;
    }

    .bigalign {
      display: flex;
      flex-direction: row-reverse;


    }
  }

  .links.footer_linklist div.wrapper:nth-child(n+2) {
    display: unset;
  }
</style>
<div style="padding: 20px 0 0 0;" class="col-xs-12 col-sm-10 col-md-12 links footer_linklist alignment bigalign">
  <div class="row alignment ">
    <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['linkBlocks']->value, 'linkBlock', false, 'key');
$_smarty_tpl->tpl_vars['linkBlock']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['linkBlock']->value) {
$_smarty_tpl->tpl_vars['linkBlock']->do_else = false;
?>
      <?php if ($_smarty_tpl->tpl_vars['key']->value == 0) {?>
        <div class="col-lg-3 col-md-6 col-sm-10 wrapper">
      <?php } elseif ($_smarty_tpl->tpl_vars['key']->value == 1) {?>
        <div class="col-lg-3 col-md-6 col-sm-10 wrapper">
      <?php } elseif ($_smarty_tpl->tpl_vars['key']->value == 2) {?>
        <div class="col-lg-3 col-md-6 col-sm-10 wrapper">
      <?php }?>

        <?php $_smarty_tpl->_assignInScope('_expand_id', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'mt_rand' ][ 0 ], array( 10,100000 )));?>
        <div class="title clearfix hidden-md-up" data-target="#footer_sub_menu_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['_expand_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
          data-toggle="collapse">
          <span class="text h3" onclick="$('#footer_sub_menu_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['_expand_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
').toggle('slow')"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['linkBlock']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
          <span class="pull-xs-right">
            
          </span>
        </div>
        <ul id="footer_sub_menu_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['_expand_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="collapse">
          <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['linkBlock']->value['links'], 'link');
$_smarty_tpl->tpl_vars['link']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->do_else = false;
?>
            
                        <li style="list-style-type: none !important;display:flex;align-items:center;gap: 0.25rem;">
              <?php if ($_smarty_tpl->tpl_vars['link']->value['title'] == "Facebook") {?>
                <img class="left_icon_footer" src="/img/asd/facebook.svg" width="24" height="24" alt="facebook">
              <?php } elseif ($_smarty_tpl->tpl_vars['link']->value['title'] == "Instagram") {?>
                <img class="left_icon_footer" src="/img/asd/instagram.svg" width="24" height="24" alt="instagram">
              <?php } else { ?>
                <img class="left_icon_footer" src="/img/asd/ASD_footer_ima.png" alt="Star" width="25" height="25">
              <?php }?>
              <a id="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['linkBlock']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                class="text <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['class'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                title="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['description'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

              </a>
            </li>
          <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
        </ul>

      </div>
    <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
    <div class="col-lg-3 col-md-6 col-sm-10 wrapper">
      <div class="title clearfix hidden-md-up" data-target="#footer_sub_menu_4"
        data-toggle="collapse">
        <span class="text h3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Contacts"),$_smarty_tpl ) );?>
</span>
      </div>
      <ul id="footer_sub_menu_4" class="collapse">
        <li>
                    <div>
            <img class="left_icon_footer" src="/img/asd/location.png" width="24" height="24" alt="location">
            Z.I Gandra, 4930-311 Valença</div>
        </li>
        <li>
          <div>
          <img class="left_icon_footer" src="/img/asd/globo.png" width="24" height="24" alt="phone">
          Portugal
          <img class="left_icon_footer" src="/img/asd/phone.png" width="24" height="24" alt="phone">
          <a href="tel:+351251096251">+351 251 096 251</a></div>
        </li>
        <li>
          <div>
          <img class="left_icon_footer" src="/img/asd/email.png" width="24" height="24" alt="email">
          <a href="mailto:sales@all-stars-distribution.com">sales@all-stars-distribution.com<a></div>
        </li>
      </ul>
    </div>
   
  </div>

  <div class="row mobile-footer">
  <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['linkBlocks']->value, 'linkBlock', false, 'key');
$_smarty_tpl->tpl_vars['linkBlock']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['key']->value => $_smarty_tpl->tpl_vars['linkBlock']->value) {
$_smarty_tpl->tpl_vars['linkBlock']->do_else = false;
?>
    <?php if ($_smarty_tpl->tpl_vars['key']->value == 0) {?>

    <?php } elseif ($_smarty_tpl->tpl_vars['key']->value == 1) {?>
        <div class="col-lg-2 col-md-6 col-sm-12 wrapper">

        

          <?php $_smarty_tpl->_assignInScope('_expand_id', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'mt_rand' ][ 0 ], array( 10,100000 )));?>
          <div class="title clearfix hidden-md-up" data-target="#footer_sub_menu_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['_expand_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
            data-toggle="collapse">
            <span class="text h3" onclick="$('#footer_sub_menu_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['_expand_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
').toggle('slow')"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['linkBlock']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
            <span class="pull-xs-right">
              
            </span>
          </div>
          <ul id="footer_sub_menu_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['_expand_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="collapse">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['linkBlock']->value['links'], 'link', false, 'item');
$_smarty_tpl->tpl_vars['link']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value => $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->do_else = false;
?>
                
              <?php if ($_smarty_tpl->tpl_vars['item']->value == 0) {?>
              <?php } else { ?>
                <li style="list-style-type: none !important;display:flex;align-items:center;gap: 0.25rem;">
                  <?php if ($_smarty_tpl->tpl_vars['link']->value['title'] == "Facebook") {?>
                                      <?php } elseif ($_smarty_tpl->tpl_vars['link']->value['title'] == "Instagram") {?>
                                      <?php } else { ?>
                    <img class="left_icon_footer" src="/img/asd/ASD_footer_ima.png" alt="Star" width="25" height="25">
                    <a id="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['linkBlock']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                      class="text <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['class'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                      title="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['description'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                      <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                    </a>
                  <?php }?>
                </li>
              <?php }?>

              
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              <li style="list-style-type: none !important;display:flex;align-items:center;gap: 0.25rem;">
                <img class="left_icon_footer" src="/img/asd/ASD_footer_ima.png" alt="Star" width="25" height="25">
                <a id="link-cms-page-7" class="text cms-page-link" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(7), ENT_QUOTES, 'UTF-8');?>
" title="">
                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Privacy Policy",'d'=>"Shop.Theme.Linklist"),$_smarty_tpl ) );?>

                </a>
              </li>
              <li style="list-style-type: none !important;display:flex;align-items:center;gap: 0.25rem;">
                <img class="left_icon_footer" src="/img/asd/ASD_footer_ima.png" alt="Star" width="25" height="25">
                <a id="link-cms-page-7" class="text cms-page-link" href="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['link']->value->getCMSLink(11), ENT_QUOTES, 'UTF-8');?>
" title="">
                  <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Payments",'d'=>"Shop.Theme.Linklist"),$_smarty_tpl ) );?>

                </a>
              </li>
          </ul>

        </div>
    <?php } else { ?>
      <div class="col-lg-2 col-md-6 col-sm-12 wrapper">

        

          <?php $_smarty_tpl->_assignInScope('_expand_id', call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'mt_rand' ][ 0 ], array( 10,100000 )));?>
          <div class="title clearfix hidden-md-up" data-target="#footer_sub_menu_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['_expand_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
            data-toggle="collapse">
            <span class="text h3" onclick="$('#footer_sub_menu_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['_expand_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
').toggle('slow')"><?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['linkBlock']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
</span>
            <span class="pull-xs-right">
              
            </span>
          </div>
          <ul id="footer_sub_menu_<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['_expand_id']->value,'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" class="collapse">
            <?php
$_from = $_smarty_tpl->smarty->ext->_foreach->init($_smarty_tpl, $_smarty_tpl->tpl_vars['linkBlock']->value['links'], 'link', false, 'item');
$_smarty_tpl->tpl_vars['link']->do_else = true;
if ($_from !== null) foreach ($_from as $_smarty_tpl->tpl_vars['item']->value => $_smarty_tpl->tpl_vars['link']->value) {
$_smarty_tpl->tpl_vars['link']->do_else = false;
?>
              <?php if ($_smarty_tpl->tpl_vars['item']->value == 1) {?>
              
              <?php } else { ?>
                <li style="list-style-type: none !important;display:flex;align-items:center;gap: 0.25rem;">
                  
                  <img class="left_icon_footer" src="/img/asd/ASD_footer_ima.png" alt="Star" width="25" height="25">
                  <a id="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
-<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['linkBlock']->value['id'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                    class="text <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['class'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
" href="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['url'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
"
                    title="<?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['description'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>
">
                    <?php echo htmlspecialchars((string) call_user_func_array($_smarty_tpl->registered_plugins[ 'modifier' ][ 'escape' ][ 0 ], array( $_smarty_tpl->tpl_vars['link']->value['title'],'html','UTF-8' )), ENT_QUOTES, 'UTF-8');?>

                  </a>
                </li>
              <?php }?>
              
            <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
              <li style="list-style-type: none !important;display:flex;align-items:center;gap: 0.25rem;">
              <img class="left_icon_footer" src="/img/asd/facebook.svg" width="24" height="24" alt="facebook"> 
                <a id="link-cms-page-7" class="text cms-page-link" href="https://www.facebook.com/allstarsdistribution" title="">
                  Facebook
                </a>
              </li>
              <li style="list-style-type: none !important;display:flex;align-items:center;gap: 0.25rem;">
                <img class="left_icon_footer" src="/img/asd/instagram.svg" width="24" height="24" alt="instagram"> 
                <a id="link-cms-page-7" class="text cms-page-link" href="https://instagram.com/allstarsdistribution" title="">
                  Instagram
                </a>
              </li>
          </ul>

        </div>
    <?php }?>
  <?php
}
$_smarty_tpl->smarty->ext->_foreach->restore($_smarty_tpl, 1);?>
  <div class="col-lg-4 col-md-6 col-sm-12 wrapper">
    <div class="title clearfix hidden-md-up" data-target="#footer_sub_menu_5" onclick="$('#footer_sub_menu_5').toggle('slow')"
      data-toggle="collapse">
      <span class="text h3"><?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>"Contacts",'d'=>"Shop.Theme.Linklist"),$_smarty_tpl ) );?>
</span>
    </div>
    <ul id="footer_sub_menu_5" class="collapse">
      <li>

        <div>
          <img class="left_icon_footer" src="/img/asd/location.png" width="24" height="24" alt="location">
          Z.I Gandra, 4930-311 Valença, Portugal
        </div>
      </li>
      <li>
        <div class="number-phone">
          <div>
            <img class="left_icon_footer" src="/img/asd/globo.png" width="24" height="24" alt="phone">
            Portugal
          </div>
          <div>
            <img class="left_icon_footer" src="/img/asd/phone.png" width="24" height="24" alt="phone">
            +351 251 096 251
          </div>
        </div>
      </li>
      <li>
        <div>
        <img class="left_icon_footer" src="/img/asd/email.png" width="24" height="24" alt="email">
          <a href="mailto:sales@all-stars-distribution.com">sales@all-stars-distribution.com</a>
        </div>
      </li>
    </ul>
  </div>
  </div>
</div>
<style>
  .alignment .alignment{
    display: flex;
    justify-content: space-between;
    /* flex-wrap: wrap; */
    width: 100%;
  }

  #footer_sub_menu_4{
    display: flex;
    align-items: start;
  }
  #footer_sub_menu_4 li{
    height: 27px;
  }
  #footer_sub_menu_4 li div{
    font-size: 16px;
    line-height: 18px;
    font-weight: 600;
    text-transform: uppercase;
    display: flex;
    gap: 0.25rem;
    align-items: center;
    text-wrap: nowrap;
  }

  #footer_sub_menu_4 img {
    padding: 1px;
  }

  @media screen and (max-width: 1057px){
    .alignment li a {
      font-size: 14px !important;
    }
    #footer_sub_menu_4 li div{
      font-size: 14px;
    }
  }

  @media screen and (min-width: 768px){
    .mobile-footer{
      display: none;
    }
  }

  @media screen and (max-width: 767px){
    .alignment .alignment{
      display: none !important;
    }

    #footer_sub_menu_4 li div{
      font-size: 16px;
    }

    .footer_linklist{
      padding: 1rem 0 !important;
    }

    .alignment .alignment{
      display: none !important;
    }

    .mobile-footer {
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    .mobile-footer .text{
      font-weight: 600 !important;
    }

    .mobile-footer li a {
      font-size: 16px !important;
      color: #fff !important;
    }

    .mobile-footer .title{
      text-align: center !important;
      text-transform: uppercase;
    }

    .mobile-footer ul {
      background: #666;
      border-top: 2px solid #0273eb;
      padding: 1rem;
    }

    .mobile-footer ul li{
      padding: .25rem 0;
    }

    .mobile-footer li a:hover{
      color: #222 !important;
      text-decoration: underline;
    }

    .mobile-footer img {
      background: #222;
      border-radius: 0.25rem;
    }

    #footer_sub_menu_5.collapse{
      display: none;
    }
    #footer_sub_menu_5.collapse.in{
      display: block;
    }
    #footer_sub_menu_5 li{
      padding: .25rem 0;
    }
    #footer_sub_menu_5 li div{
      font-size: 16px;
      text-wrap:wrap;
      color: #fff !important;
      font-weight: 600;
      text-transform: uppercase;
    }
  }

  @media screen and (max-width: 544px){
    .footer_linklist{
      padding: 1rem 0 !important;
    }

    .alignment .alignment{
      display: none !important;
    }

    .mobile-footer {
      display: flex;
      flex-direction: column;
      width: 100%;
    }

    .mobile-footer .text{
      font-weight: 600 !important;
    }

    .mobile-footer li a {
      font-size: 16px !important;
      color: #fff !important;
    }

    .mobile-footer .title{
      text-align: center !important;
      text-transform: uppercase;
    }

    .mobile-footer ul {
      background: #666;
      border-top: 2px solid #0273eb;
      padding: 1rem;
    }

    .mobile-footer ul li{
      padding: .25rem 0;
    }

    .mobile-footer li a:hover{
      color: #222 !important;
      text-decoration: underline;
    }

    .mobile-footer img {
      background: #222;
      border-radius: 0.25rem;
    }

    #footer_sub_menu_5.collapse{
      display: none;
    }
    #footer_sub_menu_5.collapse.in{
      display: block;
    }
    #footer_sub_menu_5 li{
      padding: .25rem 0;
    }
    #footer_sub_menu_5 li div{
      font-size: 16px;
      text-wrap:wrap;
      color: #fff !important;
      font-weight: 600;
      text-transform: uppercase;
    }
  }
</style><?php }
}
