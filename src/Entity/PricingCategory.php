<?php

namespace App\Entity;

use App\Repository\PricingCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PricingCategoryRepository::class)]
class PricingCategory
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $category_name = null;

    #[ORM\Column]
    private ?int $pricing_percentage = null;

    #[ORM\Column(length: 255)]
    private ?string $stretch_option = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_stretch_to = null;
    
    #[ORM\Column(nullable: true)]
    private ?int $stretch_to = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_stretch_over_border = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCategoryName(): ?string
    {
        return $this->category_name;
    }

    public function setCategoryName(string $category_name): static
    {
        $this->category_name = $category_name;

        return $this;
    }

    public function getPricingPercentage(): ?int
    {
        return $this->pricing_percentage;
    }

    public function setPricingPercentage(int $pricing_percentage): static
    {
        $this->pricing_percentage = $pricing_percentage;

        return $this;
    }

    public function getStretchOption(): ?string
    {
        return $this->stretch_option;
    }

    public function setStretchOption(string $stretch_option): static
    {
        $this->stretch_option = $stretch_option;

        return $this;
    }

    public function isStretchTo(): ?bool
    {
        return $this->is_stretch_to;
    }

    public function setIsStretchTo(?bool $is_stretch_to): static
    {
        $this->is_stretch_to = $is_stretch_to;

        return $this;
    }

    public function getStretchTo(): ?int
    {
        return $this->stretch_to;
    }

    public function setStretchTo(?int $stretch_to): static
    {
        $this->stretch_to = $stretch_to;

        return $this;
    }

    public function isStretchOverBorder(): ?bool
    {
        return $this->is_stretch_over_border;
    }

    public function setStretchOverBorder(?bool $is_stretch_over_border): static
    {
        $this->is_stretch_over_border = $is_stretch_over_border;

        return $this;
    }

    public function isIsStretchTo(): ?bool
    {
        return $this->is_stretch_to;
    }

    public function isIsStretchOverBorder(): ?bool
    {
        return $this->is_stretch_over_border;
    }

    public function setIsStretchOverBorder(?bool $is_stretch_over_border): static
    {
        $this->is_stretch_over_border = $is_stretch_over_border;

        return $this;
    }
}
