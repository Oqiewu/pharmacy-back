<?php

namespace App\Entity;

use App\Repository\BarCodeRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BarCodeRepository::class)]
class BarCode
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $bar_code = null;

    #[ORM\Column(length: 255)]
    private ?string $unit = null;

    #[ORM\ManyToOne(targetEntity: Manufacturer::class, inversedBy: 'manufacturer', cascade: ["persist"])]
    #[ORM\JoinColumn(name: "manufacturer_id", referencedColumnName: "id")]
    private ?Manufacturer $manufacturer;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBarCode(): ?string
    {
        return $this->bar_code;
    }

    public function setBarCode(string $bar_code): static
    {
        $this->bar_code = $bar_code;

        return $this;
    }

    public function getUnit(): ?string
    {
        return $this->unit;
    }

    public function setUnit(string $unit): static
    {
        $this->unit = $unit;

        return $this;
    }

    public function getManufacturer(): ?Manufacturer
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?Manufacturer $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }
}
