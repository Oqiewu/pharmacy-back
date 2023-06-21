<?php

namespace App\Services;

class Password
{
    // Generate hashed password
    public function gen_hashed_password($password): string
    {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        return($hashed_password);
    }
}
