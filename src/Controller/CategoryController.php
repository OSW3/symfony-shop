<?php
namespace OSW3\Ecommerce\Controller;

use Symfony\Component\Filesystem\Path;
use OSW3\Ecommerce\Entity\Category\Category;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OSW3\Ecommerce\Provider\ControllerProvider;
use OSW3\Ecommerce\Repository\Category\CategoryRepository;

#[Route('/', name: 'category:')]
class CategoryController extends ControllerProvider
{
    private const VIEWS = '@Ecommerce/pages/category';

    #[Route('/categories', name: 'index', methods: ['HEAD', 'GET'])]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();

        return $this->render(Path::join(static::VIEWS, 'index.html.twig'), [
            'categories' => $categories
        ]);
    }

    #[Route('/category/{id}', name: 'read', methods: ['HEAD', 'GET'])]
    public function read(Category $category): Response
    {
        return $this->render(Path::join(static::VIEWS, 'read.html.twig'), [
            'category' => $category,
        ]);
    }
}
