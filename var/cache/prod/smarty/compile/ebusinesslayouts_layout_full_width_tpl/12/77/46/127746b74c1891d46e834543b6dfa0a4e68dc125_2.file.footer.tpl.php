<?php
/* Smarty version 4.3.4, created on 2024-08-26 03:03:48
  from '/home/asw200923/beta/themes/ebusiness/templates/_partials/footer.tpl' */

/* @var Smarty_Internal_Template $_smarty_tpl */
if ($_smarty_tpl->_decodeProperties($_smarty_tpl, array (
  'version' => '4.3.4',
  'unifunc' => 'content_66cbe2844b66a4_99453855',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '127746b74c1891d46e834543b6dfa0a4e68dc125' => 
    array (
      0 => '/home/asw200923/beta/themes/ebusiness/templates/_partials/footer.tpl',
      1 => 1719912747,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
),false)) {
function content_66cbe2844b66a4_99453855 (Smarty_Internal_Template $_smarty_tpl) {
?><div class="footer-container">
<div id="scrollToTopBtn" onclick="scrollToTop()" >
            <i class="fa-solid fa-arrow-up"></i>
    </div>
    <div class="container-fluid onlyIndex">
            <div class="footer_top">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooter'),$_smarty_tpl ) );?>

            </div> 
    </div>
    <div class="footer_after">
            <div class="rights_footer" style="display: flex;justify-content:center;align-items:center;color:#f3f3f3;gap: 0.25rem;padding-top: 0.5rem;">
                <span>@ 2013 All Stars Motorsport.</span>
                <p>All Rights Reserved.</p>
            </div>
            <div class="container">
                <?php if ((isset($_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_PAYMENT_LOGO'])) && $_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_PAYMENT_LOGO']) {?>
                    <div class="payment_footer">                                       
                        <ul class="payment_footer_img">
                            <li>
                                <img src="<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['tc_module_path']->value, ENT_QUOTES, 'UTF-8');?>
images/config/<?php echo htmlspecialchars((string) $_smarty_tpl->tpl_vars['tc_config']->value['YBC_TC_PAYMENT_LOGO'], ENT_QUOTES, 'UTF-8');?>
" alt="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment methods'),$_smarty_tpl ) );?>
" title="<?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['l'][0], array( array('s'=>'Payment methods'),$_smarty_tpl ) );?>
" />
                            </li>
                        </ul>
                    </div>
                <?php }?>
                <?php if ((isset($_smarty_tpl->tpl_vars['tc_config']->value['YBC_FOOTER_LINK_CUSTOM'])) && $_smarty_tpl->tpl_vars['tc_config']->value['YBC_FOOTER_LINK_CUSTOM']) {?>
                    <div class="footer_link_bottom">
                        <?php echo $_smarty_tpl->tpl_vars['tc_config']->value['YBC_FOOTER_LINK_CUSTOM'];?>

                    </div>
                    <?php }?>
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterAfter'),$_smarty_tpl ) );?>

            </div>
    </div>
    <div class="footer_before">
        
        <div class="container">
            <div class="row">
                <?php echo call_user_func_array( $_smarty_tpl->smarty->registered_plugins[Smarty::PLUGIN_FUNCTION]['hook'][0], array( array('h'=>'displayFooterBefore'),$_smarty_tpl ) );?>

            </div>
        </div>
    </div>
</div>

  <style>
  @media screen and (max-width:991px){
    #footer .footer_before {
        display: none;
    }
    #footer .footer_after {
        /* display: none; */
        flex-direction:column;
    }

    #scrollToTopBtn {
    display: none;
    justify-content: center;
    align-items: center;
    position: fixed;
    bottom:2rem;
    right:2rem;
    font-size: 1.5rem;
    background: var(--asm-color);
    color: #fff;
    border: none;
    border-radius: 10px;
    padding: 10px;
    cursor: pointer;
    width: 60px;
    height: 60px;
}

  }

  @media screen and (min-width:991px){
    #scrollToTopBtn{
        display: none;
    }
    .footer-container .footer_before{
        display: none !important;
    }
    
    #footer .footer_before {
        display: none;
    }

    #footer .footer_after .rights_footer{
        /* font-weight: 700; */
        margin-bottom: 2rem;
    }

    #footer .footer_after .rights_footer p{
        /* display: none; */
        margin: 0;
    }
  } 
  </style>


<?php echo '<script'; ?>
>

if (screen.width < 991){
    window.onscroll = function () {
    scrollFunction();
};

function scrollFunction() {
    var scrollToTopBtn = document.getElementById("scrollToTopBtn");

    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        scrollToTopBtn.style.display = "flex";
    } else {
        scrollToTopBtn.style.display = "none";
    }
}


function scrollToTop() {
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}
}


<?php echo '</script'; ?>
>
<?php }
}
