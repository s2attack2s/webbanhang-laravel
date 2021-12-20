<?php

namespace App\Http\Controllers\Admin;

use App\Components\GoogleClient;
use App\Models\GetData;
use App\Models\contact;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class ContactController extends Controller
{

    protected $client;

    public function __construct(GetData $val, GoogleClient $client)
    {
        $this->val = $val;
        $this->client = $client->getClient();
    }

    public function Index()
    {
        $number = $this->val->getContact();
        $contact = DB::table('contacts')
            ->select('*')
            ->orderByDesc('created_at')
            ->get()->toArray();
        return view('Admin.Contact.Contact', ['contact' => $contact, 'number' => $number]);
    }

    public function ReadContact(Request $request)
    {
        $number = $this->val->getContact();
        $contact = DB::table('contacts')
            ->where('id', $request->id)
            ->select('*')
            ->first();
            DB::table('contacts')
                ->where('id', $request->id)
                ->update([
                    'status' => 1,
                    'updated_at' => Date::now()
                ]);
            return view('Admin.Contact.ContactDetails', ['contact' => $contact, 'number' => $number]);
  
    }
}
