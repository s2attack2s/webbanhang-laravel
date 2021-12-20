<?php

namespace App\Http\Controllers\Admin;

use App\Components\GoogleClient;
use App\Models\GetData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class OrderController extends Controller
{
    protected $client;

    public function __construct(GetData $val, GoogleClient $client)
    {
        $this->val = $val;
        $this->client = $client->getClient();
    }
    public function ViewOrderDestroy()
    {
        $number = $this->val->getContact();
        $order =  DB::table('transactions as t')
            ->join('orders as o', 't.id', 'o.transaction_id')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('products as p', 'p.id', 'o.product_id')
            ->where('o.status', '=', 2)
            ->select('o.quantity', 'p.name', 'u.name as nameUser', 'o.quantity', 'o.updated_at')
            ->paginate(15);

        $count =  DB::table('transactions as t')
            ->join('orders as o', 't.id', 'o.transaction_id')
            ->join('users as u', 'u.id', 't.user_id')
            ->join('products as p', 'p.id', 'o.product_id')
            ->where('o.status', '=', 2)
            ->count();

        return view('Admin.Order.OrderDestroy', ['number' => $number, 'order' => $order, 'count' => $count]);
    }

    public function ViewOrderConfirm()
    {
        $number = $this->val->getContact();
        $order =  DB::table('transactions as t')
            ->where('t.status', '=', 0)
            ->select('t.name', 't.quantity', 't.address', 't.total', 't.created_at', 't.phone', 't.id')
            ->paginate(15);

        $count = DB::table('transactions as t')
            ->where('t.status', '=', 0)
            ->count();

        return view('Admin.Order.OrderConfirm', ['number' => $number, 'order' => $order, 'count' => $count]);
    }

    public function ViewOrderDelivery()
    {
        $number = $this->val->getContact();
        $order =  DB::table('transactions as t')
            ->where('t.status', '=', 1)
            ->select('t.name', 't.quantity', 't.address', 't.total', 't.created_at', 't.phone', 't.id')
            ->paginate(15);

        $count = DB::table('transactions as t')
            ->where('t.status', '=', 1)
            ->count();

        return view('Admin.Order.OrderDelivery', ['number' => $number, 'order' => $order, 'count' => $count]);
    }

    public function ViewOrderOk()
    {
        $number = $this->val->getContact();
        $order =  DB::table('transactions as t')
            ->where('t.status', '=', 3)
            ->select('t.name', 't.quantity', 't.address', 't.total', 't.created_at', 't.phone', 't.id')
            ->paginate(15);

        $count = DB::table('transactions as t')
            ->where('t.status', '=', 3)
            ->count();

        return view('Admin.Order.OrderOk', ['number' => $number, 'order' => $order, 'count' => $count]);
    }

    public function getOrderConfirm(Request $request, $id)
    {
        if ($request->ajax()) {
            $data =   DB::table('orders as o')
                ->join('products as p', 'p.id', 'o.product_id')
                ->join('transactions as t', 't.id', 'o.transaction_id')
                ->where('o.transaction_id', $id)
                ->where('o.status', '=', 0)
                ->select('o.quantity', 'o.total', 'p.name', 't.phone', 't.message', 't.name as nameUser', 't.status', 't.total as tTotal', 'p.img', 't.status', 'o.id', 'o.transaction_id')
                ->get()->toArray();
            return view('Admin.Order.Search', ['data' => $data]);
        }
    }


    public function getOrderDelivery(Request $request, $id)
    {
        if ($request->ajax()) {
            $data =  DB::table('orders as o')
                ->join('products as p', 'p.id', 'o.product_id')
                ->join('transactions as t', 't.id', 'o.transaction_id')
                ->where('o.transaction_id', $id)
                ->where('o.status', '=', 1)
                ->select('o.quantity', 'o.total', 'p.name', 't.phone', 't.message', 't.name as nameUser', 't.status', 't.total as tTotal', 'p.img', 'o.id', 'o.transaction_id')
                ->get()->toArray();
            return view('Admin.Order.Search', ['data' => $data]);
        }
    }

    public function getOrderOk(Request $request, $id)
    {
        if ($request->ajax()) {
            $data =   DB::table('orders as o')
                ->join('products as p', 'p.id', 'o.product_id')
                ->join('transactions as t', 't.id', 'o.transaction_id')
                ->where('o.transaction_id', $id)
                ->where('o.status', '=', 3)
                ->select('o.quantity', 'o.total', 'p.name', 't.phone', 't.message', 't.name as nameUser', 't.status', 't.total as tTotal', 'p.img', 'o.id', 'o.transaction_id')  ->get()->toArray();
            return view('Admin.Order.Search', ['data' => $data]);
        }
    }

    public function DeleteOrder(Request $request)
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

        if ($quan->quantity - $data->quantity != 0) {
            DB::table('transactions')
                ->where('id', $data->transaction_id)
                ->update([
                    'quantity' => $quan->quantity - $data->quantity,
                    'updated_at' => Date::now(),
                ]);
        } else {
            DB::table('transactions')
                ->where('id', $data->transaction_id)
                ->update([
                    'status' => 2,
                    'quantity' => $quan->quantity - $data->quantity,
                    'updated_at' => Date::now(),
                ]);
        }

        DB::table('orders')
            ->where('id', $request->id)
            ->update([
                'status' => 2,
                'updated_at' => Date::now()
            ]);
        Alert::success("Hủy thành công");
        return redirect()->route('OrderConfirm');
    }

    public function ConfirmOrder(Request $request)
    {
        $ids = $request->ids;
        $transactionId = $request->transaction_id;
        DB::table('orders')
            ->whereIn('id', $ids)
            ->select('transaction_id', 'status')
            ->update([
                'status' => 1,
                'updated_at' => Date::now()
            ]);


        $check = DB::table('orders')
            ->where('transaction_id', $transactionId)
            ->where('status', '=', 0)
            ->get()->toArray();
        if (empty($check)) {
            DB::table('transactions')
                ->where('id', $transactionId)
                ->update([
                    'status' => 1,
                    'updated_at' => Date::now()
                ]);
        }
    }
    public function DeliveryOrder(Request $request)
    {
        $ids = $request->ids;
        $transactionId = $request->transaction_id;
        DB::table('orders')
            ->whereIn('id', $ids)
            ->select('transaction_id', 'status')
            ->update([
                'status' => 3,
                'updated_at' => Date::now()
            ]);


        DB::table('transactions')
            ->where('id', $transactionId)
            ->update([
                'status' => 3,
                'updated_at' => Date::now()
            ]);
    }
}
