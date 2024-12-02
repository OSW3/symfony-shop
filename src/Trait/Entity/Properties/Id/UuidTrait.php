<?php 
namespace OSW3\Ecommerce\Trait\Entity\Properties\Id;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface as UUID;
use Symfony\Component\Serializer\Attribute\Groups;

trait UuidTrait
{
    #[Groups(['id'])]
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: "Ramsey\Uuid\Doctrine\UuidGenerator")]
    private ?uuid $id = null;

    public function getId(): ?uuid
    {
        return $this->id;
    }
}