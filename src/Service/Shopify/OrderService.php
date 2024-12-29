<?php 
namespace OSW3\Shop\Service\Shopify;

use OSW3\Shop\Provider\ShopifyProvider;

class OrderService extends ShopifyProvider
{
    protected function names(): array 
    {
        return ["orders", "order"];
    }
}