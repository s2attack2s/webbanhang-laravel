<?php

namespace App\Http\Controllers\Login;

use App\Events\Client\Chat;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function Index()
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user->role == 1) {
                return redirect()->route('HomeAdmin');
            } else {
                return redirect()->route('Home');
            }
        } else
            return view('Login.Login');
    }

    public function Login(Request $request)
    {

        $arr = [
            'email' => $request->email,
            'password' => $request->password,
        ];
        if (Auth::attempt($arr)) {
            $user = User::where('email', $request->email)->first();
            Auth::login($user);
            $user = Auth::user();
            Alert::success('Đăng nhập thành công');
            if ($user->role == 1) {
                return redirect()->route('HomeAdmin');
            } else {
                return redirect()->route('Home');
            }
       
        } else {
            return Redirect::back()->withErrors(['msg' => 'Tài khoản hoặc mật khẩu không chính xác']);
        }
    }

    public function Logout()
    {
        Auth::logout();
        return redirect()->route('Login');
    }
}
