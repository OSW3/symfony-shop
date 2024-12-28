<?php 
namespace OSW3\Shop\Trait\Entity\Properties\Workflow;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait IsActiveTrait
{
    #[ORM\Column(name: "is_active", type: Types::BOOLEAN, nullable: false)]
    private bool $isActive = false;

    public function isActive(): bool
    {
        return $this->isActive;
    }
    public function setActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }
}