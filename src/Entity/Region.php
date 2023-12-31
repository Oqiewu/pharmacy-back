<?php

namespace App\Entity;

use App\Repository\RegionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegionRepository::class)]
class Region
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $region_name = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRegionName(): ?string
    {
        return $this->region_name;
    }

    public function setRegionName(string $region_name): static
    {
        $this->region_name = $region_name;

        return $this;
    }
}
