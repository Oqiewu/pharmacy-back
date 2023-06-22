<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Subtype;
use App\Repository\SubtypeRepository;
use App\Repository\TypeRepository;

class SubtypeController extends AbstractController
{
    public function __construct(
        private TypeRepository $type_repository,
        private SubtypeRepository $subtype_repository
    ) {}

    // Create new organization
    #[Route('/subtype', name: 'app_subtype', methods: ['POST'])]
    public function addSutype(Request $request): Response
    {
        $data = json_decode($request->getContent(), true);

        $type = $this->type_repository->findById($data['type']);

        $subtype = new Subtype();

        $subtype->setSubtypeName($data['subtype_name']);
        $subtype->setType($type);

        $this->subtype_repository->save($subtype, true);

        return $this->json($subtype);
    }

    #[Route('/subtype/{id}', name: 'app_delete_subtype', methods: ['DELETE'])]
    public function deleteSubtype(int $id): Response
    {
        $subtype = $this->subtype_repository->findById($id);

        $this->subtype_repository->remove($subtype, true);

        return $this->json($subtype);
    }

    #[Route('/subtype/all', name: 'app_all_subtypes', methods:['GET'])]
    public function getAllSubtypes(): Response
    {
        return $this->json($this->subtype_repository->findAllSubtypes());
    }

    #[Route('/subtype/{id}', name: 'app_edit_subtype', methods: ['PUT'])]
    public function editSubtype(int $id, Request $request): Response
    {
        $data = json_decode($request->getContent(), true);
    
        $subtype_name = $data['subtype_name'];
        $type         = $this->type_repository->findById($data['type']);

        $subtype = $this->subtype_repository->findById($id);

        // Setting new values
        !$subtype_name ?: $type->setSubtypeName($data['subtype_name']);
        !$type         ?: $type->setType($type);

        $this->type_repository->save($subtype, true);

        return $this->json($subtype);
    }
}

