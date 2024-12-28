<?php 
namespace OSW3\Shop;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use OSW3\Shop\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class ShopBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $projectDir = $container->getParameter('kernel.project_dir');


        // Generate the YAML bundle configuration file in the project
        // --
        
        (new Configuration)->generateProjectConfig($projectDir);
    }
}