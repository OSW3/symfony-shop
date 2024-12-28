<?php 
namespace OSW3\Shop\Trait\Entity\Properties\Illustration;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

trait IllustrationTrait
{
    use MethodsTrait;
    
    #[Groups("illustration")]
    #[ORM\Column(name: "illustration", type: Types::TEXT, nullable: false)]
    private string $illustration;
    
}