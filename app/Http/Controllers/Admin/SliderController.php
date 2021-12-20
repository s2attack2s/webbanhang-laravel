<?php

namespace App\Http\Controllers\Admin;

use App\Components\GoogleClient;
use App\Models\GetData;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use RealRashid\SweetAlert\Facades\Alert;

class SliderController extends Controller
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

        $slider = DB::table('sliders')
            ->select('*')
            ->orderByDesc('created_at')
            ->orderByDesc('updated_at')
            ->paginate(12);
        $count = DB::table('sliders')->count();
        return view('Admin.Slider.Slider', ['slider' => $slider, 'count' => $count, 'number' => $number]);
    }

    public function ViewAddSlider()
    {
        $number = $this->val->getContact();
        $data = null;
        return view('Admin.Slider.SliderDetails', ['data' => $data, 'number' => $number]);
    }
    public function ViewEditSlider(Request $request)
    {
        $number = $this->val->getCount();
        $data = DB::table('sliders')
            ->where('id', $request->id)
            ->first();
        return view('Admin.Slider.SliderDetails', ['data' => $data, 'number' => $number]);
    }
    private function getImageID($image)
    {
        $driveService = new \Google_Service_Drive($this->client);

        try {
            $fileMetadata = new \Google_Service_Drive_DriveFile([
                'name' => 'slider-' . time() . '.' . $image->getClientOriginalExtension(),
                'parents' => array('1frJXun7094gfiiDt6okS7Ii7LtqKI_Tw')
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
    public function AddSlider(Request $request)
    {


            Slider::create(array_merge($request->all(), [
                'img' => $this->getImageID($request->file('img')),
            ]));
   
        Alert::success('Thêm mới thành công');
        return redirect()->back();
    }

    public function UpdateSlider(Request $request)
    {
     
            $driveService = new \Google_Service_Drive($this->client);
            $url = DB::table('sliders')->where('id', $request->id)->first();
            $driveService->files->delete($url->img);
            DB::table('sliders')
                ->where('id', $request->id)
                ->update([
                    'img' => $this->getImageID($request->file('img')),
                    'updated_at' => Date::now(),
                ]);

        Alert::success('Cập nhật thành công');
        return redirect()->back();
    }

    public function Delete(Request $request)
    {
        $driveService = new \Google_Service_Drive($this->client);
        $url = DB::table('sliders')->where('id', $request->id)->first();
        $driveService->files->delete($url->img);
        DB::table('sliders')->where('id', $request->id)->delete();

        Alert::success('Xóa thành công');
        return redirect()->back();
    }
    public function Deletes(Request $request)
    {
        $ids = $request->ids;
        $dataPath = DB::table('sliders')->whereIn('id', $ids)->get()->toArray();
        foreach ($dataPath as $url) {
            $driveService = new \Google_Service_Drive($this->client);
            $driveService->files->delete($url->img);
        }
        DB::table('sliders')->whereIn('id', $ids)->delete();
        Alert::success('Xóa thành công');
        return redirect()->back();
    }
}
