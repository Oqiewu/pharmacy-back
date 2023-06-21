<?php

namespace App\Services;

use Symfony\Component\Security\Core\User\UserInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

class AccessToken
{
    public function __construct(
        private JWTTokenManagerInterface $JWTManager
    ) {}
    
    // Generate JWT Token
    public function getTokenUser(UserInterface $user): array
    {
        return ['access_token' => $this->JWTManager->create($user)];
    }
}