<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\ActiveSubstance;
use App\Repository\ActiveSubstanceRepository;

class ActiveSubstanceController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private ActiveSubstanceRepository $active_substance_repositroy
    ) {}

    #[Route('/substance', name: 'app_add_substance', methods:['POST'])]
    public function add_provider(Request $request): Response
    {
        $active_substance = $this->serializer->deserialize($request->getContent(), ActiveSubstance::class, 'json');

        $this->active_substance_repositroy->save($active_substance, true);

        return $this->json($active_substance);
    }

    #[Route('/substance/{id}', name: 'app_delete_substance', methods:['DELETE'])]
    public function delete_provider(int $id): Response
    {
        $active_substance = $this->active_substance_repositroy->findById($id);

        $this->active_substance_repositroy->remove($active_substance, true);

        return $this->json($active_substance);
    }

    #[Route('/substance/all', name: 'app_all_substances', methods:['GET'])]
    public function getAllActiveSubstances(): Response
    {
        return $this->json($this->active_substance_repositroy->findAllGoodsMargins());
    }

    #[Route('/substance/{id}', name: 'app_edit_substances', methods: ['PUT'])]
    public function editActiveSubstance(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), ActiveSubstance::class, 'json');


        // Getting new values
        $substance_name = $editable_data->getSubstanceName();
        
        $active_substance = $this->active_substance_repositroy->findById($id);

        // Setting new values
        !$substance_name ?: $active_substance->setSubstanceName($active_substance);

        $this->active_substance_repositroy->save($active_substance, true);

        return $this->json($active_substance);
    }
}
