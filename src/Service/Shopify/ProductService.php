<?php 
namespace OSW3\Shop\Service\Shopify;

use OSW3\Shop\Provider\ShopifyProvider;

class ProductService extends ShopifyProvider
{
    protected function names(): array 
    {
        return ["products", "product"];
    }

    protected function filter($item): bool
    {
        return empty($this->vendors) || in_array($item['vendor'], $this->vendors);
    }
}