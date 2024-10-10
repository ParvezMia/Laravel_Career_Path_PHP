<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileService
{

    public function updateProfile(array $validatedData, string $userEmail, $imagePath): bool
    {
        $updateData = [
            'first_name' => $validatedData['first_name'],
            'last_name' => $validatedData['last_name'],
            'bio' => $validatedData['bio'],
            'updated_by' => $userEmail,
            'user_profile_image' => $imagePath
        ];

        if (isset($validatedData['password'])) {
            $updateData['password'] = Hash::make($validatedData['password']);
        }

        return User::where('email', $userEmail)->update($updateData) > 0;
    }
}
