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

class CartController extends Controller
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
        $product = $this->val->GetProduct();
        $quantityCart = $this->val->GetCart();

        $cart = Session::get('cart');

        if ($cart) {
            $mang_id = array_keys($cart); // lấy danh sách id sản phẩm để lấy thông tin chi tiết sản phẩm trong giỏ hàng
            // lấy ds sản phẩm trong giỏ hàng
            $listSP = DB::table('products')->whereIn('id', $mang_id)->get();

            return view('Home.Cart', [
                'partner' => $partner, 'footer' => $footer,
                'category' => $category, 'product' => $product,
                'listSP' => $listSP, 'cart' => $cart,
                'quantityCart' => $quantityCart
            ]);
        } else {
            $listSP = null;
            return view('Home.Cart', [
                'partner' => $partner, 'footer' => $footer,
                'category' => $category, 'product' => $product,
                'listSP' => $listSP, 'quantityCart' => $quantityCart
            ]);
        }
    }
    public function AddCart(Request $request, $id)
    {

        if (Session::has('cart')) {
            // đã mua sản phẩm nào đó rồi, lấy thông tin cart ra một biến mảng để làm việc
            $cart = Session::get('cart');

            if (isset($cart[$id]))
                $cart[$id]++;  // đã mua sản phẩm $id rồi, tăng số lượng
            else
                $cart[$id] = 1; // chưa mua sản phẩm hiện tại

            Session::put('cart', $cart);  // gán lại vào session
        } else {
            // chưa mua bất kỳ sản phẩm nào, khởi tạo cart và gán sản phẩm đầu tiên
            Session::put('cart', [$id => 1]);
        }
    }

    public function UpdateCart(Request $request, $id)
    {
        try {
            if (Session::has('cart')) {
                $cart = Session::get('cart');

                if (isset($cart[$id])) {
                    $cart[$id] = $request->quantity;
                    Session::put('cart', $cart);
                    Alert::success('Cập nhật thành công');

                    return redirect()->route('Cart');
                }
            }
        } catch (\Exception $e) {
            dd($e);
        }
    }
    public function RemoveCart(Request $request, $id)
    {
        if (Session::has('cart')) {
            $cart = Session::get('cart');
            if (isset($cart[$id])) {
                unset($cart[$id]);
                Session::put('cart', $cart);
                Alert::success('Xóa thành công');
                return redirect()->route('Cart');
            }
        }
    }

    public function Order(Request $request)
    {
        $cart = Session::get('cart');
        $tongTien = 0;
        $soLuong = 0;
        $mang_id = array_keys($cart); // lấy danh sách id sản phẩm để lấy thông tin chi tiết sản phẩm trong giỏ hàng
        // lấy ds sản phẩm trong giỏ hàng
        $listSP = DB::table('products')->whereIn('id', $mang_id)->get();

        foreach ($listSP as $key => $listSPs) {
            $thanhTien = $listSPs->price * $cart[$listSPs->id];
            $number = $cart[$listSPs->id];
            $tongTien += $thanhTien;
            $soLuong += $number;
        }
        $data = $request->all();
        $data['status'] = 0;
        $data['total'] = $tongTien;
        $data['quantity'] = $soLuong;
        $data['user_id'] = Auth::user()->id;
        $Transaction = Transaction::create($data);

        foreach ($listSP as $key => $listSPs) {
            DB::table('orders')->insert([
                'transaction_id' => $Transaction['id'],
                'product_id' => $listSPs->id,
                'price' => $listSPs->price,
                'quantity' => $cart[$listSPs->id],
                'total' => $listSPs->price * $cart[$listSPs->id],
                'status' => 0, // đang chờ xác nhận
                'created_at' => Date::now(),
            ]);
            // $q = DB::table('products')
            //     ->where('id',  $listSPs->id)->select('quantity')->first();
            // DB::table('products')
            //     ->where('id',  $listSPs->id)
            //     ->update([
            //         'quantity' => $q->quantity - $cart[$listSPs->id],
            //         'updated_at' => Date::now(),
            //     ]);
        }
        Session::remove('cart');
        Alert::success('Đã gửi đơn hàng');
        return redirect()->route('Home');
    }
}
