<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use App\Entity\ActiveSubstance;
use Doctrine\ORM\PersistentCollection;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    // Основной
    #[ORM\Column(length: 500)]
    private ?string $product_name = null;

    // #[ORM\Column(nullable: true)]
    // private ?array $photo;

    #[ORM\Column(options: ["default: 0"])]
    private ?bool $is_vital_necessity = false;

    #[ORM\Column(options: ["default: 0"])]
    private ?bool $is_sign_oa = false;

    #[ORM\Column(options: ["default: 0"])]
    private ?bool $is_sign_pkkn = false;

    #[ORM\Column(nullable: true)]
    private ?int $total = null;

    #[ORM\Column(nullable: true)]
    private ?int $free = null;

    #[ORM\Column(nullable: true)]
    private ?int $reserve = null;

    // #[ORM\ManyToOne(targetEntity: Type::class, inversedBy: 'type', cascade: ['persist'])]
    // private $type;

    // #[ORM\ManyToOne(targetEntity: Subtype::class, inversedBy: 'subtype')]
    // private $subtype;

    // #[ORM\ManyToOne(targetEntity: ActiveSubstance::class, inversedBy: 'active_substance')]
    // private $active_substance;

    #[ORM\Column(nullable: true)]
    private ?bool $obligatory_1 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $obligatory_2 = null;

    #[ORM\Column(nullable: true)]
    private ?bool $top_sales = null;

    #[ORM\Column(nullable: true)]
    private ?bool $mandatory_assortyment = null;

    #[ORM\Column(nullable: true)]
    private ?string $label_print = null;

    #[ORM\Column(nullable: true)]
    private ?bool $label_printing = null;

    #[ORM\Column(nullable: true)]
    private ?int $tax = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_stop_sales = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_not_public = null;

    #[ORM\Column(nullable: true)]
    private ?int $batch = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_dont_take_manufacturer = null;

    #[ORM\Column(nullable: true)]
    private ?int $sales_limit = null;

    #[ORM\Column(nullable: true)]
    private ?string $manufacturer = null;

    // Изготовитель
    // #[ORM\ManyToMany(targetEntity: Manufacturer::class, inversedBy: 'manufacturer')]
    // private $manufacturer;

    #[ORM\Column(nullable: true)]
    private ?int $price_in_register = null;

    #[ORM\Column(nullable: true)]
    private ?string $date_of_registration = null;

    // Единица измерения
    #[ORM\Column(nullable: true)]
    private ?string $base_unit = null;

    #[ORM\Column(nullable: true)]
    private ?string $unit_for_sales = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_close_division = null;

    #[ORM\Column(nullable: true)]
    private ?int $conversion_factor = null;

    #[ORM\Column(nullable: true)]
    private ?int $grouping = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_grouping = null;

    // Ассоритментный план (АП)

    // #[ORM\ManyToMany(targetEntity: Pharmacy::class, inversedBy: 'pharmacy')]
    // private $plan_pharmacy;

    #[ORM\Column(nullable: true)]
    private ?bool $is_included_plan = null;

    #[ORM\Column(nullable: true)]
    private ?bool $is_custom = null;

    #[ORM\Column(nullable: true)]
    private ?string $plan_group = null;

    #[ORM\Column(nullable: true)]
    private ?string $abc_group = null;

    #[ORM\Column(nullable: true)]
    private ?int $minimum_balance = null;

    #[ORM\Column(nullable: true)]
    private ?int $minimum_lot_order = null;

    #[ORM\Column(nullable: true)]
    private ?string $barcode = null;

    // Наценки

    // #[ORM\ManyToMany(targetEntity: GoodsMargin::class, inversedBy: 'goods_margin')]
    // private $goods_margin;
    
    // #[ORM\ManyToMany(targetEntity: TypeMarkup::class, inversedBy: 'type_markup')]
    // private $type_markup;

    // Фикс цена
    
    #[ORM\Column(nullable: true)]
    private ?int $price = null;

    // public function __construct()
    // {
    //     // $this->manufacturer = new ArrayCollection();
    //     $this->plan_pharmacy = new ArrayCollection();
    //     $this->goods_margin = new ArrayCollection();
    //     $this->type_markup = new ArrayCollection();
    // }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): static
    {
        $this->product_name = $product_name;

        return $this;
    }

    // public function getPhoto(): ?array
    // {
    //     return $this->photo;
    // }

    // public function setPhoto(array $treaty): static
    // {
    //     $this->photo = $photo;

    //     return $this;
    // }

    public function isVitalNecessity(): ?bool
    {
        return $this->is_vital_necessity;
    }

    public function setVitalNecessity(bool $is_vital_necessity): static
    {
        $this->is_vital_necessity = $is_vital_necessity;

        return $this;
    }

    public function isSignOa(): ?bool
    {
        return $this->is_sign_oa;
    }

    public function setSignOa(bool $is_sign_oa): static
    {
        $this->is_sign_oa = $is_sign_oa;

        return $this;
    }

    public function isSignPkkn(): ?bool
    {
        return $this->is_sign_pkkn;
    }

    public function setSignPkkn(bool $is_sign_pkkn): static
    {
        $this->is_sign_pkkn = $is_sign_pkkn;

        return $this;
    }

    public function getTotal(): ?int
    {
        return $this->total;
    }

    public function setTotal(?int $total): static
    {
        $this->total = $total;

        return $this;
    }

    public function getFree(): ?int
    {
        return $this->free;
    }

    public function setFree(?int $free): static
    {
        $this->free = $free;

        return $this;
    }

    public function getReserve(): ?int
    {
        return $this->reserve;
    }

    public function setReserve(?int $reserve): static
    {
        $this->reserve = $reserve;

        return $this;
    }

    // public function getType(): ?Type
    // {
    //     return $this->type;
    // }

    // public function setType(Type $type): static
    // {
    //     $this->type = $type;

    //     return $this;
    // }

    // public function getSubtype(): ?Subtype
    // {
    //     return $this->subtype;
    // }

    // public function setSubtype(Subtype $subtype): static
    // {
    //     $this->subtype = $subtype;

    //     return $this;
    // }

    // public function getActiveSubstance(): ?ActiveSubstance
    // {
    //     return $this->active_substance;
    // }

    // public function setActiveSubstance(?ActiveSubstance $active_substance): static
    // {
    //     $this->active_substance = $active_substance;

    //     return $this;
    // }

    public function getIsObligatory1(): ?bool
    {
        return $this->obligatory_1;
    }

    public function setIsObligatory1(bool $obligatory_1): static
    {
        $this->obligatory_1 = $obligatory_1;

        return $this;
    }

    public function getIsObligatory2(): ?bool
    {
        return $this->obligatory_2;
    }

    public function setIsObligatory2(bool $obligatory_2): static
    {
        $this->obligatory_2 = $obligatory_2;

        return $this;
    }

    public function isTopSales(): ?bool
    {
        return $this->top_sales;
    }

    public function setTopSales(bool $top_sales): static
    {
        $this->top_sales = $top_sales;

        return $this;
    }

    public function isMandatoryAssortyment(): ?bool
    {
        return $this->mandatory_assortyment;
    }

    public function setMandatoryAssortyment(bool $mandatory_assortyment): static
    {
        $this->mandatory_assortyment = $mandatory_assortyment;

        return $this;
    }

    public function getLabelPrint(): ?string
    {
        return $this->label_print;
    }

    public function setLabelPrint(string $label_print): static
    {
        $this->label_print = $label_print;

        return $this;
    }

    public function getLabelPrinting(): ?bool
    {
        return $this->label_printing;
    }

    public function setLabelPrinting(bool $label_printing): static
    {
        $this->label_printing = $label_printing;

        return $this;
    }

    public function getTax(): ?int
    {
        return $this->tax;
    }

    public function setTax(int $tax): static
    {
        $this->tax = $tax;

        return $this;
    }

    public function isIsStopSales(): ?bool
    {
        return $this->is_stop_sales;
    }

    public function setIsStopSales(bool $is_stop_sales): static
    {
        $this->is_stop_sales = $is_stop_sales;

        return $this;
    }

    public function isIsNotPublic(): ?bool
    {
        return $this->is_not_public;
    }

    public function setIsNotPublic(bool $is_not_public): static
    {
        $this->is_not_public = $is_not_public;

        return $this;
    }

    public function getBatch(): ?int
    {
        return $this->batch;
    }

    public function setBatch(int $batch): static
    {
        $this->batch = $batch;

        return $this;
    }

    public function isDontTakeManufacturer(): ?bool
    {
        return $this->is_dont_take_manufacturer;
    }

    public function setDontTakeManufacturer(bool $is_dont_take_manufacturer): static
    {
        $this->is_dont_take_manufacturer = $is_dont_take_manufacturer;

        return $this;
    }

    public function getSalesLimit(): ?int
    {
        return $this->sales_limit;
    }

    public function setSalesLimit(int $sales_limit): static
    {
        $this->sales_limit = $sales_limit;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): static
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getPriceInRegister(): ?int
    {
        return $this->price_in_register;
    }

    public function setPriceInRegister(int $price_in_register): static
    {
        $this->price_in_register = $price_in_register;

        return $this;
    }

    public function getDateOfRegistration(): ?string
    {
        return $this->date_of_registration;
    }

    public function setDateOfRegistration(string $date_of_registration): static
    {
        $this->date_of_registration = $date_of_registration;

        return $this;
    }

    public function getIsCloseDivision(): ?bool
    {
        return $this->is_close_division;
    }

    public function setIsCloseDivision(bool $is_close_division): static
    {
        $this->is_close_division = $is_close_division;

        return $this;
    }

    public function getConversationFactor(): ?int
    {
        return $this->conversion_factor;
    }

    public function setConversationFactor(?int $conversion_factor): static
    {
        $this->conversion_factor = $conversion_factor;

        return $this;
    }

    public function getGrouping(): ?int
    {
        return $this->grouping;
    }

    public function setGrouping(?int $grouping): static
    {
        $this->grouping = $grouping;

        return $this;
    }

    public function getIsGrouping(): ?bool
    {
        return $this->is_grouping;
    }

    public function setIsGrouping(bool $is_grouping): static
    {
        $this->is_grouping = $is_grouping;

        return $this;
    }

    // public function getPlanPharmacy(): ?PersistentCollection
    // {
    //     return $this->plan_pharmacy;
    // }

    // public function setPlanPharmacy(PersistentCollection $plan_pharmacy): static
    // {
    //     $this->plan_pharmacy = $plan_pharmacy;

    //     return $this;
    // }

    public function getIsIncludedPlan(): ?bool
    {
        return $this->is_included_plan;
    }

    public function setIsIncludedPlan(bool $is_included_plan): static
    {
        $this->is_included_plan = $is_included_plan;

        return $this;
    }

    public function getIsCustom(): ?bool
    {
        return $this->is_custom;
    }

    public function setIsCustom(bool $is_custom): static
    {
        $this->is_custom = $is_custom;

        return $this;
    }

    public function getPlanGroup(): ?string
    {
        return $this->plan_group;
    }

    public function setPlanGroup(string $plan_group): static
    {
        $this->plan_group = $plan_group;

        return $this;
    }

    public function getABCGroup(): ?string
    {
        return $this->abc_group;
    }

    public function setABCGroup(string $abc_group): static
    {
        $this->abc_group = $abc_group;

        return $this;
    }

    public function getMinimumBalance(): ?int
    {
        return $this->minimum_balance;
    }

    public function setMinimumBalance(?int $minimum_balance): static
    {
        $this->minimum_balance = $minimum_balance;

        return $this;
    }

    public function getMinimumLotOrder(): ?int
    {
        return $this->minimum_lot_order;
    }

    public function setMinimumLotOrder(?int $minimum_lot_order): static
    {
        $this->minimum_lot_order = $minimum_lot_order;

        return $this;
    }

    // public function getGoodsMargins(): ?PersistentCollection
    // {
    //     return $this->goods_margin;
    // }

    // public function setGoodsMargins(PersistentCollection $goods_margin): static
    // {
    //     $this->goods_margin = $goods_margin;

    //     return $this;
    // }

    // public function getTypeMarkup(): ?PersistentCollection
    // {
    //     return $this->type_markup;
    // }

    // public function setTypeMarkup(PersistentCollection $type_markup): static
    // {
    //     $this->type_markup = $type_markup;

    //     return $this;
    // }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): static
    {
        $this->price = $price;

        return $this;
    }

    public function isIsVitalNecessity(): ?bool
    {
        return $this->is_vital_necessity;
    }

    public function setIsVitalNecessity(bool $is_vital_necessity): static
    {
        $this->is_vital_necessity = $is_vital_necessity;

        return $this;
    }

    public function isIsSignOa(): ?bool
    {
        return $this->is_sign_oa;
    }

    public function setIsSignOa(bool $is_sign_oa): static
    {
        $this->is_sign_oa = $is_sign_oa;

        return $this;
    }

    public function isIsSignPkkn(): ?bool
    {
        return $this->is_sign_pkkn;
    }

    public function setIsSignPkkn(bool $is_sign_pkkn): static
    {
        $this->is_sign_pkkn = $is_sign_pkkn;

        return $this;
    }

    public function isObligatory1(): ?bool
    {
        return $this->obligatory_1;
    }

    public function setObligatory1(?bool $obligatory_1): static
    {
        $this->obligatory_1 = $obligatory_1;

        return $this;
    }

    public function isObligatory2(): ?bool
    {
        return $this->obligatory_2;
    }

    public function setObligatory2(?bool $obligatory_2): static
    {
        $this->obligatory_2 = $obligatory_2;

        return $this;
    }

    public function isLabelPrinting(): ?bool
    {
        return $this->label_printing;
    }

    public function isIsDontTakeManufacturer(): ?bool
    {
        return $this->is_dont_take_manufacturer;
    }

    public function setIsDontTakeManufacturer(?bool $is_dont_take_manufacturer): static
    {
        $this->is_dont_take_manufacturer = $is_dont_take_manufacturer;

        return $this;
    }

    public function getBaseUnit(): ?string
    {
        return $this->base_unit;
    }

    public function setBaseUnit(string $base_unit): static
    {
        $this->base_unit = $base_unit;

        return $this;
    }

    public function getUnitForSales(): ?string
    {
        return $this->unit_for_sales;
    }

    public function setUnitForSales(string $unit_for_sales): static
    {
        $this->unit_for_sales = $unit_for_sales;

        return $this;
    }

    public function isIsCloseDivision(): ?bool
    {
        return $this->is_close_division;
    }

    public function getConversionFactor(): ?int
    {
        return $this->conversion_factor;
    }

    public function setConversionFactor(?int $conversion_factor): static
    {
        $this->conversion_factor = $conversion_factor;

        return $this;
    }

    public function isIsGrouping(): ?bool
    {
        return $this->is_grouping;
    }

    public function isIsIncludedPlan(): ?bool
    {
        return $this->is_included_plan;
    }

    public function isIsCustom(): ?bool
    {
        return $this->is_custom;
    }

    public function getBarcode(): ?string
    {
        return $this->barcode;
    }

    public function setBarcode(string $barcode): static
    {
        $this->barcode = $barcode;

        return $this;
    }

    // public function addManufacturer(Manufacturer $manufacturer): static
    // {
    //     if (!$this->manufacturer->contains($manufacturer)) {
    //         $this->manufacturer->add($manufacturer);
    //     }

    //     return $this;
    // }

    // public function removeManufacturer(Manufacturer $manufacturer): static
    // {
    //     $this->manufacturer->removeElement($manufacturer);

    //     return $this;
    // }

    // public function addPlanPharmacy(Pharmacy $planPharmacy): static
    // {
    //     if (!$this->plan_pharmacy->contains($planPharmacy)) {
    //         $this->plan_pharmacy->add($planPharmacy);
    //     }

    //     return $this;
    // }

    // public function removePlanPharmacy(Pharmacy $planPharmacy): static
    // {
    //     $this->plan_pharmacy->removeElement($planPharmacy);

    //     return $this;
    // }
}
