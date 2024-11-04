<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\app\Repositories\UserRepository;

class LoginService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function attempt(array $credentials): array
    {
        $user = $this->userRepository->findByEmail($credentials['email']);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'No user found with that email.',
            ];
        }

        if (Hash::check($credentials['password'], $user->password)) {
            Auth::loginUsingId($user->id);
            $token = $user->createToken('API Token')->plainTextToken;

            return [
                'success' => true,
                'message' => "{$user->username}, welcome to Barta!",
                'token' => $token, 
            ];
        }

        return [
            'success' => false,
            'message' => 'Incorrect password.',
        ];
    }
}
