<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\UserWelcomeNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function showForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials  = $request->only(['email', 'password']);
        $validator = Validator::make($credentials, [
           'email' =>  'required|email',
            'password' => 'required|min:8'
        ]);

        if ($validator->fails())
        {
            return back();
        }

        $user = User::query()->where('email', $request->email)->firstOrFail();

        if (!Hash::check($credentials['password'], $user->password))
        {
            alert()->warning('Diqqət!','E-mail və ya Şifrə yanlışdır!');
            return back();
        }

        if (Auth::attempt($credentials))
        {
            if (!$user->hasVerifiedEmail())
            {
                Auth::logout();
                alert()->warning('Diqqət!','Sayta login etmək üçün emailiniz doğrulanmalıdır!');
                return back();
            }
        }

        alert()->success('Təbriklər!','Hesaba uğurla daxil oldunuz!');
        return redirect()->intended(route('admin.index'));
    }

    public function logout()
    {
        Auth::logout();

        alert()->success('Təbriklər!','Hesabınızdan uğurla çıxış etdiniz!');
        return redirect()->route('login');
    }

}
