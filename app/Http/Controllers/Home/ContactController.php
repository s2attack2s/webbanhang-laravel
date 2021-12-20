<?php

namespace App\Http\Controllers\Home;

use App\Models\Contact;
use App\Models\GetData;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
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
        return view('Home.Contact', [
            'partner' => $partner, 'footer' => $footer,
            'category' => $category, 'product' => $product,
            'quantityCart' => $quantityCart
        ]);
    }

    public function postContact(Request $request)
    {
        Contact::create($request->all());
    }
}
