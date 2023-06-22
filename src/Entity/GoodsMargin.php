<?php

namespace App\Entity;

use App\Repository\GoodsMarginRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GoodsMarginRepository::class)]
class GoodsMargin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: PricingCategory::class, inversedBy: 'pricing_category')]
    private $category;

    #[ORM\Column(nullable: true)]
    private ?int $lower_limit = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 2, scale: 2, nullable: true)]
    private ?string $upper_limit = null;

    #[ORM\Column(nullable: true)]
    private ?int $markup_percentage = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategory(): ?PricingCategory
    {
        return $this->category;
    }

    public function setCategory(PricingCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getLowerLimit(): ?int
    {
        return $this->lower_limit;
    }

    public function setLowerLimit(?int $lower_limit): static
    {
        $this->lower_limit = $lower_limit;

        return $this;
    }

    public function getUpperLimit(): ?string
    {
        return $this->upper_limit;
    }

    public function setUpperLimit(?string $upper_limit): static
    {
        $this->upper_limit = $upper_limit;

        return $this;
    }

    public function getMarkupPercentage(): ?int
    {
        return $this->markup_percentage;
    }

    public function setMarkupPercentage(?int $markup_percentage): static
    {
        $this->markup_percentage = $markup_percentage;

        return $this;
    }
}
