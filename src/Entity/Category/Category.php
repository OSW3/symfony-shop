<?php
namespace OSW3\Ecommerce\Entity\Category;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
use Ramsey\Uuid\UuidInterface as UUID;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;
use OSW3\Ecommerce\Repository\Category\CategoryRepository;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
#[ORM\Table(name: 'category')]
class Category
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


    // CATEGORY INFO
    // --

    /**
     * Category name
     *
     * @var string|null
     */
    #[ORM\Column(name: "name", type: Types::STRING, length: 80, nullable: false)]
    private ?string $name = null;

    /**
     * Category Icon
     *
     * @var string|null
     */
    #[ORM\Column(name: "icon", type: Types::STRING, length: 255, nullable: true)]
    private ?string $icon = null;

    /**
     * Category colors
     *
     * @var string|null
     */
    #[ORM\Column(name: "color", type: Types::STRING, length: 7, nullable: false)]
    private ?string $color = null;

    /**
     * Category Illustration
     *
     * @var string
     */
    #[Groups("illustration")]
    #[ORM\Column(name: "illustration", type: Types::TEXT, nullable: false)]
    private string $illustration;


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

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'children')]
    private ?self $parent = null;

    /**
     * @var Collection<int, Translation>
     */
    #[ORM\OneToMany(targetEntity: Translation::class, mappedBy: 'category')]
    private Collection $translations;

    /**
     * @var Collection<int, self>
     */
    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'parent')]
    private Collection $children;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function __construct()
    {
        $this->children = new ArrayCollection();
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


    // CATEGORY INFO
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }
    public function setIcon(string $icon): self
    {
        $this->icon = $icon;

        return $this;
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

    public function setIllustration(?string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }
    public function getIllustration(): string
    {
        return $this->illustration;
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

    public function getParent(): ?self
    {
        return $this->parent;
    }
    public function setParent(?self $parent): static
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getChildren(): Collection
    {
        return $this->children;
    }
    public function addChild(self $child): static
    {
        if (!$this->children->contains($child)) {
            $this->children->add($child);
            $child->setParent($this);
        }

        return $this;
    }
    public function removeChild(self $child): static
    {
        if ($this->children->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

        return $this;
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
            $translation->setCategory($this);
        }

        return $this;
    }
    public function removeTranslation(Translation $translation): static
    {
        if ($this->translations->removeElement($translation)) {
            // set the owning side to null (unless already changed)
            if ($translation->getCategory() === $this) {
                $translation->setCategory(null);
            }
        }

        return $this;
    }
}
