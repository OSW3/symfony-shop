<?php

namespace OSW3\Ecommerce\Entity\Tag;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use OSW3\Ecommerce\Trait\Entity\Properties\Id\IdTrait;
use OSW3\Ecommerce\Repository\Tag\TranslationRepository;
use OSW3\Ecommerce\Trait\Entity\Properties\Name\NameTrait;
use OSW3\Ecommerce\Trait\Entity\Properties\Slug\SlugTrait;
use OSW3\Ecommerce\Trait\Entity\Properties\Language\LanguageTrait;
use OSW3\Ecommerce\Trait\Entity\Properties\Description\Nullable\DescriptionTrait;

#[ORM\Entity(repositoryClass: TranslationRepository::class)]
#[ORM\Table(name: 'tag_translation')]
class Translation
{
    const SLUG_FIELDS = ['name'];

    use IdTrait;
    use SlugTrait;
    use LanguageTrait;
    use NameTrait;
    Use DescriptionTrait;


    // RELATIONSHIP
    // --

    #[ORM\ManyToOne(inversedBy: 'translations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Tag $tag = null;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function getTag(): ?Tag
    {
        return $this->tag;
    }

    public function setTag(?Tag $tag): static
    {
        $this->tag = $tag;

        return $this;
    }
}
