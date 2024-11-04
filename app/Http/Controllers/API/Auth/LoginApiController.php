<?php

namespace App\Http\Controllers\API\Auth;

use App\Services\LoginService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use App\Http\Controllers\API\BaseController;

class LoginApiController extends BaseController
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;

    }

    public function index() {
        return view('auth.login');
    }

public function login(LoginRequest $request): JsonResponse
    {
        $result = $this->loginService->attempt($request->validated());

        if ($result['success']) {
            return response()->json([
                'success' => true,
                'message' => $result['message'],
                'token' => $result['token'] ?? null,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => $result['message'],
            ], 401);
        }
    }
}
