<?php 
namespace OSW3\Shop\Trait\Entity\Properties\Icon;

trait MethodsTrait
{
    public function setIcon(?string $icon): self
    {
        $this->icon = $icon;

        return $this;
    }
    public function getIcon(): string
    {
        return $this->icon;
    }
}