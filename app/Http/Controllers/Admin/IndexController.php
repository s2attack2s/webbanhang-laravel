<?php

namespace App\Http\Controllers\Admin;

use App\Components\GoogleClient;
use App\Models\GetData;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
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
        $moneyToday = DB::table('transactions')
            ->where('status', '=', 3)
            ->whereDate('updated_at', Carbon::now()->format('Y-m-d'))
            ->sum('total');
          
            $moneyYesterday = DB::table('transactions')
            ->where('status', '=', 3)
            ->whereDate('updated_at',  Carbon::yesterday()->format('Y-m-d'))
            ->sum('total');
            if($moneyYesterday == 0){
                $ratioMoney = ($moneyToday / 1) * 100 - 100;
            }else{
                $ratioMoney = ($moneyToday / $moneyYesterday) * 100 - 100;
            }

        $sellMonthDay = DB::table('transactions')
            ->where('status', '=', 3)
            ->whereDate('updated_at', '>=', Carbon::now()->subMonths(1)->format('Y-m-d'))
            ->sum('quantity');

            $sellLastMonth = DB::table('transactions')
            ->where('status', '=', 3)
            ->whereDate('updated_at', '>', Carbon::now()->subMonths(2)->format('Y-m-d'))
            ->whereDate('updated_at', '<', Carbon::now()->subMonths(1)->format('Y-m-d'))
            ->sum('quantity');

            if($sellLastMonth == 0){
                $ratioSell = ($sellMonthDay / 1) * 100 - 100;
            }else{
                $ratioSell = ($sellMonthDay / $sellLastMonth) * 100 - 100;
            }

        $userMonthDay = DB::table('users')
            ->where('role', '!=', 1)
            ->whereDate('created_at', '>=', Carbon::now()->subMonths(1)->format('Y-m-d'))
            ->count();

            $userLastDay = DB::table('users')
            ->where('role', '!=', 1)
            ->whereDate('created_at', '<', Carbon::now()->subMonths(1)->format('Y-m-d'))
            ->whereDate('created_at', '>', Carbon::now()->subMonths(2)->format('Y-m-d'))
            ->count();
            if($userLastDay == 0){
                $ratioUser = ($userMonthDay / 1) * 100 - 100;
            }else{
                $ratioUser = ($userMonthDay / $userLastDay) * 100 - 100;
            }

        $totalUser = DB::table('users')
            ->where('role', '!=', 1)
            ->count();


        $totalProduct = DB::table('products')
            ->where('quantity', '>', 0)
            ->count();



        return view('Admin.Index', [
            'number' => $number, 'moneyToday' => $moneyToday,
            'sellMonthDay' => $sellMonthDay, 'userMonthDay' => $userMonthDay,
            'totalUser' => $totalUser, 'totalProduct' => $totalProduct,
            'ratioMoney' => $ratioMoney, 'ratioSell' => $ratioSell,
            'ratioUser' => $ratioUser
        ]);
    }
}
