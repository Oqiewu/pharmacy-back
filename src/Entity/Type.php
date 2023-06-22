<?php

namespace App\Entity;

use App\Repository\TypeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TypeRepository::class)]
class Type
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $type_name = null;

    #[ORM\ManyToOne(targetEntity: PricingCategory::class, inversedBy: 'pricing_category')]
    private $pricing_category;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeName(): ?string
    {
        return $this->type_name;
    }

    public function setTypeName(string $type_name): static
    {
        $this->type_name = $type_name;

        return $this;
    }

    public function getPricingCategory(): ?PricingCategory
    {
        return $this->pricing_category;
    }

    public function setPricingCategory(?PricingCategory $pricing_category): static
    {
        $this->pricing_category = $pricing_category;

        return $this;
    }
}
