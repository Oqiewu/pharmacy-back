<?php

namespace App\Entity;

use App\Repository\TreatyRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TreatyRepository::class)]
class Treaty
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $treaty_number = null;

    #[ORM\Column]
    private ?string $treaty_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $treaty_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $expiration_date = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $claim_period = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deferment_fee = null;

    #[ORM\Column(nullable: true)]
    private ?int $surplus_interest = null;

    #[ORM\Column(nullable: true)]
    private ?int $natural_discount = null;

    #[ORM\Column(nullable: true)]
    private ?int $financial_discount = null;

    #[ORM\Column(nullable: true)]
    private ?int $payment_percentage = null;

    #[ORM\Column(nullable: true)]
    private ?int $payment_deferment = null;

    #[ORM\Column(nullable: true)]
    private ?int $reserve_deferral = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $deferred_payment_type = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $reserve_deferral_type = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_not_control_credit = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_sales_contract = null;

    #[ORM\Column(nullable: true)]
    private ?int $credit_depth = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $amount_credit = null;

    #[ORM\Column(nullable: true)]
    private ?int $minimum_delivery_lot = null;

    #[ORM\Column(nullable: true)]
    private ?int $estimated_delivery_time = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $replacement_term_goods = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_default = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_block = null;

    #[ORM\ManyToOne(targetEntity: Provider::class, inversedBy: 'treaty')]
    private $provider;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTreatyNumber(): ?string
    {
        return $this->treaty_number;
    }

    public function setTreatyNumber(?string $treaty_number): static
    {
        $this->treaty_number = $treaty_number;

        return $this;
    }

    public function getTreatyType(): ?string
    {
        return $this->treaty_type;
    }

    public function setTreatyType(string $treaty_type): static
    {
        $this->treaty_type = $treaty_type;

        return $this;
    }

    public function getTreatyDate(): ?string
    {
        return $this->treaty_date;
    }

    public function setTreatyDate(string $treaty_date): static
    {
        $this->treaty_date = $treaty_date;

        return $this;
    }

    public function getExpirationDate(): ?string
    {
        return $this->expiration_date;
    }

    public function setExpirationDate(?string $expiration_date): static
    {
        $this->expiration_date = $expiration_date;

        return $this;
    }

    public function getClaimPeriod(): ?string
    {
        return $this->claim_period;
    }

    public function setClaimPeriod(?string $claim_period): static
    {
        $this->claim_period = $claim_period;

        return $this;
    }

    public function getDefermentFee(): ?string
    {
        return $this->deferment_fee;
    }

    public function setDefermentFee(?string $deferment_fee): static
    {
        $this->deferment_fee = $deferment_fee;

        return $this;
    }

    public function getSurplusInterest(): ?int
    {
        return $this->surplus_interest;
    }

    public function setSurplusInterest(?int $surplus_interest): static
    {
        $this->surplus_interest = $surplus_interest;

        return $this;
    }

    public function getNaturalDiscount(): ?int
    {
        return $this->natural_discount;
    }

    public function setNaturalDiscount(?int $natural_discount): static
    {
        $this->natural_discount = $natural_discount;

        return $this;
    }

    public function getFinancialDiscount(): ?int
    {
        return $this->financial_discount;
    }

    public function setFinancialDiscount(?int $financial_discount): static
    {
        $this->financial_discount = $financial_discount;

        return $this;
    }

    public function getPaymentPercentage(): ?int
    {
        return $this->payment_percentage;
    }

    public function setPaymentPercentage(?int $payment_percentage): static
    {
        $this->payment_percentage = $payment_percentage;

        return $this;
    }

    public function getPaymentDeferment(): ?int
    {
        return $this->payment_deferment;
    }

    public function setPaymentDeferment(?int $payment_deferment): static
    {
        $this->payment_deferment = $payment_deferment;

        return $this;
    }

    public function getReserveDeferral(): ?int
    {
        return $this->reserve_deferral;
    }

    public function setReserveDeferral(?int $reserve_deferral): static
    {
        $this->reserve_deferral = $reserve_deferral;

        return $this;
    }

    public function getDeferredPaymentType(): ?string
    {
        return $this->deferred_payment_type;
    }

    public function setDeferredPaymentType(?string $deferred_payment_type): static
    {
        $this->deferred_payment_type = $deferred_payment_type;

        return $this;
    }

    public function getReserveDeferralType(): ?string
    {
        return $this->reserve_deferral_type;
    }

    public function setReserveDeferralType(string $reserve_deferral_type): static
    {
        $this->reserve_deferral_type = $reserve_deferral_type;

        return $this;
    }

    public function isIsNotControlCredit(): ?bool
    {
        return $this->is_not_control_credit;
    }

    public function setIsNotControlCredit(bool $is_not_control_credit): static
    {
        $this->is_not_control_credit = $is_not_control_credit;

        return $this;
    }

    public function isIsSalesContract(): ?bool
    {
        return $this->is_sales_contract;
    }

    public function setIsSalesContract(?bool $is_sales_contract): static
    {
        $this->is_sales_contract = $is_sales_contract;

        return $this;
    }

    public function getCreditDepth(): ?int
    {
        return $this->credit_depth;
    }

    public function setCreditDepth(?int $credit_depth): static
    {
        $this->credit_depth = $credit_depth;

        return $this;
    }

    public function getAmountCredit(): ?string
    {
        return $this->amount_credit;
    }

    public function setAmountCredit(?string $amount_credit): static
    {
        $this->amount_credit = $amount_credit;

        return $this;
    }

    public function getMinimumDeliveryLot(): ?int
    {
        return $this->minimum_delivery_lot;
    }

    public function setMinimumDeliveryLot(?int $minimum_delivery_lot): static
    {
        $this->minimum_delivery_lot = $minimum_delivery_lot;

        return $this;
    }

    public function getEstimatedDeliveryTime(): ?int
    {
        return $this->estimated_delivery_time;
    }

    public function setEstimatedDeliveryTime(?int $estimated_delivery_time): static
    {
        $this->estimated_delivery_time = $estimated_delivery_time;

        return $this;
    }

    public function getReplacementTermGoods(): ?string
    {
        return $this->replacement_term_goods;
    }

    public function setReplacementTermGoods(?string $replacement_term_goods): static
    {
        $this->replacement_term_goods = $replacement_term_goods;

        return $this;
    }

    public function isIsDefault(): ?bool
    {
        return $this->is_default;
    }

    public function setIsDefault(?bool $is_default): static
    {
        $this->is_default = $is_default;

        return $this;
    }

    public function isIsBlock(): ?bool
    {
        return $this->is_block;
    }

    public function setIsBlock(?bool $is_block): static
    {
        $this->is_block = $is_block;

        return $this;
    }

    public function getProvider(): ?Provider
    {
        return $this->provider;
    }

    public function setProvider(?Provider $provider): static
    {
        $this->provider = $provider;

        return $this;
    }
}
