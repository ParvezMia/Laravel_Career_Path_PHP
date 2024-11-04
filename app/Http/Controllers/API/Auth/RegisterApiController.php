<?php

namespace App\Http\Controllers\API\Auth;

use App\Http\Controllers\Controller;
use App\Services\RegistrationService;
use App\Http\Requests\RegistrationRequest;

class RegisterApiController extends Controller
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
            response()->json(
                [
                    'success' => true, 
                    'message' => 'Registration successful.'
                ], 200);
        } catch (\Throwable $th) {
            response()->json(
                [
                    'success' => false, 
                    'message' => 'Registration failed.'
                ], 401);
            return redirect()->route('register');
        }
    }
}
