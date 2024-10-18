<?php

namespace PrestaShop\AsGroup\Grid\Column\Type;

use PrestaShop\PrestaShop\Core\Grid\Column\Type\DataColumn;

class PaymentImageColumn extends DataColumn
{
    public function render($value, array $row)
    {
        // Assume payment ID is stored in the 'payment_id' column of the row
        $paymentId = $row['payment_id'];

        // Determine which image to show based on payment ID
        switch ($paymentId) {
            case 1:
                $image = 'path/to/image1.png'; // Path to the first image
                break;
            case 2:
                $image = 'path/to/image2.png'; // Path to the second image
                break;
            default:
                $image = 'path/to/default_image.png'; // Default image if no match
                break;
        }

        return '<img src="' . $image . '" alt="Payment Image" style="width: 50px; height: auto;" />';
    }
}
