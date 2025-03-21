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
{extends file='catalog/listing/product-list.tpl'}

{block name='product_list_header'}
  {* <pre>{print_r($manufacturer,1)}</pre> *}
  {* <h1>{l s='List of products by brand %s' sprintf=[$manufacturer.name] d='Shop.Theme.Catalog'}</h1> *}

  {* {if !empty($manufacturer.description) || !empty($manufacturer.short_description)}
    <div class="description_box" style="padding: 0 4rem; display:flex;align-items:center;">
        <div class="webmaster-logomanufacturer" style="width:300px;">
            <img src="{$img_manu_dir}{$manufacturer->id}-medium_default.jpg" style="width:100%;height: auto;"/>
        </div>
        {if !empty($manufacturer->short_description)}
            <div class="short_desc" style="font-size:15px;line-height:22px;text-transform:uppercase;font-weight:500;padding:0 3rem;margin:0 !important;text-align:center;">
                {$manufacturer->short_description}
            </div>
        {else}
            <div> {$manufacturer->description} </div>
        {/if}
    </div>
{/if} *}

<div class="description_box" style="display:flex;align-items:center;">
  <div class="webmaster-logomanufacturer" style="width:10%;padding: 0 1rem;">
    <img src="/img/m/{$manufacturer.id}-medium_default.jpg" style="width:100%;height: auto;"/>
  </div>
  {if !empty($manufacturer.short_description)}
    <div class="description_short" style="display: flex;flex-direction:column;width:80%;">
      <div id="manufacturer-short_description" class="text_description hiddenTextDescription" style="font-size:15px;line-height:22px;text-transform:uppercase;font-weight:500;padding:0 3rem;margin:0 !important;text-align:center;">
        {$manufacturer.short_description nofilter}
      </div>
      <p class="show-more" onclick="toggleDescription(this)">{l s='Show More' d='Shop.Theme.Actions'}</p>
    </div>
  {else}
    <div class="description" style="display: flex;flex-direction:column">
      <div id="manufacturer-description">{$manufacturer.description nofilter}</div>
      <p class="show-more" onclick="toggleDescription(this)">{l s='Show More' d='Shop.Theme.Actions'}</p>
    </div>
  {/if}
  
</div>
<style>
  .description_short {
    font-size: 15px;
    color: var(--color-text);
  }
  .hiddenTextDescription {
      overflow: hidden;
      /* height:54px; */
      transition:height ease-in 1s;
  }
  .visibleTextDescription {
      overflow: visible;
      /* height:fit-content; */
      transition:height ease-in 1s;
  }

  .show-more {
    border:0;
    padding: .5rem 1rem;
    font-size:1rem;
    max-width: 200px;
    margin: 1rem auto;
    border-radius: .25rem;
    text-transform: capitalize;
  }

  .show-more:focus{
    outline: none;
  }
</style>

<script>
document.addEventListener("DOMContentLoaded", function () {
  var descriptionElement = document.getElementById("manufacturer-short_description");
  var fullText = descriptionElement.textContent;
  descriptionElement.textContent = descriptionElement.textContent.slice(0, 400) + '...';
  descriptionElement.setAttribute("data-fulltext", fullText);
});

function toggleDescription() {
    var textLimit = 400;
    var descriptionElement = document.getElementById("manufacturer-short_description");
    var textLength = descriptionElement.innerText.length;
  
    if (descriptionElement.classList.contains("hiddenTextDescription")) {
        descriptionElement.textContent = descriptionElement.getAttribute("data-fulltext");  
        descriptionElement.classList.remove("hiddenTextDescription");
        descriptionElement.classList.add("visibleTextDescription");
        document.querySelector(".show-more").innerText = "Show Less";
    } else {
        if (textLength > textLimit) {
            descriptionElement.textContent = descriptionElement.textContent.slice(0, textLimit) + '...';
        }
        // descriptionElement.textContent = descriptionElement.textContent.slice(0, textLimit);
        descriptionElement.classList.remove("visibleTextDescription");
        descriptionElement.classList.add("hiddenTextDescription");
        document.querySelector(".show-more").innerText = "Show More";
    }
}

</script>
{/block}
