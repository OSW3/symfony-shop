<?php

namespace OSW3\Ecommerce\Entity\Product\Attribute;

use Doctrine\ORM\Mapping as ORM;
use OSW3\Ecommerce\Trait\Entity\Properties\Id\IdTrait;
use OSW3\Ecommerce\Trait\Entity\Properties\Name\NameTrait;
use OSW3\Ecommerce\Trait\Entity\Properties\Language\LanguageTrait;
use OSW3\Ecommerce\Repository\Product\Attribute\TranslationRepository;

#[ORM\Entity(repositoryClass: TranslationRepository::class)]
#[ORM\Table(name: 'attribute_translation')]
class Translation
{
    use IdTrait;
    use LanguageTrait;
    use NameTrait;


    // RELATIONSHIP
    // --

    #[ORM\ManyToOne(inversedBy: 'translations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Attribute $attribute = null;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function getAttribute(): ?Attribute
    {
        return $this->attribute;
    }

    public function setAttribute(?Attribute $attribute): static
    {
        $this->attribute = $attribute;

        return $this;
    }
}
