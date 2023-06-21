<?php

namespace App\Entity;

use App\Repository\OrganizationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: OrganizationRepository::class)]
#[ORM\Table(name: '`organization`')]
class Organization
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true, unique: true)]
    private ?string $organization_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $shortname = null;

    #[ORM\Column(length: 255, nullable: true, unique: true)]
    private ?string $registration_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $inn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $kpp = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ifns_code = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $data = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $legal_address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $passport = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ogrnip = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $account_number = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $account_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bank_bik = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firm = null;
    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrganizationName(): ?string
    {
        return $this->organization_name;
    }

    public function setOrganizationName(string $organization_name): static
    {
        $this->organization_name = $organization_name;

        return $this;
    }

    public function getShortname(): ?string
    {
        return $this->shortname;
    }

    public function setShortname(string $shortname): static
    {
        $this->shortname = $shortname;

        return $this;
    }
    
    public function getInn(): ?string
    {
        return $this->inn;
    }

    public function setInn(string $inn): static
    {
        $this->inn = $inn;

        return $this;
    }

    public function getRegistrationNumber(): ?string
    {
        return $this->registration_number;
    }

    public function setRegistrationNumber(string $registration_number): static
    {
        $this->registration_number = $registration_number;

        return $this;
    }

    public function getKpp(): ?string
    {
        return $this->kpp;
    }

    public function setKpp(string $kpp): static
    {
        $this->kpp = $kpp;

        return $this;
    }

    public function getIfnsCode(): ?string
    {
        return $this->ifns_code;
    }

    public function setIfnsCode(string $ifns_code): static
    {
        $this->ifns_code = $ifns_code;

        return $this;
    }

    public function getData(): ?string
    {
        return $this->data;
    }

    public function setData(string $data): static
    {
        $this->data = $data;

        return $this;
    }

    public function getPassport(): ?string
    {
        return $this->passport;
    }

    public function setPassport(string $passport): static
    {
        $this->passport = $passport;

        return $this;
    }

    public function getLegalAddress(): ?string
    {
        return $this->legal_address;
    }

    public function setLegalAddress(string $legal_address): static
    {
        $this->legal_address = $legal_address;

        return $this;
    }

    public function getOgrnip(): ?string
    {
        return $this->ogrnip;
    }

    public function setOgrnip(string $ogrnip): static
    {
        $this->ogrnip = $ogrnip;

        return $this;
    }

    public function getAccountNumber(): ?string
    {
        return $this->account_number;
    }

    public function setAccountNumber(string $account_number): static
    {
        $this->account_number = $account_number;

        return $this;
    }

    public function getAccountType(): ?string
    {
        return $this->account_type;
    }

    public function setAccountType(string $account_type): static
    {
        $this->account_type = $account_type;

        return $this;
    }

    public function getBankBik(): ?string
    {
        return $this->bank_bik;
    }

    public function setBankBik(string $bank_bik): static
    {
        $this->bank_bik = $bank_bik;

        return $this;
    }

    public function getFirm(): ?string
    {
        return $this->firm;
    }

    public function setFirm(string $firm): static
    {
        $this->firm =  $firm;

        return $this;
    }
}
