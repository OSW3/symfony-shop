<?php 
namespace OSW3\Ecommerce\Trait\Entity\Schema;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use OSW3\Ecommerce\Trait\Entity\Properties\Id\IdTrait;

trait TranslationTrait
{
    use IdTrait;


    // LANGUAGE
    // --

    #[ORM\Column(name: "lang", type: Types::STRING, length: 2, options: ['fixed' => true], nullable: false)]
    private ?string $lang = null;


    // SUBJECT
    // --

    #[ORM\Column(name: "property", type: Types::STRING, length: 40, nullable: false)]
    private ?string $property = null;

    #[ORM\Column(name: "value", type: Types::TEXT, nullable: true)]
    private ?string $value = null;

    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =


    // LANGUAGE
    // --

    public function setLang(string $lang): self
    {
        $this->lang = $lang;

        return $this;
    }
    public function getLang(): ?string
    {
        return $this->lang;
    }


    // SUBJECT
    // --

    public function setProperty(string $property): self
    {
        $this->property = $property;

        return $this;
    }
    public function getProperty(): ?string
    {
        return $this->property;
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
}