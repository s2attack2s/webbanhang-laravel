<?php

namespace App\Http\Controllers\Admin;

use App\Components\GoogleClient;
use App\Models\GetData;
use App\Models\Partner;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class PartnersController extends Controller
{

    protected $client;

    public function __construct(GetData $val, GoogleClient $client)
    {
        $this->val = $val;
        $this->client = $client->getClient();
    }

    public function Index()
    { $number = $this->val->getContact();
        $partners = DB::table('partners')
            ->select('*')
            ->orderByDesc('created_at')
            ->orderByDesc('updated_at')
            ->paginate(12);
        $count = DB::table('partners')->count();
        return view('Admin.Partners.Partners', ['partners' => $partners, 'count' => $count, 'number' => $number]);
    }

    public function ViewAddPartners()
    { $number = $this->val->getContact();
        $data = null;
        return view('Admin.Partners.PartnersDetails', ['data' => $data, 'number' => $number]);
    }
    public function ViewEditPartners(Request $request)
    {
        $number = $this->val->getContact();
        $data = DB::table('partners')
            ->where('id', $request->id)
            ->first();
        return view('Admin.Partners.PartnersDetails', ['data' => $data, 'number' => $number]);
    }
    private function getImageID($image)
    {
        $driveService = new \Google_Service_Drive($this->client);

        try {
            $fileMetadata = new \Google_Service_Drive_DriveFile([
                'name' => 'partners-' . time() . '.' . $image->getClientOriginalExtension(),
                'parents' => array('1SkEjwJ6NBu6_rMockpd194h59KNHnZfF')
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
    public function AddPartners(Request $request)
    {

        $data = DB::table('partners')
            ->where('name', $request->name)->first();
        if (empty($data)) {
            Partner::create(array_merge($request->all(), [
                'img' => $this->getImageID($request->file('img')),
            ]));
        } else {
            return Redirect::back()->withErrors(['msg' => 'Đối tác đã có']);
        }
        Alert::success('Thêm mới thành công');
        return redirect()->back();
    }

    public function UpdatePartners(Request $request)
    {
        $data = DB::table('partners')
            ->where('name', $request->name)->first();
        if (empty($data)) {
            $driveService = new \Google_Service_Drive($this->client);
            $url = DB::table('partners')->where('id', $request->id)->first();
            $driveService->files->delete($url->img);
            DB::table('partners')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'img' => $this->getImageID($request->file('img')),
                    'updated_at' => Date::now(),
                ]);
        } else {
            return Redirect::back()->withErrors(['msg' => 'Đối tác đã có']);
        }
        Alert::success('Cập nhật thành công');
        return redirect()->back();
    }

    public function Delete(Request $request)
    {
        $driveService = new \Google_Service_Drive($this->client);
        $url = DB::table('partners')->where('id', $request->id)->first();
        $driveService->files->delete($url->img);
        DB::table('partners')->where('id', $request->id)->delete();

        Alert::success('Xóa thành công');
        return redirect()->back();
    }
    public function Deletes(Request $request)
    {
        $ids = $request->ids;
        $dataPath = DB::table('partners')->whereIn('id', $ids)->get()->toArray();
        foreach ($dataPath as $url) {
            $driveService = new \Google_Service_Drive($this->client);
            $driveService->files->delete($url->img);
        }
        DB::table('partners')->whereIn('id', $ids)->delete();
        Alert::success('Xóa thành công');
        return redirect()->back();
    }
}
