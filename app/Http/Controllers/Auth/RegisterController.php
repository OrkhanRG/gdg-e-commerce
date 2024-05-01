<?php

namespace App\Http\Controllers\Auth;

use App\Events\UserRegisterEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

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

//        event(new UserRegisterEvent($user));

        alert()->info('Info','E-mailinizə doğrulama maili göndərildi!');
        return back();
    }

    public function verify(Request $request)
    {
        $userID = Cache::get('verify_token_'.$request->token);

        if (!$userID)
        {
            alert()->error('Diqqət!','E-mail təsdqi müddəti dolmuşdur!');

        }

        $user = User::query()->findOrFail($userID);

        $user->email_verified_at = now();
        $user->save();

        Auth::login($user);

        alert()->success('Uğurlu!','Təbriklər! E-mailiniz təsdiq olundu!');
        return redirect()->route('admin.index');
    }
}
