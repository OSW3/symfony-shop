<?php 
namespace OSW3\Ecommerce\Trait\Entity\Properties\Slug;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;

trait SlugTrait
{
    #[ORM\Column(name: "slug", type: Types::STRING, length: 80, nullable: false)]
    #[Gedmo\Slug(fields: SLUG_FIELDS)]
    private ?string $slug = null;
    
    public function setSlug(?string $slug): static
    {
        $this->slug = $slug;

        return $this;
    }
    public function getSlug(): ?string
    {
        return $this->slug;
    }
}