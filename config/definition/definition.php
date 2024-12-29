<?php 

return static function($definition)
{
    $definition->rootNode()->children()

        ->arrayNode('provider')
            ->info('Specifies providers parameters.')
            ->addDefaultsIfNotSet()
            ->children()

            ->arrayNode('shopify')
                ->info('Specifies Shopify parameters.')
                ->addDefaultsIfNotSet()
                ->children()

                ->scalarNode('shop_name')
                    ->info('Specifies the Shopify shop name.')
                    ->defaultNull('%env(resolve:SHOPIFY_SHOP_NAME)%')
                ->end()

                ->scalarNode('api_key')
                    ->info('Specifies the Shopify API Key.')
                    ->defaultNull('%env(resolve:SHOPIFY_API_KEY)%')
                ->end()

                ->scalarNode('api_secret')
                    ->info('Specifies the Shopify API secret.')
                    ->defaultNull('%env(resolve:SHOPIFY_API_SECRET)%')
                ->end()

                ->scalarNode('access_token')
                    ->info('Specifies the Shopify Access Token.')
                    ->defaultNull('%env(resolve:SHOPIFY_ACCESS_TOKEN)%')
                ->end()

                ->arrayNode('scopes')
                    ->info('Specifies the Shopify API scope.')
                    ->prototype('scalar')->end()
                    ->defaultValue([])
                ->end()

                ->arrayNode('vendors')
                    ->info('Specifies the list of vendors.')
                    ->prototype('scalar')->end()
                    ->defaultValue([])
                ->end()
            
            ->end()->end()

        ->end()->end()

    ->end();
};