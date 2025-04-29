		<!-- pack product list-->

		<div id="ap5-product-list"
			class="card ap5-product-list {if empty($from_quickview)}col-xs-12 col-12 col-sm-12 col-md-12{else}col-xs-12 col-12{/if}{if $packAvailableQuantity <= 0} ap5-pack-oos{/if}{if $packDeviceIsTablet || $packDeviceIsMobile} ap5-is-mobile{/if}">
			{* <div class="col-lg-12 px-0" style="background: #444;padding-block: .25rem;">
				<div class="col-lg-2 title-product-list-ap5"></div>
				<div class="col-lg-5 title-product-list-ap5 px-0">Product</div>
				<div class="col-lg-3 title-product-list-ap5">Attributes</div>
				<div class="col-lg-2 title-product-list-ap5">Price</div>
			</div> *}
			{assign var=nbPackProducts value=count($productsPack)}
			{foreach from=$productsPack item=productPack}
				{if !empty($productPack.image.id_image)}
					{assign var=imageIds value="`$productPack.id_product`-`$productPack.image.id_image`"}
				{else}
					{assign var=imageIds value="`$language.iso_code`-default"}
				{/if}
				{assign var=imageRewrite value=$productPack.presentation.link_rewrite}
				{if empty($imageRewrite)}
					{assign var=imageRewrite value=$productPack.id_product}
				{/if}
				{if !empty($productPack.image.legend)}
					{assign var=imageTitle value=$productPack.image.legend}
				{else}
					{assign var=imageTitle value=$productPack.presentation.name}
				{/if}

				<div id="ap5-pack-product-{$productPack.id_product_pack}"
					class="ap5-pack-product ap5-no-plus-icon col-xs-12 col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12{if $nbPackProducts != 2} col-md-6{/if}{if isset($productsPackErrors[$productPack.id_product_pack])} ap5-product-pack-row-has-errors{/if}{if isset($productsPackFatalErrors[$productPack.id_product_pack])} ap5-product-pack-row-has-fatal-errors{/if}{if empty($productPack.attributes.groups)} ap5-no-attributes{/if}{if in_array($productPack.id_product_pack, $packExcludeList)} ap5-is-excluded-product{/if}">

					<div class="ap5-pack-product-content">

						{block name='ap5_product_quantity_ribbon'}
							<!-- quantity -->
							{if $productPack.quantity > 1}
								<div class="ribbon-wrapper">
									<div class="ap5-pack-product-quantity ribbon">
										x {$productPack.quantity|intval}
									</div>
								</div>
							{/if}
						{/block}

						<div class="ap5-pack-product-image col-xs-3 col-sm-2 col-md-2 col-lg-2 col-xl-2">
							<a class="no-print" {if empty($from_quickview)}data-toggle="modal"
								data-target="#ap5-pack-product-{$productPack.id_product_pack}-modal #product-modal" {/if}
								title="{$productPack.presentation.name}"
								href="{$pmlink->getImageLink($imageRewrite, $imageIds, $imageFormatProductZoom)}">
								<img class="img-fluid d-block mx-auto"
									id="thumb_{$productPack.image.id_image|default:0|intval}"
									src="{$pmlink->getImageLink($imageRewrite, $imageIds, $imageFormatProductCover)}"
									alt="{$imageTitle}" title="{$imageTitle}" height="{$imageFormatProductCoverHeight}"
									width="{$imageFormatProductCoverWidth}" itemprop="image" />
							</a>
						</div>

						{block name='ap5_product_name'}
							<h2 class="ap5-pack-product-name {if !empty($productPack.attributes.groups)}col-xs-9 col-sm-10 col-md-10{else}col-xs-7 col-sm-8 col-md-8{/if} col-lg-10 col-xl-5 {if $productPack.quantity > 1}title-left{else}title-center{/if}">
								<a target="_blank" href="{$productPack.presentation.url}" title="{$productPack.presentation.name}"
									itemprop="url">
									{$productPack.presentation.name}
								</a>
								<span class="reference-value-pack-product"><span class="reference-title-pack">{l s="SKU:" d="Shop.Theme.PackProduct"}</span>{$productPack.presentation.reference_to_display}</span>
								
								<div class="info_pack">
								<span class="info_pack_btn" onclick="toggleFeatures(this)">+ Info</span>
								<div class="info_pack_content" style="display: none;">
									<div class="product_features" >
										{* <pre>{print_r($product.features,1)}</pre> *}
										<div style="padding: 0.2rem 2rem;"><b>{l s="EC Approval" d="Shop.Theme.Pageproduct"}:</b> <span>{if $product.ec_approved == 0}{l s="No" d="Shop.Theme.Pageproduct"}{else}{l s="Yes" d="Shop.Theme.Pageproduct"}{/if}</span></div>
										{if !empty($productPack.origin_product)}
										<div style="padding: 0.2rem 2rem;"><b>{l s="Origin" d="Shop.Theme.Pageproduct"}:</b> <span>{$productPack.origin_product}</span></div>
										{/if}
				
										{foreach from=$productPack.features item=feature}
										<div style="padding: 0.2rem 2rem;"><b>{$feature.name}:</b> <span>{$feature.value}</span></div>
										{/foreach}
									</div>
								</div>
							</div>
							<script defer="defer">
								function toggleFeatures(element) {
									const container = element.closest(".info_pack");
									const content = container.querySelector(".info_pack_content");

									if (content) {
									content.style.display = (content.style.display === "none" || content.style.display === "")
										? "block"
										: "none";
									}
								}
							</script>
							
							</h2>



							{* if image *}

							{* <div class="ap5-pack-product-image" style="max-width: 150px;margin:auto;">
								<a class="no-print" {if empty($from_quickview)}data-toggle="modal"
									data-target="#ap5-pack-product-{$productPack.id_product_pack}-modal #product-modal" {/if}
									title="{$productPack.presentation.name}"
									href="{$pmlink->getImageLink($imageRewrite, $imageIds, $imageFormatProductZoom)}">
									<img class="img-fluid d-block mx-auto"
										id="thumb_{$productPack.image.id_image|default:0|intval}"
										src="{$pmlink->getImageLink($imageRewrite, $imageIds, $imageFormatProductCover)}"
										alt="{$imageTitle}" title="{$imageTitle}" height="{$imageFormatProductCoverHeight}"
										width="{$imageFormatProductCoverWidth}" itemprop="image" />
								</a>
							</div> *}

							{*  *}

							{* <div class="{if !empty($productPack.attributes.groups)}col-lg-2{else}col-lg-5{/if} py-3 px-1" style="display: flex;flex-direction:column;justify-content:center;">
								<span class="reference-value-pack-product">{$productPack.presentation.reference_to_display}</span>
							</div> *}
						{/block}

						
						{* <div class="ap5-pack-images-container">
							{block name='ap5_product_images'}
								{if !$mobile_device}
									<div class="ap5-pack-product-image">
										<a class="no-print" {if empty($from_quickview)}data-toggle="modal"
											data-target="#ap5-pack-product-{$productPack.id_product_pack}-modal #product-modal" {/if}
											title="{$imageTitle}"
											href="{$pmlink->getImageLink($imageRewrite, $imageIds, $imageFormatProductZoom)}">
											<img class="img-fluid d-block mx-auto"
												id="thumb_{$productPack.image.id_image|default:0|intval}"
												src="{$pmlink->getImageLink($imageRewrite, $imageIds, $imageFormatProductCover)}"
												alt="{$imageTitle}" title="{$imageTitle}" height="{$imageFormatProductCoverHeight}"
												width="{$imageFormatProductCoverWidth}" itemprop="image" />
										</a>
									</div>
									
									{if empty($from_quickview)}
										<div id="ap5-pack-product-{$productPack.id_product_pack}-modal">
											{include file='catalog/_partials/product-images-modal.tpl' product=$productPack.presentation}
										</div>
									{/if}
									<hr class="ap5-pack-product-icon-plus" />
									{if $packShowProductsThumbnails && (count($productPack.images) > 1 || $packMaxImagesPerProduct > 1)}
										<div class="ap5-pack-product-slideshow pm-ap-owl-carousel clearfix">
											{foreach from=$productPack.images item=productPackImage}
												{assign var=productPackImageTitle value=$productPack.presentation.name}
												{assign var=productPackImageIds value="`$productPack.id_product`-`$productPackImage.id_image`"}

												<div id="ap5-pack-product-thumbnail-{$productPackImage.id_image|intval}"
													class="ap5-pack-product-thumbnail">
													<a title="{$productPackImageTitle}"
														href="{$pmlink->getImageLink($imageRewrite, $productPackImageIds, $imageFormatProductZoom)}"
														{if empty($from_quickview)} data-toggle="modal"
														data-target="#ap5-pack-product-{$productPack.id_product_pack}-modal #product-modal" {/if}>
														<img class="img-fluid d-block mx-auto" id="thumb_{$productPackImage.id_image|intval}"
															src="{$pmlink->getImageLink($imageRewrite, $productPackImageIds, $imageFormatProductSlideshow)}"
															alt="{$productPackImageTitle}" title="{$productPackImageTitle}"
															height="{$imageFormatProductSlideshowHeight}"
															width="{$imageFormatProductSlideshowWidth}" itemprop="image" />
													</a>
												</div>
											{/foreach}
										</div>
									{/if}
								{else}
									<hr class="ap5-pack-product-icon-plus" />
									{if $packShowProductsThumbnails && count($productPack.images) > 1}
										<div class="ap5-pack-product-mobile-slideshow pm-ap-owl-carousel clearfix">
											{foreach from=$productPack.imagesMobile item=productPackImage}
												{assign var=productPackImageTitle value=$productPack.presentation.name}
												{assign var=productPackImageIds value="`$productPack.id_product`-`$productPackImage.id_image`"}

												<div id="ap5-pack-product-thumbnail-{$productPackImage.id_image|intval}"
													class="ap5-pack-product-thumbnail">
													<img class="img-fluid d-block mx-auto" id="thumb_{$productPackImage.id_image|intval}"
														src="{$pmlink->getImageLink($imageRewrite, $productPackImageIds, $imageFormatProductCoverMobile)}"
														alt="{$productPackImageTitle}" title="{$productPackImageTitle}"
														height="{$imageFormatProductCoverMobileHeight}"
														width="{$imageFormatProductCoverMobileWidth}" itemprop="image" />
												</div>
											{/foreach}
										</div>
									{elseif (!$packShowProductsThumbnails && count($productPack.images) > 0) || ($packShowProductsThumbnails && count($productPack.images) == 1)}
										<div class="ap5-pack-product-image">
											<a class="no-print" {if empty($from_quickview)}data-toggle="modal"
												data-target="#ap5-pack-product-{$productPack.id_product_pack}-modal #product-modal" {/if}
												title="{$imageTitle}"
												href="{$pmlink->getImageLink($imageRewrite, $imageIds, $imageFormatProductZoom)}">
												<img class="img-fluid d-block mx-auto"
													id="thumb_{$productPack.image.id_image|default:0|intval}"
													src="{$pmlink->getImageLink($imageRewrite, $imageIds, $imageFormatProductCover)}"
													alt="{$imageTitle}" title="{$imageTitle}" height="{$imageFormatProductCoverHeight}"
													width="{$imageFormatProductCoverWidth}" itemprop="image" />
											</a>
										</div>
									{/if}
								{/if}
							{/block}
						</div> *}

						{* {if !empty($productPack.attributes.groups)} *}
						<div class="product-actions {if !empty($productPack.attributes.groups)}col-xs-10 col-sm-10 col-md-10{else} d-xs-none d-sm-none d-md-none {/if} col-lg-9 col-xl-3">
							{if $packAllowRemoveProduct && $packShowProductsQuantityWanted}
								<!-- quantity wanted -->
								<fieldset id="ap5-quantity-wanted-{$productPack.id_product_pack|intval}"
									class="attribute_fieldset ap5-attribute-fieldset ap5-quantity-fieldset">
									<label class="attribute_label"
										for="quantity_wanted_{$productPack.id_product_pack|intval}">{l s='Quantity' d='Shop.Theme.Catalog'}</label>
									<div class="attribute_list ap5-attribute-list ap5-quantity-input-container">
										<input type="text" name="qty_{$productPack.id_product_pack|intval}"
											id="quantity_wanted_{$productPack.id_product_pack|intval}"
											value="{$productPack.quantity|intval}"
											class="ap5-quantity-wanted input-group form-control"
											data-id-product-pack="{$productPack.id_product_pack|intval}"
											data-available-quantity="{$packAvailableQuantityList[$productPack.id_product_pack][$productPack.id_product_attribute]|intval}"
											{if in_array($productPack.id_product_pack, $packExcludeList)} disabled="disabled" {/if} />
									</div>
								</fieldset>
							{/if}
							{if !empty($productPack.attributes.groups)}
								<!-- attributes -->
								<div class="product-variants ap5-attributes py-3 d-xs-flex d-sm-flex d-md-flex d-lg-flex d-xl-block"
									data-id-product-pack="{$productPack.id_product_pack|intval}">
									{foreach from=$productPack.attributes.groups key=id_attribute_group item=group}
										{if $group.attributes|@count}
											{foreach from=$group.attributes key=id_attribute item=group_attribute}
												{* Force the user-selected attribute to be the default one *}
												{if isset($packCompleteAttributesList[$productPack.id_product_pack]) && in_array($id_attribute, $packCompleteAttributesList[$productPack.id_product_pack])}
													{$group['default'] = $id_attribute}
												{/if}
											{/foreach}
											<div id="ap5-product-variants-item-{$id_attribute_group|intval}"
												class="clearfix product-variants-item ap5-attribute-fieldset my-0">
												<span class="control-label">{$group.name}</span>
												{assign var="groupName" value="group_`$productPack.id_product_pack`_$id_attribute_group"}
												<div class="attribute_list ap5-attribute-list">
													{if ($group.group_type == 'select')}
														<select name="{$groupName}" id="group_{$id_attribute_group|intval}"
															class="ap5-attribute-select no-print form-control form-control-select"
															{if in_array($productPack.id_product_pack, $packExcludeList)} disabled="disabled"
															{/if}>
															{foreach from=$group.attributes key=id_attribute item=group_attribute}
																{assign var=ap5_isCurrentSelectedIdAttribute value=((isset($productsPackErrors[$productPack.id_product_pack]) && isset($packCompleteAttributesList[$productPack.id_product_pack]) && in_array($id_attribute, $packCompleteAttributesList[$productPack.id_product_pack])) || $group.default == $id_attribute)}
																<option value="{$id_attribute|intval}" {if $ap5_isCurrentSelectedIdAttribute}
																	selected="selected" {/if} title="{$group_attribute.name}">{$group_attribute.name}
																</option>
															{/foreach}
														</select>
													{elseif ($group.group_type == 'color')}
														<ul
															class="ap5-color-to-pick-list ap5-color-to-pick-list-{$productPack.id_product_pack|intval}-{$id_attribute_group|intval}">
															{assign var="default_colorpicker" value=""}
															{foreach from=$group.attributes key=id_attribute item=group_attribute}
																{assign var=ap5_isCurrentSelectedIdAttribute value=((isset($productsPackErrors[$productPack.id_product_pack]) && isset($packCompleteAttributesList[$productPack.id_product_pack]) && in_array($id_attribute, $packCompleteAttributesList[$productPack.id_product_pack])) || $group.default == $id_attribute)}
																<li
																	class="float-left float-xs-left pull-xs-left input-container{if $ap5_isCurrentSelectedIdAttribute} selected{/if}">
																	<label aria-label="{$group_attribute.name|escape:'html':'UTF-8'}">
																		<a href="{$productPack.presentation.url}"
																			data-id-product-pack="{$productPack.id_product_pack|intval}"
																			data-id-attribute-group="{$id_attribute_group|intval}"
																			data-id-attribute="{$id_attribute|intval}"
																			id="color_{$id_attribute|intval}"
																			name="{$productPack.attributes.colors.$id_attribute.name}"
																			class="ap5-color color color_pick{if $ap5_isCurrentSelectedIdAttribute} selected{/if}{if in_array($productPack.id_product_pack, $packExcludeList)} disabled{/if}"
																			style="background: {$productPack.attributes.colors.$id_attribute.value};"
																			title="{$productPack.attributes.colors.$id_attribute.name}">
																			{if $productPack.attributes.colors.$id_attribute.image_exists}
																				<img src="{$urls.img_col_url}{$id_attribute|intval}.jpg"
																					alt="{$productPack.attributes.colors.$id_attribute.name}" />
																			{/if}
																		</a>
																	</label>
																</li>
																{if $ap5_isCurrentSelectedIdAttribute}
																	{$default_colorpicker = $id_attribute}
																{/if}
															{/foreach}
														</ul>
														<input type="hidden"
															class="color_pick_hidden_{$productPack.id_product_pack|intval}_{$id_attribute_group|intval}"
															name="{$groupName}" value="{$default_colorpicker|intval}" />
													{elseif ($group.group_type == 'radio')}
														<ul>
															{foreach from=$group.attributes key=id_attribute item=group_attribute}
																{assign var=ap5_isCurrentSelectedIdAttribute value=((isset($productsPackErrors[$productPack.id_product_pack]) && isset($packCompleteAttributesList[$productPack.id_product_pack]) && in_array($id_attribute, $packCompleteAttributesList[$productPack.id_product_pack])) || $group.default == $id_attribute)}
																<li class="input-container float-left float-xs-left pull-xs-left">
																	<input type="radio" class="input-radio ap5-attribute-radio" name="{$groupName}"
																		value="{$id_attribute}" {if $ap5_isCurrentSelectedIdAttribute}
																			checked="checked"
																			{/if}{if in_array($productPack.id_product_pack, $packExcludeList)}
																		disabled="disabled" {/if} />
																	<span class="radio-label">{$group_attribute.name}</span>
																</li>
															{/foreach}
														</ul>
													{/if}
												</div> <!-- end attribute_list -->
											</div>
										{/if}
									{/foreach}
								</div>
							{/if}
						</div>
						{* {/if} *}

						{if $productPack.presentation.show_price && $packShowProductsPrice && !$configuration.is_catalog}
							{* {if $packShowProductsThumbnails && $packMaxImagesPerProduct > 1}
							<hr class="line-separator-pack" />{/if} *}
							<div
								class="ap5-pack-product-price-table-container product-prices {if !empty($productPack.attributes.groups)}col-xs-2 col-sm-2 col-md-2{else}col-xs-2 col-sm-2 col-md-2 {/if}  col-lg-2 mt-0{if $productPack.reduction_amount <= 0} ap5-no-reduction{/if}">
								{if empty($productsPackForceHideInfoList[$productPack.id_product_pack])}
									<div
										class="ap5-pack-product-price-table-cell {if $productPack.reduction_amount > 0} has-discount{/if}">
										{block name='ap5_product_price'}
											<div class="current-price ap5-pack-product-price text-center">
												{if $productPack.reduction_amount > 0}
													<div class="product-discount ap5-pack-product-original-price text-center">
														<span class="regular-price ap5-pack-product-original-price-value">
															{if !$priceDisplay || $priceDisplay == 2}
																{$productPack.presentation.productClassicPriceTotal}
															{elseif $priceDisplay == 1}
																{$productPack.presentation.productClassicPriceTaxExclTotal}
															{/if}
														</span>
													</div>
												{/if}
												<div class="product-price h5 has-discount">
													{if $productPack.presentation.show_price}
														{if $productPack.productPackPrice == 0}
															{l s='Gift' d='Shop.Theme.Checkout'}
														{else}
															{if !$priceDisplay || $priceDisplay == 2}
																<span>{$productPack.presentation.productPackPriceTotal}</span>
															{elseif $priceDisplay == 1}
																<span>{$productPack.presentation.productPackPriceTaxExclTotal}</span>
															{/if}
														{/if}
													{/if}
													{if $productPack.reduction_amount > 0}
														{if $productPack.productPackPrice > 0}
															{if $productPack.reduction_type == 'amount'}
																<span class="discount discount-amount ap5-pack-product-reduction-value">
																	{l s='Save %amount%' d='Shop.Theme.Catalog' sprintf=['%amount%' => $productPack.presentation.productReductionAmountTotal]}
																</span>
															{else}
																<span
																	class="discount discount-percentage ap5-pack-product-reduction-value">{l s='Save %percentage%' d='Shop.Theme.Catalog' sprintf=['%percentage%' => $productPack.reduction_amount * 100|cat:'%']}</span>
															{/if}
														{/if}
													{/if}
												</div>
											</div>
										{/block}
										{block name='ap5_product_availability'}
											{if $packShowProductsAvailability}
												<!-- availability -->
												<pre>{$productPack.presentation.availability|print_r}</pre>
												<div class="ap5-availability-statut">
													<span id="product-availability">
														{if $productPack.presentation.availability == 'available'}
															<i class="material-icons product-available" translate="no">&#xE5CA;</i>
														{elseif $productPack.presentation.availability == 'last_remaining_items'}
															<i class="material-icons product-last-items" translate="no">&#xE002;</i>
														{else}
															<i class="material-icons product-unavailable" translate="no">&#xE14B;</i>
														{/if}
														{$productPack.presentation.availability_message}
													</span>
												</div>
												<div class="ap5-delivery-information">
													{if $productPack.presentation.additional_delivery_times == 1}
														{if $productPack.presentation.delivery_information}
															<span class="delivery-information">{$productPack.presentation.delivery_information}</span>
														{/if}
													{elseif $productPack.presentation.additional_delivery_times == 2}
														{if $productPack.presentation.quantity > 0}
															<span class="delivery-information">{$productPack.presentation.delivery_in_stock}</span>
															{* Out of stock message should not be displayed if customer can't order the product. *}
														{elseif $productPack.presentation.quantity <= 0 && $productPack.presentation.add_to_cart_url}
															<span class="delivery-information">{$productPack.presentation.delivery_out_stock}</span>
														{/if}
													{/if}
												</div>
											{/if}
										{/block}
									</div>
								{/if}
							</div>
						{/if}
						{* <hr class="line-separator-pack"  /> *}
						{* Let's display error list *}
						{if isset($productsPackErrors[$productPack.id_product_pack]) || isset($productsPackFatalErrors[$productPack.id_product_pack])}
							{if isset($productsPackFatalErrors[$productPack.id_product_pack])}<div class="ap5-overlay"></div>{/if}
							<div
								class="alert animated shake {if isset($productsPackFatalErrors[$productPack.id_product_pack])}alert-danger{else}alert-warning{/if}">
								<ol>
									{if isset($productsPackErrors[$productPack.id_product_pack])}
										{foreach from=$productsPackErrors[$productPack.id_product_pack] item=errorRow}
											<li>{$errorRow}</li>
										{/foreach}
									{/if}
									{if isset($productsPackFatalErrors[$productPack.id_product_pack])}
										{foreach from=$productsPackFatalErrors[$productPack.id_product_pack] item=errorRow}
											<li>{$errorRow}</li>
										{/foreach}
									{/if}
								</ol>
							</div>
						{/if}

					</div>
					{if $packAllowRemoveProduct}
						{if !in_array($productPack.id_product_pack, $packExcludeList)}
							<span class="ap5-pack-product-icon-remove"
								data-id-product-pack="{$productPack.id_product_pack|intval}"></span>
						{else}
							<span class="ap5-pack-product-icon-check" data-id-product-pack="{$productPack.id_product_pack|intval}"></span>
						{/if}
					{/if}
				</div>
			{/foreach}
		</div>
<!-- end pack product list -->