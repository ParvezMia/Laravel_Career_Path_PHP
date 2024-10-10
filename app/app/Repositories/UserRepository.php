<?php

namespace App\app\Repositories;

use App\Models\User;

class UserRepository
{
    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
