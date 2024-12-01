<?php

namespace OSW3\Ecommerce\Controller\Catalog;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    #[Route('/catalog/product', name: 'app_catalog_product')]
    public function index(): Response
    {
        return $this->render('catalog/product/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}
