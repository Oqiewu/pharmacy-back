<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\Validation;
use App\Services\Password;

class UserController extends AbstractController
{
    public function __construct(
        private UserRepository $user_repository,
        private Validation $validation,
        private SerializerInterface $serializer,
        private Password $password
    ) {}

    // Add new user
    #[Route('/user', name: 'registration_user', methods:['POST'])]
    public function registrationUser(Request $request): JsonResponse
    {
        $user = $this->serializer->deserialize($request->getContent(), User::class, 'json');
        if($this->validation->validationToEmail($user))
        {
            $hashed_password = $this->password->gen_hashed_password($user->getPassword());

            $user->setPassword($hashed_password);
            $user->setRoles(['Продавец']);

            $this->user_repository->save($user, true);

            return $this->json($user);
        }
        return $this->json($user);
    }

    // Edit selected user
    #[Route('/user/{id}', name: 'edit_user', methods:['PUT'])]
    public function editUser(int $id, Request $request): JsonResponse
    {
        $editable_data = $this->serializer->deserialize($request->getContent(), User::class, 'json');

        // Getting new values
        $organization       = $editable_data->getOrganization();
        $tab_number         = $editable_data->getTabNumber();
        $email              = $editable_data->getUserIdentifier();
        $password           = $editable_data->getPassword();
        $first_name         = $editable_data->getFirstName();
        $last_name          = $editable_data->getLastName();
        $patronymic         = $editable_data->getPatronymic();
        $date_of_birth      = $editable_data->getDateOfBirth();
        $gender             = $editable_data->getGender();
        $registration_data  = $editable_data->getRegistrationData();
        $phone              = $editable_data->getPhone();
        
        if($this->validation->validationToEmail($editable_data))
        {
            $user = $this->user_repository->findById($id);

            $hashed_password = $this->password->gen_hashed_password($password);
            
            // Setting new values
            $user
                ->setOrganization($organization)
                ->setTabNumber($tab_number)
                ->setUserIdentifier($email)
                ->setPassword($hashed_password)
                ->setFirstName($first_name)
                ->setLastName($last_name)
                ->setPatronymic($patronymic)
                ->setDateOfBirth($date_of_birth)
                ->setGender($gender)
                ->setRegistrationData($registration_data)
                ->setPhone($phone)
                ->setRoles(['Admin']);
    
            $this->user_repository->save($user, true);
    
            return $this->json($user);
        } else {
            return $this->json($editable_data);
        }   
    }

    // Delete selected user
    #[Route('/user/{id}', name: 'delete_user', methods:['DELETE'])]
    public function deleteUser(int $id): JsonResponse
    {
        $user = $this->user_repository->findById($id);

        $this->user_repository->remove($user, true);

        return $this->json($user);
    }

    // Get all users
    #[Route('/user/all', name: 'all_users', methods:['GET'])]
    public function getAllUsers(): JsonResponse
    {
        return $this->json($this->user_repository->findAllUsers());
    }
}