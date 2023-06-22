<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\RegionRepository;
use App\Entity\Region;

class RegionController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private RegionRepository $region_repository
    ) {}

    #[Route('region', name: 'app_region_add', methods: ['POST'])]
    public function addRegion(Request $request): Response
    {
        $region = $this->serializer->deserialize($request->getContent(), Region::class, 'json');

        $this->region_repository->save($region, true);

        return $this->json($region);
    }

    #[Route('region/{id}', name: 'app_region_remove', methods: ['DELETE'])]
    public function removeRegion(int $id): Response
    {
        $region = $this->region_repository->findById($id);

        $this->region_repository->remove($region);

        return $this->json($region);
    }

    #[Route('/region/all', name: 'all_regions', methods:['GET'])]
    public function getAllRegions(): Response
    {
        return $this->json($this->region_repository->findAllRegions());
    }

    #[Route('/region/{id}', name: 'app_edit_region', methods: ['PUT'])]
    public function editRegion(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), Region::class, 'json');

        // Getting new values
        $region_name = $editable_data->getRegionName();

        $region = $this->region_repository->findById($id);

        // Setting new values
        !$region_name ?: $region->setRegionName($region_name);

        $this->region_repository->save($region, true);

        return $this->json($region);
    }
}
