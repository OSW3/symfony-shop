<?php 
namespace OSW3\Ecommerce\Trait\Entity\Properties\Illustration;

trait MethodsTrait
{
    public function setIllustration(?string $illustration): self
    {
        $this->illustration = $illustration;

        return $this;
    }
    public function getIllustration(): string
    {
        return $this->illustration;
    }
}