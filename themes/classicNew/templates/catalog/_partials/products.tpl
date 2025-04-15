{**
 * Copyright since 2007 PrestaShop SA and Contributors
 * PrestaShop is an International Registered Trademark & Property of PrestaShop SA
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Academic Free License 3.0 (AFL-3.0)
 * that is bundled with this package in the file LICENSE.md.
 * It is also available through the world-wide-web at this URL:
 * https://opensource.org/licenses/AFL-3.0
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@prestashop.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade PrestaShop to newer
 * versions in the future. If you wish to customize PrestaShop for your
 * needs please refer to https://devdocs.prestashop.com/ for more information.
 *
 * @author    PrestaShop SA and Contributors <contact@prestashop.com>
 * @copyright Since 2007 PrestaShop SA and Contributors
 * @license   https://opensource.org/licenses/AFL-3.0 Academic Free License 3.0 (AFL-3.0)
 *}
<div id="js-product-list">
  {include file="catalog/_partials/productlist.tpl" products=$listing.products cssClass="row"}

  {block name='pagination'}
    {* <pre>{print_r($listing,1)}</pre> *}
      {include file='_partials/pagination.tpl' pagination=$listing.pagination}
  {/block}

  {* <div class="hidden-md-up text-xs-right up">
    <a href="#header" class="btn btn-secondary">
      {l s='Back to top' d='Shop.Theme.Actions'}
      <i class="material-icons">&#xE316;</i>
    </a>
  </div> *}
</div>

<script>

  function addToMyCars(id_compat){

        let complete = 0;
        let logged = {if $customer.is_logged}1{else}0{/if};
        let id_customer = {if $customer.id}{$customer.id}{else}0{/if};
        let email = '{$customer.email}';

            // Prevent multiple clicks
        let button = $('.addToMyCarsButton');
        if (button.data('loading')) {
            return; // Stop if a request is already in progress
        }
        button.data('loading', true); // Set loading state
        button.prop('disabled', true); // Disable button
        
        if(logged == 1){
            
          complete = 1;

        } else {
            email = prompt("{l s='Please enter your email.'}");

            if (email != null) {
                complete = 1;
                // Additional logic can be placed here if needed
            } else {
                alert("{l s='You did not enter an email. Please try again!'}");
                button.data('loading', false); // Reset loading state
                button.prop('disabled', false); // Re-enable button
                return; // Exit the function if no email is entered
            } 
        }
        
        if(complete){
          $.ajax({
              url: '{url entity="frontController"}',
              type: 'POST',
              data: {
                  'saveCarGarage': 1,
                  'id_compat': id_compat,
                  'email': email,
                  'id_customer': id_customer,
                  'iso_code': "{Context::getContext()->language->iso_code}"
              },
              dataType: 'json',
              success: function (data) {
                  if(data.success == false){
                    alert("error")
                  }else{
                    $('.addToMyCarsButton').html('');
                    openMenuCars();
                  }
              },
              complete: function () {
                button.data('loading', false); // Reset loading state
                // button.prop('disabled', false); // Re-enable button
                $('.addToMyCarsButton').html('');
            }
          });
        }
        
    }



</script>
