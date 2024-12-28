<?php
namespace OSW3\Shop\Entity\Product\Product;

use App\Entity\Variant;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\UuidInterface as UUID;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Attribute\Groups;
use OSW3\Shop\Repository\Product\Product\ProductRepository;

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

    /**
     * Category ShopifyId
     *
     * @var string|null
     */
    #[ORM\Column(name: "shopifyId", type: Types::INTEGER, length: 255, nullable: true)]
    private ?int $shopifyId = null;


    // WORKFLOW
    // --

    /**
     * Workflow: is active flag
     *
     * @var boolean
     */
    #[ORM\Column(name: "is_active", type: Types::BOOLEAN, nullable: false)]
    private bool $isActive = false;


    // RELATIONSHIP
    // --

    /**
     * @var Collection<int, Translation>
     */
    #[ORM\OneToMany(targetEntity: Translation::class, mappedBy: 'product')]
    private Collection $translations;

    /**
     * @var Collection<int, Variant>
     */
    #[ORM\OneToMany(targetEntity: Variant::class, mappedBy: 'product')]
    private Collection $variants;


    // = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = = =

    public function __construct()
    {
        $this->translations = new ArrayCollection();
        $this->variants = new ArrayCollection();
    }

    // ID's
    // --

    public function getId(): ?uuid
    {
        return $this->id;
    }

    public function getShopifyId(): ?int
    {
        return $this->shopifyId;
    }
    public function setShopifyId(?int $shopifyId): self
    {
        $this->shopifyId = $shopifyId;

        return $this;
    }


    // WORKFLOW
    // --

    public function isActive(): bool
    {
        return $this->isActive;
    }
    public function setActive(bool $isActive): static
    {
        $this->isActive = $isActive;

        return $this;
    }


    // RELATIONSHIP
    // --

    /**
     * @return Collection<int, Translation>
     */
    public function getTranslations(): Collection
    {
        return $this->translations;
    }
    public function addTranslation(Translation $translation): static
    {
        if (!$this->translations->contains($translation)) {
            $this->translations->add($translation);
            $translation->setProduct($this);
        }

        return $this;
    }
    public function removeTranslation(Translation $translation): static
    {
        if ($this->translations->removeElement($translation)) {
            // set the owning side to null (unless already changed)
            if ($translation->getProduct() === $this) {
                $translation->setProduct(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Variant>
     */
    public function getVariants(): Collection
    {
        return $this->variants;
    }

    public function addVariant(Variant $variant): static
    {
        if (!$this->variants->contains($variant)) {
            $this->variants->add($variant);
            $variant->setProduct($this);
        }

        return $this;
    }

    public function removeVariant(Variant $variant): static
    {
        if ($this->variants->removeElement($variant)) {
            // set the owning side to null (unless already changed)
            if ($variant->getProduct() === $this) {
                $variant->setProduct(null);
            }
        }

        return $this;
    }
}
