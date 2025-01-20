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
{include file='_partials/form-errors.tpl' errors=$errors['']}

<form action="{$action}" id="customer-form" class="js-customer-form" method="post">
  <section>
    {* <pre>{print_r($formFields,1)}</pre> *}
    {block "form_fields"}
      {foreach from=$formFields item="field"}
        {block "form_field"}
          {form_field field=$field}
        {/block}
      {/foreach}
    {/block}
    
  
  
  
  </section>

  <footer class="form-footer clearfix">
    <input type="hidden" name="submitCreate" value="1">
    {block "form_buttons"}
      <button class="btn btn-outline-success form-control-submit pull-xs-right" data-link-action="save-customer" type="submit">
        {l s='Save' d='Shop.Theme.Actions'}
      </button>
    {/block}
  </footer>

  <script>
    // const company = document.querySelector("input[name='company']");
    // const siret = document.querySelector("input[name='siret']");

    // if(siret || company) {
    //   siret.setAttribute("readonly","readonly")
    //   company.setAttribute("readonly","readonly")

    //   const parentsiret = siret.parentElement.parentElement
    //   const parentcompany = company.parentElement.parentElement

    //   parentsiret.classList.add("parentDisabled")
    //   parentcompany.classList.add("parentDisabled")

    //   parentsiret.querySelector(".form-control-comment").style.display = "none"
    //   parentcompany.querySelector(".form-control-comment").style.display = "none"
    // }
  </script>

<style>
#registration #main{
  width: 100%;
}
#registration #content {
  border: none;
}
#identity #main{
  width: 100%;
}
#identity #content {
  border: none;
}
#identity .breadcrumb_wrapper {
  padding: 0;
  border-bottom: 0;
}
</style>



</form>
