<?php

namespace App\Services;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\app\Repositories\UserRepository;

class RegistrationService
{
    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function attempts(array $credentials)
    {
        $username = $this->userRepository->findByEmail($credentials['username']);
        if ($username) {
            notify()->error('This username is already taken!');
            return redirect()->route('register')->withInput($credentials);
        }

        $storedData = $this->storeData($credentials);
        return response()->json($storedData, 200);
    }

    function storeData(array $data)
    {
        $uuid = Str::uuid();

        $storedData = DB::table('users')->insert([
            'uuid' => $uuid,
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'created_by' => $data['email'],
        ]);
        return $storedData;
    }
}
