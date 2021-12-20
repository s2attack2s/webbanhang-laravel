<?php

namespace App\Http\Controllers\Home;

use App\Models\GetData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class ProductController extends BaseController
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
        $product = $this->val->GetProduct();
        $quantityCart = $this->val->GetCart();

        return view('Home.Product', [
            'partner' => $partner, 'footer' => $footer,
            'category' => $category, 'product' => $product,
            'quantityCart' => $quantityCart
        ]);
    }

    public function Filter(Request $request)
    {
        $partner = $this->val->GetPartner();
        $footer = $this->val->GetFooter();
        $category = $this->val->GetCategory();
        $quantityCart = $this->val->GetCart();

        $priceForm = $request->priceForm;
        $priceTo = $request->priceTo;

        $product = DB::table('products')
            ->whereBetween('price', [$priceForm, $priceTo])
            ->where('quantity','>', 0)
            ->select('*')
            ->paginate(12);

      

        return view('Home.FilterProduct', [
            'partner' => $partner, 'footer' => $footer,
            'category' => $category, 'product' => $product,
            'quantityCart' => $quantityCart
        ]);
    }
}
