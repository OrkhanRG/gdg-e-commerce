<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showForm()
    {
        return view('auth.register');
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->only(['name', 'email', 'password']);

        $user = User::query()->create($data);

        if (!$user)
        {
            dd('error');
        }

        dd('qeydiyyat tamamlandı');
    }
}
