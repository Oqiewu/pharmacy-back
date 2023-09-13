<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Pharmacy;
use App\Repository\PharmacyRepository;
use App\Repository\OrganizationRepository;
use Symfony\Component\Serializer\SerializerInterface;
use App\Services\PharmacyService;

class PharmacyController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private PharmacyRepository $pharmacy_repository,
        private OrganizationRepository $organization_repository,
        private PharmacyService $pharmacy_service
    ) {}

    // Add new pharmacy
    #[Route('/pharmacy', name: 'app_pharmacy', methods: ['POST'])]
    public function addPharmacy(Request $request): JsonResponse
    {

        $pharmacy = $this->serializer->deserialize($request->getContent(),  Pharmacy::class, 'json');
        $data = json_decode($request->getContent(), true);

        $organization = $this->organization_repository->findById($data['organization']);

        $pharmacy->setOrganization($organization);

        $this->pharmacy_repository->save($pharmacy, true);

        return $this->json($pharmacy);
    }

    // Edit selected pharmacy
    #[Route('/pharmacy/{id}', name: 'app_edit_pharmacy', methods: ['PUT'])]
    public function editPharmacy(int $id, Request $request): JsonResponse
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), Pharmacy::class, 'json');
        $data = json_decode($request->getContent(), true);

        // Getting new values
        $pharmacy_name  = $editable_data->getPharmacyName();
        $address        = $editable_data->getAddress();
        $organization   = $this->organization_repository->findById($data['organization']);
        $coordinates    = $editable_data->getCoordinates();
        $phone          = $editable_data->getPhone();
        $schedule       = $editable_data->getSchedule();
        $status         = $editable_data->getStatus();
        
        $pharmacy = $this->pharmacy_repository->findById($id);
        

        // Setting new values
        !$pharmacy_name ?: $pharmacy->setPharmacyName($pharmacy_name);
        !$address       ?: $pharmacy->setAddress($address);
        !$organization  ?: $pharmacy->setOrganization($organization);
        !$coordinates   ?: $pharmacy->setCoordinates($coordinates);
        !$phone         ?: $pharmacy->setPhone($phone);
        !$schedule      ?: $pharmacy->setSchedule($schedule);
        !$status        ?: $pharmacy->setStatus($status);

        $this->pharmacy_repository->save($pharmacy, true);

        return $this->json($pharmacy);
    }

    // Delete selected pharmacy
    #[Route('/pharmacy/{id}', name: 'app_delete_pharmacy', methods: ['DELETE'])]
    public function delete_pharmacy(int $id): JsonResponse
    {
        $pharmacy = $this->pharmacy_repository->findById($id);

        $this->pharmacy_repository->remove($pharmacy, true);

        return $this->json($pharmacy);
    }

    // Getting all pharmacies
    #[Route('/pharmacy/all', name: 'app_pharmacies', methods: ['GET'])]
    public function get_all_pharmacies(): JsonResponse
    {
        return $this->json($this->pharmacy_repository->findAllPharmacies());
    }

    #[Route('/pharmacy/{id}', name: 'get_pharmacy_by_id', methods:['GET'])]
    public function getPharmacyById(int $id): JsonResponse
    {
        $pharmacy = $this->pharmacy_repository->findById($id);

        return $this->json($pharmacy);
    }

    #[Route('/pharmacy/number', name: 'get_number_of_pharmacies', methods:['GET'])]
    public function getNumberOfPharmacies(int $id): JsonResponse
    {
        return $this->json($this->pharmacy_service->get_number_of_pharmacies());
    }
}
