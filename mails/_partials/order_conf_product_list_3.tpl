{foreach $list as $product}
	<table class="table" style="width: 100%; margin-bottom: 2rem; padding: 2rem 0;">
		<tr>
			<td colspan="3"><img src="{$product['image_p']}" /></td>
			<td colspan="3">
				<table>
					<tr>
						<td>{$product['reference']}</td>
					</tr>
					<tr>
						<td>{$product['name']}</td>
					</tr>
					<tr>
						<td>{$product['quantity']} </td>
					</tr>
					<tr>
						<td>{$product['price']} </td>
					</tr>
				</table>
			</td>
		</tr>
		{if count($product['customization']) > 1}
			{foreach $product['customization'] as $customization}
				<tr>
					<td colspan="3" style="border:1px solid #D6D4D4;text-align: center;">
						<font size="3" face="Open-sans, sans-serif" color="#555454"> {$customization['customization_text']} </font>
					</td>
					<td style="border:1px solid #D6D4D4; text-align: center;">
						<font size="3" face="Open-sans, sans-serif" color="#555454" style="text-align: center;">
						{if count($product['customization']) > 1} {$customization['customization_quantity']} {/if}
						</font>
					</td>
					<td style="border:1px solid #D6D4D4;"></td>
				</tr>
			{/foreach}
		{/if}
	</table>
{/foreach}
