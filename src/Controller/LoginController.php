<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Repository\UserRepository;
use App\Entity\User;
use App\Services\AccessToken;

class LoginController extends AbstractController
{
    public function __construct(
        private UserRepository $user_repository,
        private AccessToken $access_token,
        private SerializerInterface $serializer,
    ) {}

    // Login
    #[Route('/login', name: 'app_login', methods: ['POST'])]
    public function loginUser(Request $request): Response
    {
        // Login Assembly
        $user_request = $this->serializer->deserialize($request->getContent(), User::class, 'json');

        // Find user by email
        $user = $this->user_repository->findByEmail($user_request->getUserIdentifier());

        // Checking correctness password
        if (password_verify($user_request->getPassword(), $user->getPassword())) 
        {

            // Return JWT
            $access_token    = $this->access_token->getTokenUser($user);
            return $this->json($access_token);
        }
        throw new \Exception;
    }
}
