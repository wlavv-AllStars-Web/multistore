 
    {foreach $list as $product}
            <tr>
              <td>{$product['reference']}</td>
              <td>{$product['quantity']}</td>
              <td>{$product['quantity_sent']}</td>
            </tr>
    {/foreach}


