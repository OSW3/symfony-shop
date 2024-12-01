<?php 
namespace OSW3\Ecommerce;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use OSW3\Ecommerce\DependencyInjection\Configuration;
use Symfony\Component\DependencyInjection\ContainerBuilder;

class EcommerceBundle extends Bundle
{
    public function build(ContainerBuilder $container): void
    {
        (new Configuration)->generateProjectConfig($container->getParameter('kernel.project_dir'));
    }
}