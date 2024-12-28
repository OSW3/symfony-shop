<?php 
namespace OSW3\Shop\Service\Shopify;

use OSW3\Shop\Provider\ShopifyProvider;

class CollectionService extends ShopifyProvider
{
    protected function names(): array 
    {
        return ["custom_collections", "custom_collection"];
    }
}