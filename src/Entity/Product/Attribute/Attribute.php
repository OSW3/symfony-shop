<?php

namespace OSW3\Ecommerce\Entity\Product\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use OSW3\Ecommerce\Trait\Entity\Properties\Id\UuidTrait;
use OSW3\Ecommerce\Repository\Attribute\Attribute\AttributeRepository;

#[ORM\Entity(repositoryClass: AttributeRepository::class)]
#[ORM\Table(name: 'attribute')]
class Attribute
{
    use UuidTrait;


    // RELATIONSHIP
    // --


    /**
     * @var Collection<int, Translation>
     */
    #[ORM\OneToMany(targetEntity: Translation::class, mappedBy: 'attribute')]
    private Collection $translations;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function __construct()
    {
        $this->translations = new ArrayCollection();
    }

    /**
     * @return Collection<int, Translation>
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }

    public function addTranslation(Translation $translation): static
    {
        if (!$this->translations->contains($translation)) {
            $this->translations->add($translation);
            $translation->setAttribute($this);
        }

        return $this;
    }

    public function removeTranslation(Translation $translation): static
    {
        if ($this->translations->removeElement($translation)) {
            // set the owning side to null (unless already changed)
            if ($translation->getAttribute() === $this) {
                $translation->setAttribute(null);
            }
        }

        return $this;
    }
}
