<?php 
namespace OSW3\Ecommerce;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use OSW3\Ecommerce\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class EcommerceBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        $projectDir = $container->getParameter('kernel.project_dir');


        // Generate the YAML bundle configuration file in the project
        // --
        
        (new Configuration)->generateProjectConfig($projectDir);
    }
}