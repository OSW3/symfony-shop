<?php
namespace OSW3\Shop\Controller;

use Symfony\Component\Filesystem\Path;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OSW3\Shop\Provider\ControllerProvider;
use OSW3\Shop\Entity\Product\Product\Product;
use OSW3\Shop\Repository\Product\Product\ProductRepository;

#[Route('/', name: 'product:')]
class ProductController extends ControllerProvider
{
    private const VIEWS = '@Shop/pages/product';

    private const LANGUAGE = 'fr';

    #[Route('products', name: 'index')]
    public function index(ProductRepository $productRepository): Response
    {
        $products = $productRepository->findAll();

        return $this->render(Path::join(static::VIEWS, 'index.html.twig'), [
            'products' => $products,
            'language' => static::LANGUAGE,
        ]);
    }

    #[Route('/product/{id}', name: 'read', methods: ['HEAD', 'GET'])]
    public function read(Product $product): Response
    {
        return $this->render(Path::join(static::VIEWS, 'read.html.twig'), [
            'product' => $product,
            'language' => static::LANGUAGE,
        ]);
    }
}
