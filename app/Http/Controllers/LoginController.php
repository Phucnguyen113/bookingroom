<?php

namespace App\Http\Controllers;

use App\Http\Contracts\Services\SessionContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    protected $sessionService;

    public function __construct(SessionContract $sessionService)
    {
        $this->sessionService = $sessionService;
    }

    public function index()
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        if ($this->sessionService->login($request)) {
            return redirect('/tags');
        }
        return redirect()->back();
    }

    public function logout()
    {
        $this->sessionService->logout();
        return redirect('/login');
    }
}
