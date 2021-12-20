<?php

namespace App\Http\Controllers\Admin;

use App\Components\GoogleClient;
use App\Models\GetData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class UserController extends Controller
{
    protected $client;

    public function __construct(GetData $val, GoogleClient $client)
    {
        $this->val = $val;
        $this->client = $client->getClient();
    }
    public function Index()
    {
        $number = $this->val->getContact();
        $user =  DB::table('users as u')
            ->where('u.role', '!=', '1')
            ->select('*')
            ->paginate(10);

        $count = DB::table('users')
            ->where('role', '!=', '1')->count();
        return view('Admin.User.User', ['user' => $user, 'count' => $count, 'number' => $number]);
    }

 
    public function EditRole(Request $request)
    {
        DB::table('users')->where('id', $request->id)
        ->update([
            'role' => 1,
            'updated_at' => Date::now()
        ]);
        Alert::success('Quyền truy cập đã được thay đổi');
        return redirect()->back();
    }

    public function AccountAdmin()
    {
        $number = $this->val->getContact();
        $admin =  DB::table('users')
        ->where('id', '!=', Auth::user()->id)
            ->where('role', '=', '1')
            ->select('*')
            ->paginate(10);

        $count = DB::table('users')
        ->where('id', '!=', Auth::user()->id)
            ->where('role', '=', '1')->count();
        return view('Admin.User.AccountAdmin', ['admin' => $admin, 'count' => $count, 'number' => $number]);
    }
 
    public function DeleteRole(Request $request)
    {
        DB::table('users')->where('id', $request->id)
        ->update([
            'role' => 0,
            'updated_at' => Date::now()
        ]);
        Alert::success('Quyền truy cập đã được thay đổi');
        return redirect()->back();
    }
}
