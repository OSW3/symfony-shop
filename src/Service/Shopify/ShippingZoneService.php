<?php 
namespace OSW3\Shop\Service\Shopify;

use OSW3\Shop\Provider\ShopifyProvider;

class ShippingZoneService extends ShopifyProvider
{
    protected function names(): array 
    {
        return ["shipping_zones", "shipping_zone"];
    }
}