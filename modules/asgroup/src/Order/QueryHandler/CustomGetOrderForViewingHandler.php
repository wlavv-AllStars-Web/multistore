<?php

namespace PrestaShop\Module\AsGroup\Order\QueryHandler;

use PrestaShop\PrestaShop\Core\Domain\Order\Query\GetOrderForViewing;
use PrestaShop\PrestaShop\Core\Domain\Order\QueryResult\OrderForViewing;

class CustomGetOrderForViewingHandler
{
    private $originalHandler;

    public function __construct($originalHandler)
    {
        $this->originalHandler = $originalHandler;
    }

    public function handle(GetOrderForViewing $query): OrderForViewing
    {
        // Use the original handler to get the order for viewing
        $orderForViewing = $this->originalHandler->handle($query);

        // You can add your custom logic here if needed

        return $orderForViewing;
    }
}
