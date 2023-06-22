<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\Provider;
use App\Repository\ProviderRepository;
use App\Repository\RegionRepository;
use App\Repository\ClientTypeRepository;

class ProviderController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private ProviderRepository $provider_repository,
        private RegionRepository $region_repository,
        private ClientTypeRepository $client_type_repository
    ) {}

    #[Route('/provider', name: 'app_add_provider', methods:['POST'])]
    public function add_provider(Request $request): Response
    {
        $provider = $this->serializer->deserialize($request->getContent(), Provider::class, 'json');
        $data = json_decode($request->getContent(), true);

        !array_key_exists('client_type', $data) ? $client_type = '' :$client_type = $this->client_type_repository->findById($data['client_type']);
        !array_key_exists('region', $data) ? $region = '' :$region = $this->region_repository->findById($data['region']);

        !$client_type            ?: $provider->setClientType($client_type);
        !$region                 ?: $provider->setRegion($region);
        
        $this->provider_repository->save($provider, true);

        return $this->json($provider);
    }

    #[Route('/provider/{id}', name: 'app_delete_provider', methods:['DELETE'])]
    public function delete_provider(int $id): Response
    {
        $provider = $this->provider_repository->findById($id);

        $this->provider_repository->remove($provider, true);

        return $this->json($provider);
    }

    #[Route('/provider/all', name: 'app_all_providers', methods:['GET'])]
    public function getProviders(Request $request): Response
    {
        return $this->json($this->provider_repository->findAllProviders());
    }

    #[Route('/provider/{id}', name: 'app_edit_provider', methods: ['PUT'])]
    public function editProvider(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), Provider::class, 'json');
        $data = json_decode($request->getContent(), true);

        // Getting new values
        !array_key_exists('client_type', $data) ? $client_type = '' :$client_type = $this->client_type_repository->findById($data['client_type']);
        $provider_name          = $editable_data->getProviderName();
        $inn                    = $editable_data->getInn();
        $full_name              = $editable_data->getFullName();
        $phone                  = $editable_data->getPhone();
        !array_key_exists('region', $data) ? $region = '' :$region = $this->region_repository->findById($data['region']);
        $address                = $editable_data->getAddress();
        $consignee_name         = $editable_data->getConsigneeName();
        $consignee_address      = $editable_data->getConsigneeAddress();
        $ogrn                   = $editable_data->getOgrn();
        $okpo                   = $editable_data->getOkpo();
        $okonh                  = $editable_data->getOkonh();
        $kpp                    = $editable_data->getKpp();
        $is_invoice             = $editable_data->getIsInvoice();
        $is_ndsaccounting       = $editable_data->getIsNDSAccounting();
        $is_ndssum              = $editable_data->getIsNDSSum();
        $is_npaccounting        = $editable_data->getIsNPAccounting();
        $is_npsum               = $editable_data->getIsNPSum();
        $bank_account           = $editable_data->getBankAccount();
        $bank                   = $editable_data->getBank();
        $bank_address           = $editable_data->getBankAddress();
        $correspondent_account  = $editable_data->getCorrespondentAccount();
        $bik                    = $editable_data->getBik();
        
        
        $provider = $this->provider_repository->findById($id);
        

        // Setting new values
        !$client_type            ?: $provider->setClientType($client_type);
        !$provider_name          ?: $provider->setProviderName($provider_name);
        !$inn                    ?: $provider->setInn($inn);
        !$full_name              ?: $provider->setFullName($full_name);
        !$phone                  ?: $provider->setPhone($phone);
        !$region                 ?: $provider->setRegion($region);
        !$address                ?: $provider->setAddress($address);
        !$consignee_name         ?: $provider->setConsigneeName($consignee_name);
        !$consignee_address      ?: $provider->setConsigneeAddress($consignee_address);
        !$ogrn                   ?: $provider->setOgrn($ogrn);
        !$okpo                   ?: $provider->setOkpo($okpo);
        !$okonh                  ?: $provider->setOkonh($okonh);
        !$kpp                    ?: $provider->setKpp($kpp);
        !$is_invoice             ?: $provider->setIsInvoice($is_invoice);
        !$is_ndsaccounting       ?: $provider->setIsNDSAccounting($is_ndsaccounting);
        !$is_ndssum              ?: $provider->setIsNDSSum($is_ndssum);
        !$is_npaccounting        ?: $provider->setIsNPAccounting($is_npaccounting);
        !$is_npsum               ?: $provider->setIsNPSum($is_npsum);
        !$bank_account           ?: $provider->setBankAccount($bank_account);
        !$bank                   ?: $provider->setBank($bank);
        !$bank_address           ?: $provider->setBankAddress($bank_address);
        !$correspondent_account  ?: $provider->setCorrespondentAccount($correspondent_account);
        !$bik                    ?: $provider->setBik($bik);

        $this->provider_repository->save($provider, true);

        return $this->json($provider);
    }
}
