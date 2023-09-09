<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use App\Entity\User;
use App\Repository\UserRepository;
use App\Repository\OrganizationRepository;
use App\Repository\PharmacyRepository;
use App\Services\Validation;
use App\Services\Password;

class UserController extends AbstractController
{
    public function __construct(
        private UserRepository $user_repository,
        private Validation $validation,
        private SerializerInterface $serializer,
        private Password $password,
        private OrganizationRepository $organization_repository,
        private PharmacyRepository $pharmacy_repository
    ) {}

    // Add new user
    #[Route('/user', name: 'registration_user', methods:['POST'])]
    public function registrationUser(Request $request): JsonResponse
    {
        $user = $this->serializer->deserialize($request->getContent(), User::class, 'json');
        $data = json_decode($request->getContent(), true);
        if($this->validation->validationToEmail($user))
        {
            $hashed_password = $this->password->gen_hashed_password($user->getPassword());
            $organization    = $this->organization_repository->findById($data['organization']);
            $pharmacy        = $this->pharmacy_repository->findById($data['pharmacy']);

            $user
                ->setPassword($hashed_password)
                ->setOrganization($organization)
                ->setPharmacy($pharmacy);

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
        $data = json_decode($request->getContent(), true);

        // Getting new values
        $organization    = $this->organization_repository->findById($data['organization']);
        $pharmacy        = $this->pharmacy_repository->findById($data['pharmacy']);
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
        $role               = $editable_data->getRoles();
        
        if($this->validation->validationToEmail($editable_data))
        {
            $user = $this->user_repository->findById($id);

            $hashed_password = $this->password->gen_hashed_password($password);
            
            // Setting new values
            !$organization       ?: $user->setOrganization($organization);
            !$pharmacy           ?: $user->setPharmacy($pharmacy);
            !$tab_number         ?: $user->setTabNumber($tab_number);
            !$email              ?: $user->setUserIdentifier($email);
            !$password           ?: $user->setPassword($hashed_password);
            !$first_name         ?: $user->setFirstName($first_name);
            !$last_name          ?: $user->setLastName($last_name);
            !$patronymic         ?: $user->setPatronymic($patronymic);
            !$date_of_birth      ?: $user->setDateOfBirth($date_of_birth);
            !$gender             ?: $user->setGender($gender);
            !$registration_data  ?: $user->setRegistrationData($registration_data);
            !$phone              ?: $user->setPhone($phone);
            !$role               ?: $user->setRoles([$role]);
    
            $this->user_repository->save($user, true);
    
            return $this->json($user);
        } else {
            throw new \Exception;
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

    #[Route('/user/{id}', name: 'get_user_by_id', methods:['GET'])]
    public function getUserById(int $id): JsonResponse
    {
        $user = $this->user_repository->findById($id);

        return $this->json($user);
    }
}