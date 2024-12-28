<?php
namespace OSW3\Shop\Entity\Product\Attribute;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use OSW3\Shop\Repository\Product\Attribute\TranslationRepository;

#[ORM\Entity(repositoryClass: TranslationRepository::class)]
#[ORM\Table(name: 'attribute_translation')]
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
     * Translation description  /value
     *
     * @var string|null
     */
    #[Groups("description")]
    #[ORM\Column(name: "description", type: Types::TEXT, nullable: true)]
    private ?string $description = null;


    // RELATIONSHIP
    // --

    #[ORM\ManyToOne(inversedBy: 'translations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Attribute $attribute = null;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    // ID's
    // --

    public function getId(): ?int
    {
        return $this->id;
    }


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

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function getDescription(): ?string
    {
        return $this->description;
    }


    // RELATIONSHIP
    // --

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
