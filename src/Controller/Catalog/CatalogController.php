<?php

namespace OSW3\Ecommerce\Controller\Catalog;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CatalogController extends AbstractController
{
    #[Route('/catalog', name: 'app_catalog')]
    public function index(): Response
    {
        return $this->render('catalog/catalog/index.html.twig', [
            'controller_name' => 'ProductController',
        ]);
    }
}
