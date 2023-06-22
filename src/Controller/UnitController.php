<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Unit;
use App\Repository\UnitRepository;
use App\Repository\ProductRepository;
use Symfony\Component\Serializer\SerializerInterface;

class UnitController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private UnitRepository $unit_repository,
        private ProductRepository $product_repository
    ) {}

    #[Route('/unit', name: 'app_add_unit', methods: ['POST'])]
    public function addUnit(Request $request): Response
    {
        $unit = $this->serializer->deserialize($request->getContent(), Unit::class, 'json');
        $data = json_decode($request->getContent(), true);

        $product = $this->product_repository->findById($data['product']);

        $unit->setProduct($product);

        $this->unit_repository->save($unit, true);

        return $this->json($unit);
    }

    #[Route('/unit/{id}', name: 'app_delete_unit', methods: ['DELETE'])]
    public function deleteUnit(int $id): Response
    {
        $unit = $this->unit_repository->findById($id);

        $this->unit_repository->remove($unit, true);

        return $this->json($unit);
    }

    #[Route('/unit/all', name: 'app_all_units', methods:['GET'])]
    public function getAllUnits(): Response
    {
        return $this->json($this->unit_repository->findAllUnits());
    }

    #[Route('/unit/{id}', name: 'app_edit_unit', methods: ['PUT'])]
    public function editUnit(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), Unit::class, 'json');
        $data = json_decode($request->getContent(), true);

        // Getting new values
        $unit        = $editable_data->getUnit();
        $unit_code   = $editable_data->getUnitCode();
        $coefficient = $editable_data->getCoefficient();
        $product     = $this->product_repository->findById($data['product']);
        
        $unit_entity = $this->unit_repository->findById($id);
        

        // Setting new values
        !$unit        ?: $unit_entity->setUnit($unit);
        !$unit_code   ?: $unit_entity->setUnitCode($unit_code);
        !$coefficient ?: $unit_entity->setCoefficient($coefficient);
        !$product     ?: $unit_entity->setProduct($product);

        $this->unit_repository->save($unit_entity, true);

        return $this->json($unit_entity);
    }
}
