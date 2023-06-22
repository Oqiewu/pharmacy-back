<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Type;
use App\Repository\TypeRepository;
use App\Repository\PricingCategoryRepository;

class TypeController extends AbstractController
{
    public function __construct(
        private TypeRepository $type_repository,
        private PricingCategoryRepository $pricing_category_repository
    ) {}

    // Create new organization
    #[Route('/type', name: 'app_type', methods: ['POST'])]
    public function addType(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $pricing_category = $this->pricing_category_repository->findById($data['pricing_category']);

        $type = new Type();

        $type->setTypeName($data['type_name']);
        $type->setPricingCategory($pricing_category);

        $this->type_repository->save($type, true);

        return $this->json($type);
    }

    #[Route('/type/{id}', name: 'app_delete_type', methods: ['DELETE'])]
    public function deleteType(int $id): Response
    {
        $type = $this->type_repository->findById($id);

        $this->type_repository->remove($type, true);

        return $this->json($type);
    }

    #[Route('/type/all', name: 'app_all_types', methods:['GET'])]
    public function getAllTypes(): Response
    {
        return $this->json($this->type_repository->findAllTypes());
    }

    #[Route('/type/{id}', name: 'app_edit_type', methods: ['PUT'])]
    public function editType(int $id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $type_name = $data['type_name'];
        $pricing_category = $this->pricing_category_repository->findById($data['pricing_category']);

        $type = $this->type_repository->findById($id);

        // Setting new values
        !$type_name        ?: $type->setTypeName($type_name);
        !$pricing_category ?: $type->setPricingCategory($pricing_category);

        $this->type_repository->save($type, true);

        return $this->json($type);
    }
}
