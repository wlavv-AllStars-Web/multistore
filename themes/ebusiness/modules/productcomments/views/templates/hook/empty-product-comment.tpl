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
{* {$categories[0]['id_shop']} *}
{assign var="current_shop" value=Context::getContext()->shop->id}

{* <pre>{$current_shop|print_r}</pre> *}

<div id="empty-product-comment" class="product-comment-list-item">
  {if $post_allowed}
    {if $current_shop === 2}
      <div>
        <p>{l s="No reviews yet" d="Shop.Theme.Reviews"}</p>
        <span>*</span>
        <p>{l s="Write your comment here" d="Shop.Theme.Reviews"}</p>
      </div>
      <div>
        <a id="new_comment_tab_btn_" class="btn-comment-big post-product-comment" style="width:fit-content !important;" onmouseover="changeImgComments()" onmouseout="changeImgComments()">
            <img id="clickReviewDesktop" src="/img/asm/click.png" alt="Click to review" style="width: 150px; transform: scale(1);">  
        </a>
      </div>
    {else}
      <button class="btn btn-comment btn-comment-big post-product-comment">
        <i class="material-icons edit" data-icon="edit"></i>
        {l s="Be the first to write your review" d="Shop.Theme.Reviews"}
      </button>
    {/if}
  {else}
    {l s="No customer reviews for the moment." d="Shop.Theme.Reviews"}
  {/if}
</div>

