<?php

namespace App\Entity;

use App\Repository\PharmacyRepository;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Organization;

#[ORM\Entity(repositoryClass: PharmacyRepository::class)]
class Pharmacy
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $pharmacy_name = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\ManyToOne(targetEntity: Organization::class, inversedBy: 'organization')]
    private $organization;

    #[ORM\Column(length: 255)]
    private ?string $coordinates = null;

    #[ORM\Column(length: 255)]
    private ?string $phone = null;

    #[ORM\Column(length: 255)]
    private ?string $schedule = null;

    #[ORM\Column(length: 255)]
    private ?string $status = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPharmacyName(): ?string
    {
        return $this->pharmacy_name;
    }

    public function setPharmacyName(string $pharmacy_name): static
    {
        $this->pharmacy_name = $pharmacy_name;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getOrganization(): ?Organization
    {
        return $this->organization;
    }

    public function setOrganization(Organization $organization): static
    {
        $this->organization = $organization;

        return $this;
    }

    public function getCoordinates(): ?string
    {
        return $this->coordinates;
    }

    public function setCoordinates(string $coordinates): static
    {
        $this->coordinates = $coordinates;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSchedule(): ?string
    {
        return $this->schedule;
    }

    public function setSchedule(string $schedule): static
    {
        $this->schedule = $schedule;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(string $status): static
    {
        $this->status = $status;

        return $this;
    }
}
