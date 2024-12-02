<?php

namespace OSW3\Ecommerce\Entity\Product\Product;

use Doctrine\ORM\Mapping as ORM;
use OSW3\Ecommerce\Trait\Entity\Properties\Id\UuidTrait;
use OSW3\Ecommerce\Repository\Product\Product\ProductRepository;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: 'product')]
class Product
{
    use UuidTrait;
}
