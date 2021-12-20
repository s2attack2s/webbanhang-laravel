<?php

namespace App\Http\Controllers\Admin;

use App\Models\GetData;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class CategoryController extends Controller
{
    public function __construct(GetData $val)
    {
        $this->val = $val;
    }

    public function Index()
    { $number = $this->val->getContact();
        $category = $this->val->GetCategory();
        $count = DB::table('categorys')->count();
        return view('Admin.Category.Category', ['category' => $category, 'count' => $count, 'number' => $number]);
    }

    public function ViewAddCate()
    { $number = $this->val->getContact();
        $data = null;
        return view('Admin.Category.CategoryDetails', ['data' => $data, 'number' => $number]);
    }
    public function ViewEditCate(Request $request)
    {
        $number = $this->val->getContact();
        $data = DB::table('categorys')
            ->where('id', $request->id)
            ->first();
        return view('Admin.Category.CategoryDetails', ['data' => $data, 'number' => $number]);
    }

    public function AddCate(Request $request)
    {
        $data = DB::table('categorys')->where('name', $request->name)->first();
        if (empty($data)) {
            DB::table('categorys')->insert([
                'name' => $request->name,
                'created_at' => Date::now(),
            ]);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Danh mục đã tồn tại']);
        }
        Alert::success('Thêm mới thành công');
        return redirect()->back();
    }

    public function UpdateCate(Request $request)
    {
        $data = DB::table('categorys')
            ->where('id', '!=', $request->id)
            ->where('name', $request->name)->first();
        if (empty($data)) {
            DB::table('categorys')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'updated_at' => Date::now(),
                ]);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Danh mục đã tồn tại']);
        }
        Alert::success('Cập nhật thành công');
        return redirect()->back();
    }

    public function Delete(Request $request)
    {
        DB::table('categorys')->where('id', $request->id)->delete();
        DB::table('products')->where('categoryId', $request->id)->delete();
        Alert::success('Xóa thành công');
        return redirect()->back();
    }
    public function Deletes(Request $request)
    {
        $ids = $request->ids;
        DB::table('categorys')->whereIn('id', $ids)->delete();
        DB::table('products')->whereIn('categoryId', $ids)->delete();
        Alert::success('Xóa thành công');
        return redirect()->back();
    }
}
