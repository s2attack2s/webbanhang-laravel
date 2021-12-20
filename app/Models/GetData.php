<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GetData extends Model
{
    public function GetPartner()
    {
        $partner = DB::table('partners')
            ->select('*')->orderByDesc('created_at')
            ->orderByDesc('updated_at')
            ->get()->toArray();
        return $partner;
    }

    public function GetFooter()
    {
        $footer = DB::table('footers')
            ->select('*')
            ->orderByDesc('created_at')
            ->orderByDesc('updated_at')
            ->first();
        return $footer;
    }

    public function GetCategory()
    {
        $category = DB::table('categorys')
            ->select('*')
            ->orderByDesc('created_at')
            ->orderByDesc('updated_at')
            ->get()->toArray();
        return $category;
    }
    public function GetSlider()
    {
        $slider = DB::table('sliders')
            ->select('img')
            ->orderByDesc('created_at')
            ->orderByDesc('updated_at')
            ->get()->toArray();
        return $slider;
    }
    public function GetProduct()
    {
        $product = DB::table('products')
        ->where('quantity','>', 0)
            ->select('*')
            ->orderByDesc('created_at')
            ->orderByDesc('updated_at')
            ->paginate(12);
        return $product;
    }
    public function GetProductNew(){
        $productNew = DB::table('products')
        ->select('*')
        ->where('quantity','>', 0)
        ->orderByDesc('created_at')
        ->orderByDesc('updated_at')
        ->simplePaginate(3);
        
        return $productNew;
    }
    
public function GetContact(){
   $countContacts = DB::table('contacts')
    ->where('status', '=', 0)
    ->count();
    return $countContacts;
}

    public function GetCart()
    {
        $cart = Session::get('cart');
        $quantity = null;
        if ($cart) {
            $mang_id = array_keys($cart); // lấy danh sách id sản phẩm để lấy thông tin chi tiết sản phẩm trong giỏ hàng
            // lấy ds sản phẩm trong giỏ hàng
            $listSP = DB::table('products')->whereIn('id', $mang_id)->get();
            foreach ($listSP as $listSPs) {
                $quantity += $cart[$listSPs->id];
            }
            return $quantity;
        }
    }
}
