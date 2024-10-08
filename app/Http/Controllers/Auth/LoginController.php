<?php

namespace App\Http\Controllers\Auth;

use App\Services\LoginService;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class LoginController extends Controller
{
    private $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;

    }

    public function index() {
        return view('auth.login');
    }

    public function login(LoginRequest $request) : RedirectResponse
    {
        $result = $this->loginService->attempt($request->validated());

        if ($result['success']) {
            notify()->success($result['message']);
        } else {
            notify()->error($result['message']);
        }

        return redirect()->route($result['redirect']);
    }
}
