
{foreach $list as $product}
	<tr class="product_{$product['reference']}" style="width: 100%;padding: 2rem 0;">
	    <td style="padding: 20px 0;">
    		<table class="table table-recap" style="width: 100%; border-collapse: collapse;outline: 2px solid #0273eb;background:#fff;">
    			<tr>
    				<td style="width:30%;text-align:center;border-right: 1px solid #888;background:#fff;"><img src="{$product['image_p']}" /></td>
    				<td style="width:70%">
    					<table style="width: 100%;text-align:center;">
    						<tr style="border: 1px solid #a7a7a7;">
    							
    							<td style="color: #0273eb; font-family: Open-sans, sans-serif; font-size: 16px;" face="Open-sans, sans-serif">{$product['reference']}</td>
    						</tr>
    						<tr style="border: 1px solid #a7a7a7;">
    							
    							<td style="color: #888; font-family: Open-sans, sans-serif; font-size: 16px;" face="Open-sans, sans-serif">{$product['name']}</td>
    						</tr>
    						<tr style="border: 1px solid #a7a7a7;">
    							
    							<td style="color: #888; font-family: Open-sans, sans-serif; font-size: 16px;" face="Open-sans, sans-serif">{$product['quantity']} </td>
    						</tr>
    						<tr style="border: 1px solid #a7a7a7;">
    							
    							<td style="color: #888; font-family: Open-sans, sans-serif; font-size: 16px;" face="Open-sans, sans-serif">{$product['price']} </td>
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
		</td>
	</tr>
{/foreach}

