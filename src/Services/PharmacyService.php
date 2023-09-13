<?php

namespace App\Services;

use App\Entity\Pharmacy;
use App\Repository\PharmacyRepository;

class PharmacyService
{
    public function __construct(
        private PharmacyRepository $pharmacy_repository 
    ) {}
    public function get_number_of_pharmacies()
    {
        $pharmacies = $this->pharmacy_repository->findAll();
        $number = 0;

        $pharmacies = (array) $pharmacies;

        foreach ($pharmacies as $p)
        {
            $number++;
        }
        
        return $number;
    }
}