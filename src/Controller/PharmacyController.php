<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Pharmacy;
use App\Repository\PharmacyRepository;
use Symfony\Component\Serializer\SerializerInterface;

class PharmacyController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private PharmacyRepository $pharmacy_repository
    ) {}

    // Add new pharmacy
    #[Route('/pharmacy', name: 'app_pharmacy', methods: ['POST'])]
    public function addPharmacy(Request $request): JsonResponse
    {

        $pharmacy_request = $this->serializer->deserialize($request->getContent(),  Pharmacy::class, 'json');

        $this->pharmacy_repository->save($pharmacy_request, true);

        return $this->json($pharmacy_request);
    }

    // Edit selected pharmacy
    #[Route('/pharmacy/{id}', name: 'app_edit_pharmacy', methods: ['PUT'])]
    public function editPharmacy(int $id, Request $request): JsonResponse
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), Pharmacy::class, 'json');

        // Getting new values
        $pharmacy_name  = $editable_data->getPharmacyName();
        $address        = $editable_data->getAddress();
        $organization   = $editable_data->getOrganization();
        $coordinates    = $editable_data->getCoordinates();
        $phone          = $editable_data->getPhone();
        $schedule       = $editable_data->getSchedule();
        $status         = $editable_data->getStatus();
        
        $pharmacy = $this->pharmacy_repository->findById($id);
        

        // Setting new values
        $pharmacy
            ->setPharmacyName($pharmacy_name)
            ->setAddress($address)
            ->setOrganization($organization)
            ->setCoordinates($coordinates)
            ->setPhone($phone)
            ->setSchedule($schedule)
            ->setStatus($status);

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
}
