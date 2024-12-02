<?php 
namespace OSW3\Ecommerce\Trait\Entity\Properties\Color\Nullable;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use OSW3\Ecommerce\Trait\Entity\Properties\Color\MethodsTrait;

trait ColorTrait
{
    use MethodsTrait;

    #[Groups("color")]
    #[ORM\Column(name: "color", type: Types::STRING, length: 7, options: ['fixed' => true], nullable: false)]
    private string $color;
}