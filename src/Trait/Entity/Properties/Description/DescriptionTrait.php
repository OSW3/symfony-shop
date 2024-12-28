<?php 
namespace OSW3\Shop\Trait\Entity\Properties\Description;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait DescriptionTrait
{
    #[Groups("description")]
    #[ORM\Column(name: "description", type: Types::TEXT, nullable: false)]
    private string $description;


    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }
    public function getDescription(): string
    {
        return $this->description;
    }
}