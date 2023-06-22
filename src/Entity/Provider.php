<?php

namespace App\Entity;

use App\Repository\ProviderRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\Manufacturer;
use App\Entity\ClientType;
use Doctrine\ORM\PersistentCollection;

#[ORM\Entity(repositoryClass: ProviderRepository::class)]
class Provider
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Основной
    #[ORM\Column(length: 255)]
    private ?string $provider_name = null;

    #[ORM\OneToOne(targetEntity: ClientType::class, inversedBy: 'client_type')]
    private $client_type;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $inn = null;

    #[ORM\Column(length: 255)]
    private ?string $full_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $phone = null;

    #[ORM\ManyToOne(targetEntity: Region::class, inversedBy: 'region')]
    private $region;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $consignee_name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $consignee_address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ogrn = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $okpo = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $okonh = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $kpp = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?bool $isInvoice = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?bool $isNDSAccounting = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?bool $isNDSSum = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?bool $isNPAccounting = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?bool $isNPSum = null;

    // Банковские реквизиты
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bank_account = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bank = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bank_address = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $correspondent_bank = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $correspondent_account = null;
    
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $bik = null;

    // МДЛП


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProviderName(): ?string
    {
        return $this->provider_name;
    }

    public function setProviderName(string $provider_name): static
    {
        $this->provider_name = $provider_name;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->full_name;
    }

    public function setFullName(string $full_name): static
    {
        $this->full_name = $full_name;

        return $this;
    }

    public function getClientType(): ?ClientType
    {
        return $this->client_type;
    }

    public function setClientType(ClientType $client_type): static
    {
        $this->client_type = $client_type;

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

    public function getRegion(): ?Region
    {
        return $this->region;
    }

    public function setRegion(Region $region): static
    {
        $this->region = $region;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): static
    {
        $this->phone = $phone;

        return $this;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(?string $address): static
    {
        $this->address = $address;

        return $this;
    }

    public function getConsigneeName(): ?string
    {
        return $this->consignee_name;
    }

    public function setConsigneeName(?string $consignee_name): static
    {
        $this->consignee_name = $consignee_name;

        return $this;
    }

    public function getConsigneeAddress(): ?string
    {
        return $this->consignee_address;
    }

    public function setConsigneeAddress(?string $consignee_address): static
    {
        $this->consignee_address = $consignee_address;

        return $this;
    }
    public function getOgrn(): ?string
    {
        return $this->ogrn;
    }

    public function setOgrn(?string $ogrn): static
    {
        $this->ogrn = $ogrn;

        return $this;
    }
    public function getOkpo(): ?string
    {
        return $this->okpo;
    }

    public function setOkpo(?string $okpo): static
    {
        $this->okpo = $okpo;

        return $this;
    }
    public function getOkonh(): ?string
    {
        return $this->okonh;
    }

    public function setOkonh(?string $okonh): static
    {
        $this->okonh = $okonh;

        return $this;
    }
    public function getKpp(): ?string
    {
        return $this->kpp;
    }

    public function setKpp(?string $kpp): static
    {
        $this->kpp = $kpp;

        return $this;
    }

    public function getIsInvoice(): ?bool
    {
        return $this->isInvoice;
    }

    public function setIsInvoice(?bool $isInvoice): static
    {
        $this->isInvoice = $isInvoice;

        return $this;
    }

    public function getIsNDSAccounting(): ?bool
    {
        return $this->isNDSAccounting;
    }

    public function setIsNDSAccounting(?bool $isNDSAccounting): static
    {
        $this->isNDSAccounting = $isNDSAccounting;

        return $this;
    }

    public function getIsNDSSum(): ?bool
    {
        return $this->isNDSSum;
    }

    public function setIsNDSSum(?bool $isNDSSum): static
    {
        $this->isNDSSum = $isNDSSum;

        return $this;
    }

    public function getIsNPAccounting(): ?bool
    {
        return $this->isNPAccounting;
    }

    public function setIsNPAccounting(?bool $isNPAccounting): static
    {
        $this->isNPAccounting = $isNPAccounting;

        return $this;
    }

    public function getIsNPSum(): ?bool
    {
        return $this->isNPSum;
    }

    public function setIsNPSum(?bool $isNPSum): static
    {
        $this->isNPSum = $isNPSum;

        return $this;
    }

    public function getBankAccount(): ?string
    {
        return $this->bank_account;
    }

    public function setBankAccount(?string $bank_account): static
    {
        $this->bank_account = $bank_account;

        return $this;
    }

    public function getBank(): ?string
    {
        return $this->bank;
    }

    public function setBank(?string $bank): static
    {
        $this->bank = $bank;

        return $this;
    }

    public function getBankAddress(): ?string
    {
        return $this->bank_address;
    }

    public function setBankAddress(?string $bank_address): static
    {
        $this->bank_address = $bank_address;

        return $this;
    }

    public function getCorrespondentBank(): ?string
    {
        return $this->correspondent_bank;
    }

    public function setCorrespondentBank(?string $correspondent_bank): static
    {
        $this->correspondent_bank = $correspondent_bank;

        return $this;
    }

    public function getCorrespondentAccount(): ?string
    {
        return $this->correspondent_account;
    }

    public function setCorrespondentAccount(?string $correspondent_account): static
    {
        $this->correspondent_account = $correspondent_account;

        return $this;
    }

    public function getBik(): ?string
    {
        return $this->bik;
    }

    public function setBik(?string $bik): static
    {
        $this->bik = $bik;

        return $this;
    }

    public function isIsInvoice(): ?bool
    {
        return $this->isInvoice;
    }

    public function isIsNDSAccounting(): ?bool
    {
        return $this->isNDSAccounting;
    }

    public function isIsNDSSum(): ?bool
    {
        return $this->isNDSSum;
    }

    public function isIsNPAccounting(): ?bool
    {
        return $this->isNPAccounting;
    }

    public function isIsNPSum(): ?bool
    {
        return $this->isNPSum;
    }
}
