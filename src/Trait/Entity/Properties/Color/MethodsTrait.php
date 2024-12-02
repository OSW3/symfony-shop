<?php 
namespace OSW3\Ecommerce\Trait\Entity\Properties\Color;

trait MethodsTrait
{
    public function setColor(?string $color): self
    {
        $this->color = $color;

        return $this;
    }
    public function getColor(): string
    {
        return $this->color;
    }
}