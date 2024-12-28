<?php
namespace OSW3\Shop\Entity\Product\Attribute;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface as UUID;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;
use OSW3\Shop\Repository\Product\Attribute\AttributeRepository;

#[ORM\Entity(repositoryClass: AttributeRepository::class)]
#[ORM\Table(name: 'attribute')]
class Attribute
{
    // ID's
    // --

    /**
     * Primary key
     *
     * @var uuid|null
     */
    #[Groups(['id'])]
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: "Ramsey\Uuid\Doctrine\UuidGenerator")]
    private ?uuid $id = null;


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


    // ID's
    // --

    public function getId(): ?uuid
    {
        return $this->id;
    }


    // RELATIONSHIP
    // --

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
