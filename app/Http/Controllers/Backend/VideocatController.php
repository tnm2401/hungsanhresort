<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use App\Models\Videocat;
use Cache;
use Image;
use Validate;
use Translation;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class VideocatController extends ShareController
{
    public function index()
    {
        $videocats = Videocat::with('translations')->orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.videocats.index', compact('videocats'));
    }
    public function create()
    {
        $videocats = Videocat::get();
        return view('backend.videocats.create', compact('videocats'));
    }

    public function edit(Request $request, $id)
    {
        $videocat = Videocat::find($id);
        $videocats = Videocat::get();
        return view('backend.videocats.edit', compact('videocat','videocats'));
    }

    public function store(Request $request)
    {
        $lang = [
        ];
        $request->validate([

        ], $lang);
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $current_time = Carbon::now()->format('Hs');
            $name_save = $name_save_slug.'-'.$current_time.'.'.$ext;
            $res = $file->storeAs('public/uploads/videocats', $name_save);
        } else {
            $name_save = 'placeholder.png';
        }

        $videocat = new  Videocat();
        $videocat->stt = $request->stt ?? false;
        $videocat->view_count = $request->view_count ?? false;
        $videocat->hide_show = $request->hide_show ?? false;
        $videocat->img = $name_save ?? false;
        $videocat->save();

        $videocat->translations()->createMany($request->translation);
        if ($videocat) {
            alert()->success("Thành Công", "Đã thêm danh mục !");
            return redirect()->route('backend.videocat.index');
        }
            alert()->danger("Lỗi", "Thêm danh mục thất bại !");
            return redirect()->route('backend.videocat.index');
    }

    public function update(Request $request, $id)
    {
        $videocat = Videocat::find($id);
        if (!$request->hasFile('img')) {
            $name_save = $videocat->img;
        } else {
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $current_time = Carbon::now()->format('Hs');
            $name_save = $name_save_slug.'-'.$current_time.'.'.$ext;
            $res = $file->storeAs('public/uploads/videocats', $name_save);
            $image_path_del = public_path().'/storage/uploads/videocats/'.$videocat->img;
            if (file_exists($image_path_del) && $videocat->img != 'placeholder.png') {
                unlink($image_path_del);
            }
        }
        $videocat->stt             = $request->stt;
        $videocat->hide_show       = $request->hide_show;
        $videocat->img             = $name_save;
        $videocat->translations()->update($request->translation);
        $videocat->save();
        alert()->success("Thành công","Đã cập nhật lại danh mục");
        return redirect()->route('backend.videocat.index');
    }

    public function destroy(Request $request, $id)
    {
        $videocat = Videocat::find($id);
        if ($videocat) {
            if ($videocat->img != 'placeholder.png') {
                $image_path = public_path().'/storage/uploads/'.$videocat->img;
                unlink($image_path);
            }
            $videocat->delete();
            $videocat->delete_trans()->delete();
            alert()->success("Thành công",'Đã xóa danh mục video');
            return redirect()->route('backend.videocat.index');
        }
            alert()->error("Thất bại",'Lỗi khi xóa danh mục video');
            return redirect()->route('backend.videocat.index');

    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        $images = Videocat::whereIn('id',explode(",",$ids))->get();
        if ($ids) {
            foreach($images as $image){
                if ($image->img != 'placeholder.png') {
                    $image_path = public_path().'/storage/uploads/videocats/'.$image->img;
                    unlink($image_path);
                }
            }
        }
        $translation = Translation::whereIn('trans_id',explode(",",$ids))->where('trans_type','App\Models\Videocat')->delete();
       $video =  Videocat::whereIn('id',explode(",",$ids))->delete();
       return response()->json(['status'=>true,'message'=>'Xoá thành công các Danh mục đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $videocat = Videocat::find($request->videocat_id);
        $videocat->is_featured = $request->is_featured;
        $videocat->save();
        return response()->json(['success'=>'Videocat Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $videocat = Videocat::find($request->videocat_id);
        $videocat->hide_show = $request->hide_show;
        $videocat->save();
        return response()->json(['success'=>'Videocat Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $videocat = Videocat::find($request->videocat_id);
        $videocat->is_new = $request->is_new;
        $videocat->save();
        return response()->json(['success'=>'Videocat Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $videocat = Videocat::find($request->videocat_id);
        $videocat->stt = $request->stt;
        $videocat->save();
        return response()->json(['success'=>'Videocat STT change successfully.']);
    }
}
