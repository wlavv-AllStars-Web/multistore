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
 {extends file='page.tpl'}


 {block name='page_title'}

 {/block}
 
 {block name='page_content_container'}
 <div style="display:flex;flex-direction:column;padding:2rem;justify-content:space-between;align-items:center;box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;border-radius: .25rem;gap:1rem;">
     <h1>{l s='Forgot your password?' d='Shop.Theme.CustomerAccount'}</h1>
     {if empty($errors)}
         <div class="alert alert-success" role="alert">
             {$successes[0]}
         </div>
     {else}
         <div class="alert alert-danger" role="alert">
           {$errors[0]}
         </div>
     {/if}
        <ul>
         <li><a class="btn btn-primary" href="{$urls.pages.authentication}">{l s='Back to Login' d='Shop.Theme.Actions'}</a></li>
       </ul>
  </div>
 {/block}
 
 {block name='page_footer'}
   
 {/block}
 
