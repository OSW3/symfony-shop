<?php

namespace OSW3\Ecommerce\Controller\Catalog;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OSW3\Ecommerce\Provider\ControllerProvider;

class CatalogController extends ControllerProvider
{
    #[Route('/catalog', name: 'catalog', methods: ['HEAD', 'GET'])]
    public function index(): Response
    {
        $products = range(0, rand(10,15));

        return $this->render('@Ecommerce/pages/catalog/catalog/index.html.twig', [
            'products' => $products
        ]);
    }
}
