<?php

namespace App\Controller;

use App\Entity\TreatyType;
use App\Repository\TreatyRepository;
use App\Repository\TreatyTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TreatyTypeController extends AbstractController
{
  
    public function __construct(
        private SerializerInterface $serializer,
        private TreatyRepository $treaty_repository,
        private TreatyTypeRepository $treaty_type_repositroy,
    ) {}

    #[Route('/treatytype', name: 'app_treaty_type_add', methods: ['POST'])]
    public function add_treaty_type(Request $request): Response
    {
        $treatytype = $this->serializer->deserialize($request->getContent(), TreatyType::class, 'json');       
        
        $data = json_decode($request->getContent(), true);

        try {
            $treaty = $this->treaty_repository->findById($data['treaty']);

            $treatytype->setTreaty($treaty);
    
            $this->treaty_type_repositroy->save($treatytype, true);

            return $this->json($treatytype);

        }
        catch (Exception $e) {
            return $this->json($e->getMessage());
        }

    }

    #[Route('/treatytype/{id}', name: 'app_treaty_type_remove', methods: ['DELETE'])]
    public function removeTreatyType(int $id): Response
    {
        $treatytype = $this->treaty_type_repositroy->findById($id);

        $this->treaty_type_repositroy->remove($treatytype);

        return $this->json($treatytype);
    }

    #[Route('/treatytype/{id}', name: 'app_edit_treaty_types', methods: ['PUT'])]
    public function edit_treaty_types(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), TreatyType::class, 'json');
       
        $data = json_decode($request->getContent(), true);

        $treaty_type_name = $editable_data->getTreatyTypeName();
        !array_key_exists('treaty', $data) ? $treaty = '' : $treaty  = $this->treaty_repository->findById($data['treaty']);

        $treatytype = $this->treaty_type_repositroy->findById($id);

        !$treaty_type_name ?: $treatytype->setTreatyTypeName($treaty_type_name);
        !$treaty           ?: $treatytype->setTreaty($treaty);

        $this->treaty_type_repositroy->save($treatytype, true);

        return $this->json($treatytype);
    }

    #[Route('/treatytype/all', name: 'all_treaty_types', methods:['GET'])]
    public function getAllTreatyTypes(): Response
    {
        return $this->json($this->treaty_type_repositroy->findAllTreatyTypes());
    }
}
