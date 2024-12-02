<?php

namespace OSW3\Ecommerce\Entity\Category;

use Doctrine\ORM\Mapping as ORM;
use OSW3\Ecommerce\Trait\Entity\Properties\Id\IdTrait;
use OSW3\Ecommerce\Trait\Entity\Properties\Name\NameTrait;
use OSW3\Ecommerce\Trait\Entity\Properties\Slug\SlugTrait;
use OSW3\Ecommerce\Repository\Category\TranslationRepository;
use OSW3\Ecommerce\Trait\Entity\Properties\Language\LanguageTrait;
use OSW3\Ecommerce\Trait\Entity\Properties\Description\Nullable\DescriptionTrait;

#[ORM\Entity(repositoryClass: TranslationRepository::class)]
#[ORM\Table(name: 'category_translation')]
class Translation
{
    const SLUG_FIELDS = ['name'];

    use IdTrait;
    use SlugTrait;
    use LanguageTrait;
    use NameTrait;
    use DescriptionTrait;


    // RELATIONSHIP
    // --

    #[ORM\ManyToOne(inversedBy: 'translations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }
}
