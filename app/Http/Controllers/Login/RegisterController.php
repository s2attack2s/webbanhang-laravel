<?php

namespace App\Http\Controllers\Login;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as RoutingController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends RoutingController
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
            return view('Login.Register');
        
    }
    public function Register(Request $request)
    {
        $dataRe = DB::table('users')
            ->where('email', $request->email)
            ->select('email')->first();
        if (empty($dataRe)) {
            $data = $request->all();
            $data['password'] = Hash::make($request->password);
            User::create($data);
            return redirect()->route('Login');
        } else {
            return Redirect::back()->withErrors(['msg' => 'Email đã tồn tại']);
        }
    }
}
