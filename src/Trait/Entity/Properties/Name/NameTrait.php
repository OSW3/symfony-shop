<?php 
namespace OSW3\Shop\Trait\Entity\Properties\Name;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait NameTrait
{
    #[ORM\Column(name: "name", type: Types::STRING, length: 255, nullable: false)]
    private ?string $name = null;

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }
    public function getName(): ?string
    {
        return $this->name;
    }
}