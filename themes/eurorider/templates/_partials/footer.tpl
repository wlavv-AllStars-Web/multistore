{**
 * 2007-2016 PrestaShop
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to http://www.prestashop.com for more information.
 *
 * @author    PrestaShop SA <contact@prestashop.com>
 * @copyright 2007-2016 PrestaShop SA
 * @license   http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 * International Registered Trademark & Property of PrestaShop SA
 *}
<div class="footer-container">
<div id="scrollToTopBtn" onclick="scrollToTop()" >
            <i class="fa-solid fa-arrow-up"></i>
    </div>
    <div class="container-fluid onlyIndex">
            <div class="footer_top">
                {hook h='displayFooter'}
            </div> 
    </div>
    <div class="footer_after">
            <div class="rights_footer" style="display: flex;justify-content:center;align-items:center;color:#f3f3f3;gap: 0.25rem;padding-top: 0.5rem;">
                <span>@ 2013 All Stars Motorsport.</span>
                <p>All Rights Reserved.</p>
            </div>
            <div class="container">
                {if isset($tc_config.YBC_TC_PAYMENT_LOGO) && $tc_config.YBC_TC_PAYMENT_LOGO}
                    <div class="payment_footer">                                       
                        <ul class="payment_footer_img">
                            <li>
                                <img src="{$tc_module_path}images/config/{$tc_config.YBC_TC_PAYMENT_LOGO}" alt="{l s='Payment methods'}" title="{l s='Payment methods'}" />
                            </li>
                        </ul>
                    </div>
                {/if}
                {if isset($tc_config.YBC_FOOTER_LINK_CUSTOM) && $tc_config.YBC_FOOTER_LINK_CUSTOM}
                    <div class="footer_link_bottom">
                        {$tc_config.YBC_FOOTER_LINK_CUSTOM nofilter}
                    </div>
                    {/if}
                {hook h='displayFooterAfter'}
            </div>
    </div>
    <div class="footer_before">
        
        <div class="container">
            <div class="row">
                {hook h='displayFooterBefore'}
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


<script>

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


</script>
