<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\RegistrationService;
use App\Http\Requests\RegistrationRequest;

class RegisterController extends Controller
{
    protected $registrationService;

    public function __construct(RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;

    }

    public function register() {
        return view('auth.register');
    }

    public function store(RegistrationRequest $request) {
        try {
            $this->registrationService->attempts($request->validated());

            notify()->success('Registration Successfully Completed!');
            return redirect()->route('login');
        } catch (\Throwable $th) {
            notify()->error('An error occurred during registration.');
            return redirect()->route('register');
        }
    }
}
