<?php 
namespace OSW3\Shop\Trait\Entity\Properties\Id;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

trait IdTrait
{
    #[Groups(['id'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(name: "id", type: Types::INTEGER, options: ['unsigned' => true])]
    private ?int $id = null;

    public function getId(): ?int
    {
        return $this->id;
    }
}