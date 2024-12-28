<?php 
namespace OSW3\Shop\Trait\Entity\Properties\Icon\Nullable;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use OSW3\Shop\Trait\Entity\Properties\Icon\MethodsTrait;

trait IconTrait
{
    use MethodsTrait;

    #[Groups("icon")]
    #[ORM\Column(name: "icon", type: Types::TEXT, nullable: false)]
    private string $icon;
}