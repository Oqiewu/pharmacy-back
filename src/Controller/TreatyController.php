<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Treaty;
use App\Repository\TreatyRepository;
use App\Repository\ProviderRepository;
use App\Repository\TreatyTypeRepository;
use Symfony\Component\Serializer\SerializerInterface;

class TreatyController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private ProviderRepository $provider_repository,
        private TreatyRepository $treaty_repositroy,
        private TreatyTypeRepository $treaty_type_repository
    ) {}

    #[Route('/treaty', name: 'app_treaty_add', methods: ['POST'])]
    public function add_treaty(Request $request): Response
    {
        $treaty = new Treaty();       
        
        $data = json_decode($request->getContent(), true);

        try {
            $treaty_number                  = $data['treaty_number'];
            $treaty_date                    = $data['treaty_date'];
            $expiration_date                = $data['expiration_date'];
            $claim_period                   = $data['claim_period'];
            $deferment_fee                  = $data['deferment_fee'];
            $surplus_interest               = $data['surplus_interest'];
            $natural_discount               = $data['natural_discount'];
            $financial_discount             = $data['financial_discount'];
            !array_key_exists('payment_percentage', $data) ? $payment_percentage = '' : $payment_percentage  = $data['payment_percentage'];
            !array_key_exists('payment_deferment', $data) ? $payment_deferment = '' : $payment_deferment  = $data['payment_deferment'];
            !array_key_exists('reserve_deferral', $data) ? $reserve_deferral = '' : $reserve_deferral  = $data['reserve_deferral'];
            $deferred_payment_type          = $data['deferred_payment_type'];
            $reserve_deferral_type          = $data['reserve_deferral_type'];
            $is_not_control_credit          = $data['is_not_control_credit'];
            $is_sales_contract              = $data['is_sales_contract'];
            $credit_depth                   = $data['credit_depth'];
            $amount_credit                  = $data['amount_credit'];
            $minimum_delivery_lot           = $data['minimum_delivery_lot'];
            $estimated_delivery_time        = $data['estimated_delivery_time'];
            $replacement_term_goods         = $data['replacement_term_goods'];
            $is_default                     = $data['is_default'];
            $is_block                       = $data['is_block'];
    
            !array_key_exists('treaty_type', $data) ? $treaty_type = '' : $treaty_type  = $this->treaty_type_repository->findById($data['treaty_type']);
            !array_key_exists('provider', $data) ? $provider = '' : $provider  = $this->provider_repository->findById($data['provider']);

            !$treaty_number           ?: $treaty->setTreatyNumber($treaty_number);
            !$treaty_type             ?: $treaty->setTreatyType($treaty_type);
            !$treaty_date             ?: $treaty->setTreatyDate($treaty_date);
            !$expiration_date         ?: $treaty->setExpirationDate($expiration_date);
            !$claim_period            ?: $treaty->setClaimPeriod($claim_period);
            !$deferment_fee           ?: $treaty->setDefermentFee($deferment_fee);
            !$surplus_interest        ?: $treaty->setSurplusInterest($surplus_interest);
            !$natural_discount        ?: $treaty->setNaturalDiscount($natural_discount);
            !$financial_discount      ?: $treaty->setFinancialDiscount($financial_discount);
            !$payment_percentage      ?: $treaty->setPaymentPercentage($payment_percentage);
            !$payment_deferment       ?: $treaty->setPaymentDeferment($payment_deferment);
            !$reserve_deferral        ?: $treaty->setReserveDeferral($reserve_deferral);
            !$deferred_payment_type   ?: $treaty->setDeferredPaymentType($deferred_payment_type);
            !$reserve_deferral_type   ?: $treaty->setReserveDeferralType($reserve_deferral_type);
            !$is_not_control_credit   ?: $treaty->setIsNotControlCredit($is_not_control_credit);
            !$is_sales_contract       ?: $treaty->setIsSalesContract($is_sales_contract);
            !$credit_depth            ?: $treaty->setCreditDepth($credit_depth);
            !$amount_credit           ?: $treaty->setAmountCredit($amount_credit);
            !$minimum_delivery_lot    ?: $treaty->setMinimumDeliveryLot($minimum_delivery_lot);
            !$estimated_delivery_time ?: $treaty->setEstimatedDeliveryTime($estimated_delivery_time);
            !$replacement_term_goods  ?: $treaty->setReplacementTermGoods($replacement_term_goods);
            !$is_default              ?: $treaty->setIsDefault($is_default);
            !$is_block                ?: $treaty->setIsBlock($is_block);
            !$provider                ?: $treaty->setProvider($provider);
    
            $this->treaty_repositroy->save($treaty, true);

            return $this->json($treaty);

        }
        catch (Exception $e) {
            return $this->json($e->getMessage());
        }

    }

    #[Route('/treaty/{id}', name: 'app_treaty_remove', methods: ['DELETE'])]
    public function removeTreaty(int $id): Response
    {
        $treaty = $this->treaty_repositroy->findById($id);

        $this->treaty_repositroy->remove($treaty);

        return $this->json($treaty);
    }

    #[Route('/treaty/{id}', name: 'app_edit_treaty', methods: ['PUT'])]
    public function edit_treaty(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), Treaty::class, 'json');
       
        $data = json_decode($request->getContent(), true);

        // Getting new values
        $treaty_number                  = $editable_data->getTreatyNumber();
        !array_key_exists('treaty_type', $data) ? $treaty_type = '' : $treaty_type = $this->treaty_type_repository->findById($data['treaty_type']);
        $treaty_date                    = $editable_data->getTreatyDate();
        $expiration_date                = $editable_data->getExpirationDate();
        $claim_period                   = $editable_data->getClaimPeriod();
        $deferment_fee                  = $editable_data->getDefermentFee();
        $surplus_interest               = $editable_data->getSurplusInterest();
        $natural_discount               = $editable_data->getNaturalDiscount();
        $financial_discount             = $editable_data->getFinancialDiscount();
        $payment_percentage             = $editable_data->getPaymentPercentage();
        $payment_deferment              = $editable_data->getPaymentDeferment();
        $reserve_deferral               = $editable_data->getReserveDeferral();
        $deferred_payment_type          = $editable_data->getDeferredPaymentType();
        $reserve_deferral_type          = $editable_data->getReserveDeferralType();
        $is_not_control_credit          = $editable_data->isIsNotControlCredit();
        $is_sales_contract              = $editable_data->isIsSalesContract();
        $credit_depth                   = $editable_data->getCreditDepth();
        $amount_credit                  = $editable_data->getAmountCredit();
        $minimum_delivery_lot           = $editable_data->getMinimumDeliveryLot();
        $estimated_delivery_time        = $editable_data->getEstimatedDeliveryTime();
        $replacement_term_goods         = $editable_data->getReplacementTermGoods();
        $is_default                     = $editable_data->isIsDefault();
        $is_block                       = $editable_data->isIsBlock();

        !array_key_exists('provider', $data) ? $provider = '' : $provider  = $this->provider_repository->findById($data['provider']);
        
        $treaty = $this->treaty_repositroy->findById($id);

        // Setting new values
        !$treaty_number           ?: $treaty->setTreatyNumber($treaty_number);
        !$treaty_type             ?: $treaty->setTreatyType($treaty_type);
        !$treaty_date             ?: $treaty->setTreatyDate($treaty_date);
        !$expiration_date         ?: $treaty->setExpirationDate($expiration_date);
        !$claim_period            ?: $treaty->setClaimPeriod($claim_period);
        !$deferment_fee           ?: $treaty->setDefermentFee($deferment_fee);
        !$surplus_interest        ?: $treaty->setSurplusInterest($surplus_interest);
        !$natural_discount        ?: $treaty->setNaturalDiscount($natural_discount);
        !$financial_discount      ?: $treaty->setFinancialDiscount($financial_discount);
        !$payment_percentage      ?: $treaty->setPaymentPercentage($payment_percentage);
        !$payment_deferment       ?: $treaty->setPaymentDeferment($payment_deferment);
        !$reserve_deferral        ?: $treaty->setReserveDeferral($reserve_deferral);
        !$deferred_payment_type   ?: $treaty->setDeferredPaymentType($deferred_payment_type);
        !$reserve_deferral_type   ?: $treaty->setReserveDeferralType($reserve_deferral_type);
        !$is_not_control_credit   ?: $treaty->setIsNotControlCredit($is_not_control_credit);
        !$is_sales_contract       ?: $treaty->setIsSalesContract($is_sales_contract);
        !$credit_depth            ?: $treaty->setCreditDepth($credit_depth);
        !$amount_credit           ?: $treaty->setAmountCredit($amount_credit);
        !$minimum_delivery_lot    ?: $treaty->setMinimumDeliveryLot($minimum_delivery_lot);
        !$estimated_delivery_time ?: $treaty->setEstimatedDeliveryTime($estimated_delivery_time);
        !$replacement_term_goods  ?: $treaty->setReplacementTermGoods($replacement_term_goods);
        !$is_default              ?: $treaty->setIsDefault($is_default);
        !$is_block                ?: $treaty->setIsBlock($is_block);
        !$provider                ?: $treaty->setProvider($provider);

        $this->treaty_repositroy->save($treaty, true);

        return $this->json($treaty);
    }

    #[Route('/treaty/all', name: 'all_treaties', methods:['GET'])]
    public function getAllTreaties(): Response
    {
        return $this->json($this->treaty_repositroy->findAllTreaties());
    }

    #[Route('/treaty/{id}', name: 'app_get_treaty_by_id', methods:['GET'])]
    public function getTreatyById(int $id): Response
    {
        $treaty = $this->treaty_repositroy->findById($id);

        return $this->json($treaty);
    }
}
