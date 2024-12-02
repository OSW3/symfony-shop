<?php 
namespace OSW3\Ecommerce\Trait\Entity\Properties\Language;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use OSW3\Ecommerce\Trait\Entity\Properties\Language\MethodsTrait;

trait LanguageTrait
{
    use MethodsTrait;
    
    #[Groups(['language'])]
    #[ORM\Column(name: "language", type: Types::STRING, length: 2, options: ['fixed' => true], nullable: false)]
    private string $language;
}