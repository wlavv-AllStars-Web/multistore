<?php

namespace PrestaShop\Module\AsGroup\Order\QueryResult;

use PrestaShop\PrestaShop\Core\Domain\Order\QueryResult\OrderProductCustomizationsForViewing;
use PrestaShop\PrestaShop\Core\Domain\Order\QueryResult\OrderProductForViewing;

class OrderProductForViewingExtended extends OrderProductForViewing
{
    /**
     * @var int
     */
    private $product_quantity_sent;

    /**
     * @param int $orderDetailId
     * @param int $id
     * @param int $combinationId
     * @param string $name
     * @param string $reference
     * @param string $supplierReference
     * @param int $quantity
     * @param string $unitPrice
     * @param string $totalPrice
     * @param int $availableQuantity
     * @param string|null $imagePath
     * @param string $unitPriceTaxExclRaw
     * @param string $unitPriceTaxInclRaw
     * @param string $taxRate
     * @param string $amountRefunded
     * @param int $quantityRefunded
     * @param string $amountRefundable
     * @param string $amountRefundableRaw
     * @param string $location
     * @param int|null $orderInvoiceId
     * @param string $orderInvoiceNumber
     * @param string $type
     * @param bool $availableOutOfStock
     * @param array $packItems
     * @param OrderProductCustomizationsForViewing|null $customizations
     * @param int $qty_sent
     */
    public function __construct(
        ?int $orderDetailId,
        int $id,
        int $combinationId,
        string $name,
        string $reference,
        string $supplierReference,
        int $quantity,
        string $unitPrice,
        string $totalPrice,
        int $availableQuantity,
        ?string $imagePath,
        string $unitPriceTaxExclRaw,
        string $unitPriceTaxInclRaw,
        string $taxRate,
        string $amountRefunded,
        int $quantityRefunded,
        string $amountRefundable,
        string $amountRefundableRaw,
        string $location,
        ?int $orderInvoiceId,
        string $orderInvoiceNumber,
        string $type,
        bool $availableOutOfStock,
        array $packItems = [],
        ?OrderProductCustomizationsForViewing $customizations = null,
        int $product_quantity_sent = 0 // Add qty_sent parameter
    ) {
        parent::__construct(
            $orderDetailId,
            $id,
            $combinationId,
            $name,
            $reference,
            $supplierReference,
            $quantity,
            $unitPrice,
            $totalPrice,
            $availableQuantity,
            $imagePath,
            $unitPriceTaxExclRaw,
            $unitPriceTaxInclRaw,
            $taxRate,
            $amountRefunded,
            $quantityRefunded,
            $amountRefundable,
            $amountRefundableRaw,
            $location,
            $orderInvoiceId,
            $orderInvoiceNumber,
            $type,
            $availableOutOfStock,
            $packItems,
            $customizations
        );
        $this->product_quantity_sent = $product_quantity_sent; // Initialize the new property
    }

    /**
     * Get the quantity sent for this product
     *
     * @return int
     */
    public function getQtySent(): int
    {
        return $this->product_quantity_sent;
    }

    /**
     * Set the quantity sent for this product
     *
     * @param int $qty_sent
     */
    public function setQtySent(int $product_quantity_sent): void
    {
        $this->product_quantity_sent = $product_quantity_sent;
    }

    /**
     * @return array
     */
    public function jsonSerialize(): array
    {
        return array_merge(parent::jsonSerialize(), [
            'product_quantity_sent' => $this->getQtySent(), // Add qty_sent to the JSON output
        ]);
    }
}