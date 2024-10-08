<?php

namespace App\app\Repositories;

use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function findByEmail(string $email)
    {
        return DB::table('users')->where('email', $email)->first();
    }
}
