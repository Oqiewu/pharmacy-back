<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\ClientType;
use App\Repository\ClientTypeRepository;
use Symfony\Component\Serializer\SerializerInterface;


class ClientTypeController extends AbstractController
{
    public function __construct(
        private SerializerInterface $serializer,
        private ClientTypeRepository $client_type_repository
    ) {}

    #[Route('clienttype', name: 'app_client_type_add', methods: ['POST'])]
    public function addClientType(Request $request): Response
    {
        $client_type = $this->serializer->deserialize($request->getContent(), ClientType::class, 'json');

        $this->client_type_repository->save($client_type, true);

        return $this->json($client_type);
    }

    #[Route('clienttype/{id}', name: 'app_client_type_remove', methods: ['DELETE'])]
    public function removeClientType(int $id): Response
    {
        $client_type = $this->client_type_repository->findById($id);

        $this->client_type_repository->remove($client_type);

        return $this->json($client_type);
    }

    #[Route('/clienttype/all', name: 'all_client_types', methods:['GET'])]
    public function getAllClients(): Response
    {
        return $this->json($this->client_type_repository->findAllClients());
    }

    #[Route('/clienttype/{id}', name: 'app_edit_client_type', methods: ['PUT'])]
    public function editClientType(int $id, Request $request): Response
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), ClientType::class, 'json');

        // Getting new values
        $client_type_name = $editable_data->getClientTypeName();

        $client_type = $this->client_type_repository->findById($id);

        // Setting new values
        !$client_type_name ?: $client_type->setClientTypeName($client_type_name);

        $this->client_type_repository->save($client_type, true);

        return $this->json($client_type);
    }
}
