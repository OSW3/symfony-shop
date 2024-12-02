<?php 
namespace OSW3\Ecommerce\Trait\Entity\Properties\Language\Nullable;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use OSW3\Ecommerce\Trait\Entity\Properties\Language\MethodsTrait;
use Symfony\Component\Serializer\Annotation\Groups;

trait LanguageNullableTrait
{
    use MethodsTrait;
    
    #[Groups(['language'])]
    #[ORM\Column(name: "language", type: Types::STRING, length: 2, options: ['fixed' => true], nullable: true)]
    private ?string $language = null;
}