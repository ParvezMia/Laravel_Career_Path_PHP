<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileService
{

    public function updateProfile(array $validatedData, string $userEmail): bool
    {
        $updateData = [
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'bio' => $validatedData['bio'],
            'updated_by' => $userEmail,
        ];

        if (isset($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        return DB::table('users')
            ->where('email', $userEmail)
            ->update($updateData) > 0;
    }
}
