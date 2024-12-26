<?php
namespace OSW3\Ecommerce\Controller;

use Symfony\Component\Filesystem\Path;
use OSW3\Ecommerce\Entity\Tag\Tag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use OSW3\Ecommerce\Provider\ControllerProvider;
use OSW3\Ecommerce\Repository\Tag\TagRepository;

#[Route('/', name: 'tag:')]
class TagController extends ControllerProvider
{
    private const VIEWS = '@Ecommerce/pages/tag';

    #[Route('/tags', name: 'index', methods: ['HEAD', 'GET'])]
    public function index(TagRepository $tagRepository): Response
    {
        $tags = $tagRepository->findAll();

        return $this->render(Path::join(static::VIEWS, 'index.html.twig'), [
            'tags' => $tags
        ]);
    }

    #[Route('/tag/{id}', name: 'read', methods: ['HEAD', 'GET'])]
    public function read(Tag $tag): Response
    {
        return $this->render(Path::join(static::VIEWS, 'read.html.twig'), [
            'tag' => $tag,
        ]);
    }
}
