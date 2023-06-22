<?php

namespace App\Controller;

use App\Entity\Manufacturer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\ManufacturerRepository;
use App\Repository\BarCodeRepository;

class ManufacturerController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private ManufacturerRepository $manufacturer_repository,
        private BarCodeRepository $barcode_repository
    ) {}

    // Create new organization
    #[Route('/manufacturer', name: 'app_manufacturer', methods: ['POST'])]
    public function add_manufacturer(Request $request): Response
    {
        // Organization assembly
        $manufacturer = $this->serializer->deserialize($request->getContent(), Manufacturer::class, 'json');

        // Save new organization
        $this->manufacturer_repository->save($manufacturer, true);
        
        return $this->json($manufacturer);
    }

    #[Route('/manufacturer/{id}', name: 'app_delete_manufacturer', methods: ['DELETE'])]
    public function deleteManufacturer(int $id): Response
    {
        $manufacturer = $this->manufacturer_repository->findById($id);

        $this->manufacturer_repository->remove($manufacturer, true);

        return $this->json($manufacturer);
    }

    #[Route('/manufacturer/all', name: 'app_all_manufacturer', methods:['GET'])]
    public function getAllManufacturer(): Response
    {
        return $this->json($this->manufacturer_repository->findAllManufacturer());
    }

    #[Route('/manufacturer/{id}', name: 'app_edit_manufacturer', methods: ['PUT'])]
    public function editManufacturer(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), Manufacturer::class, 'json');

        // Getting new values
        $manufacture_name = $editable_data->getManufactureName();

        $manufacturer = $this->manufacturer_repository->findById($id);

        // Setting new values
        !$manufacture_name ?: $manufacturer->setManufactureName($manufacture_name);

        $this->manufacturer_repository->save($manufacturer, true);

        return $this->json($manufacturer);
    }

    #[Route('/manufacturer/{id}/provider', name: 'app_get_provider_by_manufacturer', methods:['GET'])]
    public function getProviderByManufacturer(int $id): Response
    {
        $manufacturer = $this->manufacturer_repository->findById($id);

        $provider = $manufacturer->getProvider();

        return $this->json($provider);
    }

    #[Route('/manufacturer/{id}/barcode', name: 'app_get_barcode_by_manufacturer', methods:['GET'])]
    public function getBarcodeByManufacturer(int $id): Response
    {
        $manufacturer = $this->manufacturer_repository->findById($id);

        $barcode = $this->barcode_repository->findByManufacturer($manufacturer->getId());

        return $this->json($barcode);
    }
}
