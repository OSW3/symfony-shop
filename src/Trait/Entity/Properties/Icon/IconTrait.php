<?php 
namespace OSW3\Ecommerce\Trait\Entity\Properties\Icon;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait IconTrait
{
    use MethodsTrait;
    
    #[Groups("icon")]
    #[ORM\Column(name: "icon", type: Types::TEXT, nullable: false)]
    private string $icon;
    
}