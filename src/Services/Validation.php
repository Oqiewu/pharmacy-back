<?php

namespace App\Services;

class Validation
{
    // Validation by phone
    public function validationToPhone($entity): bool
    {
        $phone_pattern = "^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$^";

        return preg_match($phone_pattern, $entity->getPhone());
    }
    
    // Validation by email
    public function validationToEmail($entity): bool
    {
        return filter_var($entity->getUserIdentifier(), FILTER_VALIDATE_EMAIL);
    }
}