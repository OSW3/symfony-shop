<?php 
namespace OSW3\Shop\Trait\Entity\Properties\Name;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait SortNameTrait
{
    #[ORM\Column(name: "name_sort", type: Types::STRING, length: 80, nullable: false)]
    private ?string $sortName = null;

    public function setSortName(string $sortName): static
    {
        $this->sortName = empty($sortName) ? $this->name : $sortName;

        return $this;
    }
    public function getSortName(): ?string
    {
        return $this->sortName;
    }
}