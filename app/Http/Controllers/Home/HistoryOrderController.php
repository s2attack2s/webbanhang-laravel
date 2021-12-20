<?php

namespace App\Http\Controllers\Home;

use App\Models\GetData;
use App\Models\Transaction;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class HistoryOrderController extends Controller
{

    public function __construct(GetData $val)
    {
        $this->val = $val;
    }

    public function Index()
    {
        $partner = $this->val->GetPartner();
        $footer = $this->val->GetFooter();
        $category = $this->val->GetCategory();
        $quantityCart = $this->val->GetCart();

        $dataAll = DB::table('orders as o')
            ->join('transactions as t', 'o.transaction_id', 't.id')
            ->join('products as p', 'p.id', 'o.product_id')
            ->where('t.user_id', Auth::user()->id)
            ->orderByDesc('t.created_at')
            ->select('t.total as tTotal', 't.status as tStatus', 'o.quantity as oQuantity','o.status as oStatus' ,'o.total as oTotal', 'o.id', 'o.created_at as oCre', 'p.name', 'p.img')
            ->get()->toArray();

        $dataConfirm = DB::table('orders as o')
            ->join('transactions as t', 'o.transaction_id', 't.id')
            ->join('products as p', 'p.id', 'o.product_id')
            ->where('t.user_id', Auth::user()->id)
            ->where('t.status', '=', 0)
            ->where('o.status', '=', 0)
            ->orderByDesc('t.created_at')
            ->select('t.total as tTotal', 't.status as tStatus', 'o.quantity as oQuantity', 'o.total as oTotal','o.status as oStatus', 'o.id', 'o.created_at as oCre', 'p.name', 'p.img')
            ->get()->toArray();

        $dataDe = DB::table('orders as o')
            ->join('transactions as t', 'o.transaction_id', 't.id')
            ->join('products as p', 'p.id', 'o.product_id')
            ->where('t.user_id', Auth::user()->id)
            ->where('t.status', '=', 1)
            ->orderByDesc('t.created_at')
            ->select('t.total as tTotal', 't.status as tStatus', 'o.quantity as oQuantity', 'o.total as oTotal', 'o.id', 'o.created_at as oCre', 'p.name', 'p.img')
            ->get()->toArray();

        $dataOk = DB::table('orders as o')
            ->join('transactions as t', 'o.transaction_id', 't.id')
            ->join('products as p', 'p.id', 'o.product_id')
            ->where('t.user_id', Auth::user()->id)
            ->where('t.status', '=', 3)
            ->orderByDesc('t.created_at')
            ->select('t.total as tTotal', 't.status as tStatus', 'o.quantity as oQuantity', 'o.total as oTotal', 'o.id', 'o.created_at as oCre', 'p.name', 'p.img')
            ->get()->toArray();

        $dataDestroy = DB::table('orders as o')
            ->join('transactions as t', 'o.transaction_id', 't.id')
            ->join('products as p', 'p.id', 'o.product_id')
            ->where('t.user_id', Auth::user()->id)
            ->where('o.status', '=', 2)
            ->orderByDesc('t.created_at')
            ->select('t.total as tTotal', 't.status as tStatus', 'o.quantity as oQuantity', 'o.total as oTotal', 'o.id', 'o.created_at as oCre', 'p.name', 'p.img')
            ->get()->toArray();



        return view('Home.HistoryOrder', [
            'partner' => $partner, 'footer' => $footer,
            'category' => $category, 'dataAll' => $dataAll,
            'quantityCart' => $quantityCart, 'dataConfirm' => $dataConfirm,
            'dataDe' => $dataDe, 'dataOk' => $dataOk,
            'dataDestroy' => $dataDestroy

        ]);
    }

    public function DestroyOrder(Request $request)
    {
        $data = DB::table('orders')
            ->where('id', $request->id)
            ->select('transaction_id', 'quantity')
            ->first();

          $quan =  DB::table('transactions')
            ->where('id', $data->transaction_id)
            ->select('quantity')
            ->first();

        DB::table('transactions')
            ->where('id', $data->transaction_id)
            ->update([
                'quantity' => $quan->quantity - $data->quantity,
                'updated_at' => Date::now(),
            ]);

        DB::table('orders')
            ->where('id', $request->id)
            ->update([
                'status' => 2,
                'updated_at' => Date::now()
            ]);
        Alert::success('Hủy thành công');
        return redirect()->back();
    }
}
