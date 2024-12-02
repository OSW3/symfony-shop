<?php

namespace OSW3\Ecommerce\Entity\Tag;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use OSW3\Ecommerce\Repository\Tag\TagRepository;
use OSW3\Ecommerce\Trait\Entity\Properties\Icon\Nullable\IconTrait;
use OSW3\Ecommerce\Trait\Entity\Properties\Id\UuidTrait;
use OSW3\Ecommerce\Trait\Entity\Properties\Workflow\IsActiveTrait;

#[ORM\Entity(repositoryClass: TagRepository::class)]
#[ORM\Table(name: 'tag')]
class Tag
{
    use UuidTrait;
    use IconTrait;
    use IsActiveTrait;


    // RELATIONSHIP
    // --

    /**
     * @var Collection<int, Translation>
     */
    #[ORM\OneToMany(targetEntity: Translation::class, mappedBy: 'tag')]
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
            $translation->setTag($this);
        }

        return $this;
    }

    public function removeTranslation(Translation $translation): static
    {
        if ($this->translations->removeElement($translation)) {
            // set the owning side to null (unless already changed)
            if ($translation->getTag() === $this) {
                $translation->setTag(null);
            }
        }

        return $this;
    }
}
