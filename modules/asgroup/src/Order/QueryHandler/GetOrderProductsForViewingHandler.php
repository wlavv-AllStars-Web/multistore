<?php
namespace PrestaShop\Module\AsGroup\Order\QueryHandler;

use PrestaShop\PrestaShop\Adapter\Product\Repository\ProductRepository;
use PrestaShop\Module\AsGroup\Order\QueryResult\OrderProductForViewingExtended;
use PrestaShop\PrestaShop\Core\Domain\Order\Query\GetOrderProductsForViewing;


class GetOrderProductsForViewingHandler
{
    private $orderProductRepository; // Declare the repository property

    // Update the constructor to accept the repository as a dependency
    public function __construct($orderProductRepository) // Type-hint if you have a specific interface or class
    {
        $this->orderProductRepository = $orderProductRepository; // Assign the repository to the class property
    }

    public function handle(GetOrderProductsForViewing $query): array
    {
        // Fetch order products using the injected repository
        $orderProducts = $this->orderProductRepository->getProductsByOrderId($query->getOrderId());

        $orderProductsForViewing = []; // Initialize an array to hold the products

        foreach ($orderProducts as $orderProduct) {
            // Fetch qty_sent for each product
            $qtySent = $this->getQtySentForProduct($orderProduct->getId());

            // Create an instance of your extended class
            $orderProductForViewing = new OrderProductForViewingExtended(
                $orderProduct->getOrderDetailId(),
                $orderProduct->getId(),
                $orderProduct->getCombinationId(),
                $orderProduct->getName(),
                $orderProduct->getReference(),
                $orderProduct->getSupplierReference(),
                $orderProduct->getQuantity(),
                $orderProduct->getUnitPrice(),
                $orderProduct->getTotalPrice(),
                $orderProduct->getAvailableQuantity(),
                $orderProduct->getImagePath(),
                $orderProduct->getUnitPriceTaxExclRaw(),
                $orderProduct->getUnitPriceTaxInclRaw(),
                $orderProduct->getTaxRate(),
                $orderProduct->getAmountRefunded(),
                $orderProduct->getQuantityRefunded(),
                $orderProduct->getAmountRefundable(),
                $orderProduct->getAmountRefundableRaw(),
                $orderProduct->getLocation(),
                $orderProduct->getOrderInvoiceId(),
                $orderProduct->getOrderInvoiceNumber(),
                $orderProduct->getType(),
                $orderProduct->isAvailableOutOfStock(),
                $orderProduct->getPackItems(),
                $orderProduct->getCustomizations(),
                $qtySent // Pass qty_sent to the extended class
            );

            $orderProductsForViewing[] = $orderProductForViewing;
        }

        return $orderProductsForViewing;
    }

    /**
     * Method to get qty_sent for a product by its ID
     * Implement your logic here to retrieve the qty_sent value
     */
    private function getQtySentForProduct(int $productId): int
    {
        // TODO: Implement the logic to retrieve the qty_sent for the product
        return 0; // Replace with actual logic
    }
}
