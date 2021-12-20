<?php

namespace App\Http\Controllers\Home;

use App\Models\GetData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ProductDetailsController extends BaseController
{
    public function __construct(GetData $val)
    {
        $this->val = $val;
    }

    public function Index(Request $request)
    {
        $partner = $this->val->GetPartner();
        $footer = $this->val->GetFooter();
        $category = $this->val->GetCategory();
        $quantityCart = $this->val->GetCart();
        $productDetail = DB::table('products')
            ->where('id', $request->id)
            ->select('*')
            ->first();

        $categoryId = $productDetail->categoryId;

        $product = DB::table('products')
            ->where('categoryId', $categoryId)
            ->where('quantity','>', 0)
            ->where('id', '!=', $request->id)
            ->select('*')
            ->paginate(10);

        return view('Home.ProductDetails', [
            'partner' => $partner, 'footer' => $footer,
            'category' => $category,'product' => $product,
            'productDetail' => $productDetail, 'quantityCart' => $quantityCart
        ]);
    }
}
