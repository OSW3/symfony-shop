<?php 
namespace OSW3\Shop\Trait\Entity\Properties\Language;

trait MethodsTrait
{
    public function setLanguage(string $language): static
    {
        $this->language = $language;

        return $this;
    }
    public function getLanguage(): ?string
    {
        return $this->language;
    }
}