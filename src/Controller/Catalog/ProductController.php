<?php

namespace OSW3\Ecommerce\Controller\Catalog;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OSW3\Ecommerce\Provider\ControllerProvider;

class ProductController extends ControllerProvider
{
    #[Route('/catalog/product', name: 'app_catalog_product')]
    public function index(): Response
    {
        return $this->render('catalog/product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}
