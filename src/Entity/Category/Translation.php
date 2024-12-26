<?php
namespace OSW3\Ecommerce\Entity\Category;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use OSW3\Ecommerce\Repository\Category\TranslationRepository;

#[ORM\Entity(repositoryClass: TranslationRepository::class)]
#[ORM\Table(name: 'category_translation')]
class Translation
{
    // ID's
    // --
    
    /**
     * Primary Key
     *
     * @var integer|null
     */
    #[Groups(['id'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id", type: Types::INTEGER, options: ['unsigned' => true])]
    private ?int $id = null;

    // /**
    //  * Slug
    //  *
    //  * @var string|null
    //  */
    // #[Groups('slug')]
    // #[Gedmo\Slug(fields: ['name','language'], unique: true)]
    // #[ORM\Column(name: 'slug', type: Types::STRING, length: 255, unique: true, nullable: false)]
    // private ?string $slug = null;


    // TRANSLATION DATA
    // --
    
    /**
     * Translation language
     *
     * @var string
     */
    #[Groups(['language'])]
    #[ORM\Column(name: "language", type: Types::STRING, length: 2, options: ['fixed' => true], nullable: false)]
    private string $language;

    /**
     * Translation name / key
     *
     * @var string|null
     */
    #[ORM\Column(name: "name", type: Types::STRING, length: 255, nullable: false)]
    private ?string $name = null;

    /**
     * Translation value
     *
     * @var string|null
     */
    #[Groups("value")]
    #[ORM\Column(name: "value", type: Types::TEXT, nullable: true)]
    private ?string $value = null;


    // RELATIONSHIP
    // --

    #[ORM\ManyToOne(inversedBy: 'translations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Category $category = null;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    // ID's
    // --

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getSlug(): string
    // {
    //     return $this->slug;
    // }


    // TRANSLATION DATA
    // --

    public function setLanguage(string $language): static
    {
        $this->language = $language;

        return $this;
    }
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    public function getName(): ?string
    {
        return $this->name;
    }

    public function setValue(?string $value): self
    {
        $this->value = $value;

        return $this;
    }
    public function getValue(): ?string
    {
        return $this->value;
    }


    // RELATIONSHIP
    // --

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
