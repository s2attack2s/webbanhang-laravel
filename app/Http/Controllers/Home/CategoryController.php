<?php

namespace App\Http\Controllers\Home;

use App\Models\GetData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class CategoryController extends BaseController
{
    public function __construct(GetData $val)
    {
        $this->val = $val;
    }

    public function SearchCategory(Request $request)
    {
        $partner = $this->val->GetPartner();
        $footer = $this->val->GetFooter();
        $category = $this->val->GetCategory();
        $quantityCart = $this->val->GetCart();
        $categoryDetail = DB::table('categorys')
            ->where('id', $request->id)
            ->select('*')
            ->first();

        $product = DB::table('categorys as ca')
            ->leftJoin('products as pro', 'ca.id', 'pro.categoryId')
            ->where('ca.id', $request->id)
            ->where('pro.quantity','>', 0)
            ->select('pro.id', 'pro.name', 'pro.img', 'pro.price', 'pro.quantity', 'pro.description')
            ->paginate(12);

        return view('Home.CategoryProduct', [
            'partner' => $partner, 'footer' => $footer,
            'category' => $category, 'categoryDetail' => $categoryDetail,
            'product' => $product, 'quantityCart' => $quantityCart

        ]);
    }
    public function FilterCategory(Request $request)
    {
        $partner = $this->val->GetPartner();
        $footer = $this->val->GetFooter();
        $category = $this->val->GetCategory();
        $quantityCart = $this->val->GetCart();
        $priceForm = $request->priceForm;
        $priceTo = $request->priceTo;
        $categoryId = $request->categoryId;

        $product = DB::table('products as pro')
            ->whereBetween('pro.price', [$priceForm, $priceTo])
            ->leftJoin('categorys as ca', 'ca.id', 'pro.categoryId')
            ->where('pro.categoryId', $categoryId)
            ->where('pro.quantity','>', 0)
            ->select('pro.id', 'pro.name', 'pro.img', 'pro.price', 'pro.quantity', 'pro.description')
            ->paginate(12);

        $categoryDetail = DB::table('categorys')
            ->where('id', $categoryId)
            ->select('*')
            ->first();

        return view('Home.CategoryProduct', [
            'partner' => $partner, 'footer' => $footer,
            'category' => $category, 'product' => $product,
            'categoryDetail' => $categoryDetail, 'quantityCart' => $quantityCart
        ]);
    }
}
