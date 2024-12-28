<?php
namespace OSW3\Shop\Entity\Tag;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\UuidInterface as UUID;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use OSW3\Shop\Repository\Tag\TagRepository;
use Symfony\Component\Serializer\Attribute\Groups;

#[ORM\Entity(repositoryClass: TagRepository::class)]
#[ORM\Table(name: 'tag')]
class Tag
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

    /**
     * Slug
     *
     * @var string|null
     */
    #[Groups('slug')]
    #[Gedmo\Slug(fields: ['name'])]
    #[ORM\Column(name: 'slug', type: Types::STRING, length: 80, unique: true, nullable: false)]
    private ?string $slug = null;


    // TAG INFO
    // --

    /**
     * Tag name
     *
     * @var string|null
     */
    #[ORM\Column(name: "name", type: Types::STRING, length: 80, nullable: false)]
    private ?string $name = null;

    /**
     * Category colors
     *
     * @var string|null
     */
    #[ORM\Column(name: "color", type: Types::STRING, length: 7, nullable: false)]
    private ?string $color = null;


    // WORKFLOW
    // --

    /**
     * Workflow: is active flag
     *
     * @var boolean
     */
    #[ORM\Column(name: "is_active", type: Types::BOOLEAN, nullable: false)]
    private bool $isActive = false;


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


    // ID's
    // --

    public function getId(): ?uuid
    {
        return $this->id;
    }

    public function getSlug(): string
    {
        return $this->slug;
    }


    // TAG INFO
    // --

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    public function getName(): ?string
    {
        return $this->name;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }
    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }


    // WORKFLOW
    // --

    public function isActive(): bool
    {
        return $this->isActive;
    }
    public function setActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
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
