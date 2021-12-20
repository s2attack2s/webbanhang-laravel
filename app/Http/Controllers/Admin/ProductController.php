<?php

namespace App\Http\Controllers\Admin;

use App\Components\GoogleClient;
use App\Models\GetData;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
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
        $product = DB::table('products')
            ->select('*')
            ->orderByDesc('created_at')
            ->orderByDesc('updated_at')
            ->paginate(12);
        $count = DB::table('products')->count();
        return view('Admin.Product.Product', ['product' => $product, 'count' => $count, 'number' => $number]);
    }

    public function ViewAddProduct()
    {
        $number = $this->val->getContact();
        $data = null;
        $category = $this->val->GetCategory();
        return view('Admin.Product.ProductDetails', ['data' => $data, 'category' => $category, 'number' => $number]);
    }
    public function ViewEditProduct(Request $request)
    {
        $number = $this->val->getContact();
        $category = $this->val->GetCategory();
        $data = DB::table('products')
            ->where('id', $request->id)
            ->first();
        return view('Admin.Product.ProductDetails', ['data' => $data, 'category' => $category, 'number' => $number]);
    }
    private function getImageID($image)
    {
        $driveService = new \Google_Service_Drive($this->client);

        try {
            $fileMetadata = new \Google_Service_Drive_DriveFile([
                'name' => 'product-' . time() . '.' . $image->getClientOriginalExtension(),
                'parents' => array('1h6397KxtTc2N2fOr_fp3YsNQUkPQW3Oc')
            ]);
            $file = $driveService->files->create($fileMetadata, [
                'data' => file_get_contents($image->getRealPath()),
                'uploadType' => 'multipart',
                'fields' => 'id',
            ]);
            // bắt đầu phân quyền
            $driveService->getClient()->setUseBatch(true);

            try {
                $batch = $driveService->createBatch();
                $userPermission = new \Google_Service_Drive_Permission([
                    //dành cho mọi người
                    'type' => 'anyone', // user | group | domain | anyone
                    // và chỉ được quyền xem
                    'role' => 'reader', // organizer | owner | writer | commenter | reader
                ]);
                $request = $driveService->permissions->create($file->id, $userPermission, ['fields' => 'id']);
                $batch->add($request, 'user');
                $results = $batch->execute();
            } catch (\Exception $e) {
            } finally {
                $driveService->getClient()->setUseBatch(false);
            }

            return $file->id;
        } catch (\Exception $e) {
            //
        }
    }
    public function AddProduct(Request $request)
    {

        $data = DB::table('products')
            ->where('name', $request->name)->first();
        if (empty($data)) {

            Product::create(array_merge($request->all(), [
                'img' => $this->getImageID($request->file('img')),
            ]));
        } else {
            return Redirect::back()->withErrors(['msg' => 'Sản phẩm đã tồn tại']);
        }
        Alert::success('Thêm mới thành công');
        return redirect()->back();
    }

    public function UpdateProduct(Request $request)
    {
        $data = DB::table('products')
            ->where('name', $request->name)->first();
        if (empty($data)) {
            $driveService = new \Google_Service_Drive($this->client);
            $url = DB::table('products')->where('id', $request->id)->first();
            $driveService->files->delete($url->img);
            DB::table('products')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'categoryId' => $request->categoryId,
                    'price' => $request->price,
                    'quantity' => $request->quantity,
                    'description' => $request->description,
                    'img' => $this->getImageID($request->file('img')),
                    'updated_at' => Date::now(),
                ]);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Sản phẩm đã tồn tại']);
        }
        Alert::success('Cập nhật thành công');
        return redirect()->back();
    }

    public function Delete(Request $request)
    {
        $driveService = new \Google_Service_Drive($this->client);
        $url = DB::table('products')->where('id', $request->id)->first();
        $driveService->files->delete($url->img);
        DB::table('products')->where('id', $request->id)->delete();

        Alert::success('Xóa thành công');
        return redirect()->back();
    }
    public function Deletes(Request $request)
    {
        $ids = $request->ids;
        $dataPath = DB::table('products')->whereIn('id', $ids)->get()->toArray();
        foreach ($dataPath as $url) {
            $driveService = new \Google_Service_Drive($this->client);
            $driveService->files->delete($url->img);
        }
        DB::table('products')->whereIn('id', $ids)->delete();
        Alert::success('Xóa thành công');
        return redirect()->back();
    }
}
