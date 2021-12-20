<?php

namespace App\Http\Controllers\Admin;

use App\Components\GoogleClient;
use App\Models\GetData;
use App\Models\Footer;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class InfoController extends Controller
{

    protected $client;

    public function __construct(GetData $val, GoogleClient $client)
    {
        $this->val = $val;
        $this->client = $client->getClient();
    }

    public function Index()
    { $number = $this->val->getContact();
        $footer = DB::table('footers')
            ->select('*')
         ->get()->toArray();
        return view('Admin.Info.Info', ['footer' => $footer, 'number' => $number]);
    }

    public function ViewAddInfo()
    { $number = $this->val->getContact();
        $count = DB::table('footers')->count();
        if($count){
            Alert::warning('Thông tin đã có, nếu muốn thay đổi vui lòng cập nhật');
            return redirect()->route('InfoAdmin');
        }else{
            $data = null;
            return view('Admin.Info.InfoDetails', ['data' => $data, 'number' => $number]);
        }
      
    }
    public function ViewEditInfo(Request $request)
    { $number = $this->val->getContact();
        $data = DB::table('footers')
            ->where('id', $request->id)
            ->first();
        return view('Admin.Info.InfoDetails', ['data' => $data, 'number' => $number]);
    }
    private function getImageID($image)
    {
        $driveService = new \Google_Service_Drive($this->client);

        try {
            $fileMetadata = new \Google_Service_Drive_DriveFile([
                'name' => 'Info-' . time() . '.' . $image->getClientOriginalExtension(),
                'parents' => array('1BouZjr1Mcr5LECn-N-dmWgeIv-UDjg73')
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
    public function AddInfo(Request $request)
    {
            Footer::create(array_merge($request->all(), [
                'img' => $this->getImageID($request->file('img')),
            ]));
   
        Alert::success('Thêm mới thành công');
        return redirect()->route('InfoAdmin');
    }

    public function UpdateInfo(Request $request)
    {
     
            $driveService = new \Google_Service_Drive($this->client);
            $url = DB::table('Infos')->where('id', $request->id)->first();
            $driveService->files->delete($url->img);
            DB::table('footers')
                ->where('id', $request->id)
                ->update([
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'facebook' => $request->facebook,
                    'img' => $this->getImageID($request->file('img')),
                    'updated_at' => Date::now(),
                ]);

        Alert::success('Cập nhật thành công');
        return redirect()->back();
    }

    public function Delete(Request $request)
    {
        $driveService = new \Google_Service_Drive($this->client);
        $url = DB::table('footers')->where('id', $request->id)->first();
        $driveService->files->delete($url->img);
        DB::table('footers')->where('id', $request->id)->delete();

        Alert::success('Xóa thành công');
        return redirect()->back();
    }
    public function Deletes(Request $request)
    {
        $ids = $request->ids;
        $dataPath = DB::table('footers')->whereIn('id', $ids)->get()->toArray();
        foreach ($dataPath as $url) {
            $driveService = new \Google_Service_Drive($this->client);
            $driveService->files->delete($url->img);
        }
        DB::table('footers')->whereIn('id', $ids)->delete();
        Alert::success('Xóa thành công');
        return redirect()->back();
    }
}
