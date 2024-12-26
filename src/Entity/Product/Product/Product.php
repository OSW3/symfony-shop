<?php

namespace OSW3\Ecommerce\Entity\Product\Product;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface as UUID;
use Symfony\Component\Serializer\Attribute\Groups;
use OSW3\Ecommerce\Repository\Product\Product\ProductRepository;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
#[ORM\Table(name: 'product')]
class Product
{
    // ID's
    // --

    /**
     * Primary key
     *
     * @var uuid|null
     */
    #[Groups(['id'])]
    #[ORM\Id]
    #[ORM\Column(type: "uuid", unique: true)]
    #[ORM\GeneratedValue(strategy: "CUSTOM")]
    #[ORM\CustomIdGenerator(class: "Ramsey\Uuid\Doctrine\UuidGenerator")]
    private ?uuid $id = null;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    // ID's
    // --

    public function getId(): ?uuid
    {
        return $this->id;
    }
}
