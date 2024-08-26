{foreach $list as $product}
    <tr>
    	<td style="border:1px solid #D6D4D4;">
    		<font size="3" face="Open-sans, sans-serif" color="#555454"> {$product['reference']}  </font>
    	</td>
    	<td style="border:1px solid #D6D4D4;">
    		<font size="3" face="Open-sans, sans-serif" color="#555454">
    			<strong>{$product['name']}</strong>
    			{if count($product['customization']) == 1}
    				<br>
    				{foreach $product['customization'] as $customization}
    					{$customization['customization_text']}
    				{/foreach}
    			{/if}
    
    			{hook h='displayProductPriceBlock' product=$product type="unit_price"}
    		</font>
    	</td>
    	<td style="border:1px solid #D6D4D4; text-align: center;">
    		<font size="3" face="Open-sans, sans-serif" color="#555454"> {$product['unit_price']} </font>
    	</td>
    	<td style="border:1px solid #D6D4D4; text-align: center;">
    		<font size="3" face="Open-sans, sans-serif" color="#555454"> {$product['quantity']}   </font>
    	</td>
    	<td style="border:1px solid #D6D4D4; text-align: center;">
    	    <font size="3" face="Open-sans, sans-serif" color="#555454"> {$product['price']}      </font>
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
{/foreach}
