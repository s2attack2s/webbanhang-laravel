<?php

namespace App\Http\Controllers\Home;

use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\Models\GetData;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class SearchController extends Controller
{

    public function __construct(GetData $val)
    {
        $this->val = $val;
    }

    /**
     * Ajax - Search Job
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function SearchProduct(Request $request)
    {
        $partner = $this->val->GetPartner();
        $footer = $this->val->GetFooter();
        $category = $this->val->GetCategory();
        $quantityCart = $this->val->GetCart();
        
        $name = $request->name;
        $product = DB::table('products')
            ->where('name', 'like', '%' . $name . '%')
            ->where('quantity','>', 0)
            ->select('*')
            ->paginate(12);

        return view('Home.SearchProduct', [
            'partner' => $partner, 'footer' => $footer,
            'category' => $category, 'product' => $product,
            'name' => $name,'quantityCart' => $quantityCart
        ]);
    }
}
