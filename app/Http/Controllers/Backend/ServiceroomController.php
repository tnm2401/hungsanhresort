<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Productsimage;
use ServiceRoom;
use Translation;
use Cache;
use Image;
use Validate;
use Carbon\Carbon;
use Validator;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;
use File;

class ServiceroomController extends ShareController
{
    public function index()
    {

        $servicerooms = ServiceRoom::orderBy('id','desc')->get();
        return view('backend.serviceroom.index', compact('servicerooms'));
    }
    public function create()
    {
        return view('backend.serviceroom.create');
    }

    public function edit(Request $request, $id)
    {
        $serviceroom = ServiceRoom::find($id);
        return view('backend.serviceroom.edit', compact('serviceroom'));
    }

    public function store(Request $request)
    {

        $serviceroom = new  Serviceroom();
        $serviceroom->name = $request->name ?? 'Chưa nhập tên';
        $serviceroom->unit = $request->unit ?? 'Chưa nhập đơn vị';
        $serviceroom->price = $request->price ?? 0;
        $serviceroom->quantity = $request->quantity ?? false;
        $serviceroom->order_id = $request->order_id ?? '';
        $serviceroom->save();
        return response()
        ->json(['status'=>'success']);
            // alert()->success("Thành công", "Đã thêm dịch vụ phòng !");
            // return redirect()->route('backend.serviceroom.index');
    }

    public function update(Request $request, $id)
    {
        $serviceroom = ServiceRoom::find($id);

        $serviceroom->name = $request->name ?? $serviceroom->name;
        $serviceroom->price = $request->price ?? $serviceroom->price;
        $serviceroom->unit = $request->unit ?? $serviceroom->unit;
        $serviceroom->quantity = $request->quantity ?? $serviceroom->quantity;
        $serviceroom->img  = $name_save ?? $serviceroom->img;
        $serviceroom->save();
        alert()->success("Thành công","Đã cập nhật lại dịch vụ phòng ");
        return redirect()->route('backend.serviceroom.index');
    }

    public function destroy(Request $request, $id)
    {
        $serviceroom = ServiceRoom::find($id);
        if ($serviceroom) {
            $image_path_del = public_path().'/storage/uploads/serviceroom/'.$serviceroom->img;
            if (file_exists($image_path_del) && $serviceroom->img != 'placeholder.png') {
                unlink($image_path_del);
            }
        }
            $serviceroom->delete();
            alert()->error("Thành công", "Đã xóa dịch vụ phòng !");
            return redirect()->route('backend.serviceroom.index');

    }


    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        $images = Procatone::whereIn('id',explode(",",$ids))->get();
        $imgdetail =   Productsimage::whereIn('product_id',explode(",",$ids))->whereType(2)->get();
        if ($ids) {
            foreach($imgdetail as $image){
                $image_path = public_path().'/storage/uploads/cateroom/'.$image->imgs;
                if (file_exists($image_path) && $image->img != 'placeholder.png') {
                    unlink($image_path);
                }
            }
            foreach($images as $image){
                $image_path = public_path().'/storage/uploads/cateroom/'.$image->img;
                if (file_exists($image_path) && $image->img != 'placeholder.png') {
                    unlink($image_path);
                }
            }
        }

        $translation = Translation::whereIn('trans_id',explode(",",$ids))->where('trans_type','App\Models\Procatone')->delete();
        Procatone::whereIn('id',explode(",",$ids))->delete();
        Productsimage::whereIn('product_id',explode(",",$ids))->whereType(2)->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Danh mục đã chọn !']);
    }

    public function ChangeIsFeatured(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->is_featured = $request->is_featured;
        $procatone->save();
        return response()->json(['success'=>'Procatone Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->hide_show = $request->hide_show;
        $procatone->save();
        return response()->json(['success'=>'Procatone Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->is_new = $request->is_new;
        $procatone->save();
        return response()->json(['success'=>'Procatone Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->stt = $request->stt;
        $procatone->save();
        return response()->json(['success'=>'Procatone STT change successfully.']);
    }
}
