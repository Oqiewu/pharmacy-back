<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Organization;
use App\Repository\OrganizationRepository;

class OrganizationController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private OrganizationRepository $organizationRepository
    ) {}

    // Create new organization
    #[Route('/organization', name: 'app_organization', methods: ['POST'])]
    public function add_organization(Request $request): Response
    {
        // Organization assembly
        $organization = $this->serializer->deserialize($request->getContent(), Organization::class, 'json');

        $organization->setFirm('ООО');
        // Save new organization
        $this->organizationRepository->save($organization, true);        
        return $this->json($organization);
    }

    // Return all organizations 
    #[Route('/organization/all', name: 'app_organizations', methods: ['GET'])]
    public function get_all_organizations(): JsonResponse
    {
        return $this->json($this->organizationRepository->findByFirm("ООО"));
    }

    // Edit selected organization
    #[Route('/organization/{id}', name: 'app_edit_organization', methods: ['PUT'])]
    public function edit_organization(int $id, Request $request): JsonResponse
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), Organization::class, 'json');


        // Getting new values
        $organization_name    = $editable_data->getOrganizationName();
        $short_name           = $editable_data->getShortname();
        $inn                  = $editable_data->getInn();
        $registration_number  = $editable_data->getRegistrationNumber();
        $kpp                  = $editable_data->getKpp();
        $ifns_code            = $editable_data->getIfnsCode();
        $data                 = $editable_data->getData();
        $passport             = $editable_data->getPassport();
        $legal_address        = $editable_data->getLegalAddress();
        
        $organization = $this->organizationRepository->findById($id);
        

        // Setting new values
        !$organization_name    ?: $organization->setOrganizationName($organization_name);
        !$short_name           ?: $organization->setShortname($short_name);
        !$inn                  ?: $organization->setInn($inn);
        !$registration_number  ?: $organization->setRegistrationNumber($registration_number);
        !$kpp                  ?: $organization->setKpp($kpp);
        !$ifns_code            ?: $organization->setIfnsCode($ifns_code);
        !$data                 ?: $organization->setData($data);
        !$passport             ?: $organization->setPassport($passport);
        !$legal_address        ?: $organization->setLegalAddress($legal_address);

        $this->organizationRepository->save($organization, true);

        return $this->json($organization);
    }

    // Delete selected organization
    #[Route('/organization/{id}', name: 'app_delete_organization', methods: ['DELETE'])]
    public function delete_organization(int $id): JsonResponse
    {
        $organization = $this->organizationRepository->findById($id);

        $this->organizationRepository->remove($organization, true);

        return $this->json($organization);
    }

    ###############################################################

    // Create new soletrader
    #[Route('/soletrader', name: 'app_sole_trader', methods: ['POST'])]
    public function add_sole_trader(Request $request): Response
    {
        $sole_trader = $this->serializer->deserialize($request->getContent(), Organization::class, 'json');

        $sole_trader->setFirm('ИП');

        $this->organizationRepository->save($sole_trader, true);

        return $this->json($sole_trader);
    }

    // Return all soletraders
    #[Route('/soletrader/all', name: 'app_sole_traders', methods: ['GET'])]
    public function get_all_sole_traders(): JsonResponse
    {
        return $this->json($this->organizationRepository->findByFirm('ИП'));
    }

    #[Route('/soletrader/{id}', name: 'app_edit_sole_trader', methods: ['PUT'])]
    public function get_edit_sole_trader(int $id, Request $request): JsonResponse
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), Organization::class, 'json');

        $organization_name = $editable_data->getOrganizationName();
        $orgnip            = $editable_data->getOgrnip();
        $inn               = $editable_data->getInn();
        $account_number    = $editable_data->getAccountNumber();
        $account_type      = $editable_data->getAccountType();
        $bank_bik          = $editable_data->getBankBik();
        
        $sole_trader = $this->organizationRepository->findById($id);
        
        !$organization_name ?: $sole_trader->setOrganizationName($organization_name);
        !$orgnip            ?: $sole_trader->setOgrnip($orgnip);
        !$inn               ?: $sole_trader->setInn($inn);
        !$account_number    ?: $sole_trader->setAccountNumber($account_number);
        !$account_type      ?: $sole_trader->setAccountType($account_type);
        !$bank_bik          ?: $sole_trader->setBankBik($bank_bik);

        $this->organizationRepository->save($sole_trader, true);

        return $this->json($sole_trader);
    }

    #[Route('/soletrader/{id}', name: 'app_delete_soletrader', methods: ['DELETE'])]
    public function delete_soletrader(int $id): JsonResponse
    {
        $sole_trader = $this->organizationRepository->findById($id);

        $this->organizationRepository->remove($sole_trader, true);

        return $this->json($sole_trader);
    }
}