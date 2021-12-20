<?php

namespace App\Http\Controllers\Home;

use App\Models\GetData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{

    public function __construct(GetData $val)
    {
        $this->val = $val;
    }

    public function Index()
    {

        $partner = $this->val->GetPartner();
        $slider = $this->val->GetSlider();
        $footer = $this->val->GetFooter();
        $category = $this->val->GetCategory();
        $product = $this->val->GetProduct();
        $quantityCart = $this->val->GetCart();
        $productNew = $this->val->getProductNew();

        return view('Home.Index', [
            'partner' => $partner, 'footer' => $footer,
            'slider' => $slider, 'category' => $category,
            'product' => $product, 'productNew' => $productNew,
            'quantityCart' => $quantityCart,
        ]);
    }
}
