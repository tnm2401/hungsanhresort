<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Procattwo;
use Procatone;
use Procatthree;
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

class ProcattwoController extends ShareController
{
    public function index()
    {
        $procattwos = Procattwo::with('procatone')->orderBy('stt','asc')->orderBy('id','desc')->get();

        // dd($procattwos);

        $procatones =Procatone::with('translations')->get();

        return view('backend.procattwos.index', compact('procattwos','procatones'));
    }
    public function create()
    {
        $procatones = Procatone::with('translations')->orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.procattwos.create', compact('procatones'));
    }

    public function edit(Request $request, $id)
    {
        $procatones = Procatone::with('translations')->orderBy('stt','asc')->orderBy('id','desc')->get();
        $procattwo = Procattwo::find($id);
        $procattwos = Procattwo::orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.procattwos.edit', compact('procattwo','procattwos', 'procatones'));
    }

    public function store(Request $request) // Tạo mới productcategory
    {
        $lang = [
            '*.name.required' => 'Vui lòng nhập tên !',
            '*.slug.required' => 'Vui lòng nhập url !',
            '*.slug.unique' => 'URL đã tồn tại',
        ];
        $validator = Validator::make(request()->translation, [
            '*.slug' =>'required| unique:translations',
            '*.name' => 'required',
        ],$lang);
        $validated = $validator->validated();

        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $current_time = Carbon::now()->format('Hs');
            $name_save = $name_save_slug.'-'.$current_time.'.'.$ext;
            $res = $file->storeAs('public/uploads', $name_save);
        } else {
            $name_save = 'placeholder.png';
        }

        $procattwo = new  Procattwo();
        $procattwo->procatone_id = $request->procatone_id ?? false;
        $procattwo->infomation = $request->infomation ?? false;
        $procattwo->stt = $request->stt ?? false;
        $procattwo->hide_show = $request->hide_show ?? false;
        $procattwo->show_nav = $request->show_nav ?? false;
        $procattwo->is_featured = $request->is_featured ?? false;
        $procattwo->img = $name_save ?? false;
        $procattwo->save();
        $procattwo->translations()->createMany($request->translation);


        // $procattwo = Procattwo::create($data);

        if ($procattwo) {
            alert()->success('Thành công','Đã thêm danh mục cấp 2!');
            return redirect()->route('backend.procattwo.index');
        }
        alert()->error('Lỗi','Thêm Danh mục thất bại !');
            return redirect()->route('backend.procattwo.index');
    }

    public function update(Request $request, $id)
    {
        $procattwo = Procattwo::find($id);
        $lang = [
            '*.name.required' => 'Vui lòng nhập tên !',
            '*.slug.required' => 'Vui lòng nhập url !',
            '*.slug.unique' => 'URL đã tồn tại',
        ];
        $validator = Validator::make(request()->translation, [
            '*.slug' =>'required| unique:translations',
            '*.name' => 'required',
        ],$lang);
        $validated = $validator->validated();
        if (!$request->hasFile('img')) {
            $name_save = $procattwo->img;
        } else {
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $current_time = Carbon::now()->format('Hs');
            $name_save = $name_save_slug.'-'.$current_time.'.'.$ext;
            $res = $file->storeAs('public/uploads', $name_save);
        }
        $procattwo               = Procattwo::find($id);
        $procattwo->stt          = $request->stt;
        $procattwo->procatone_id = $request->procatone_id ?? false;
        $procattwo->infomation   = $request->infomation;
        $procattwo->hide_show    = $request->hide_show;
        $procattwo->show_nav     = $request->show_nav;
        $procattwo->is_featured  = $request->is_featured;
        $procattwo->img          = $name_save;
        $procattwo->translations()->update($request->translation);
        $procattwo->save();
        alert()->success('Thành công','Đã cập nhật danh mục');
        return redirect()->route('backend.procattwo.index');

    }

    public function destroy(Request $request, $id)
    {
        $procattwo = Procattwo::find($id);
        if ($procattwo) {
            if ($procattwo->img != 'placeholder.png') {
                $image_path = public_path().'/storage/uploads/'.$procattwo->img;
                unlink($image_path);
            }
            $procattwo->delete();
            $procattwo->delete_trans()->delete();
            alert()->success("Thành công","Đã xóa danh mục");
            return redirect()->route('backend.procattwo.index');
        }
            alert()->error("Lỗi","Xóa danh mục thất bại");
            return redirect()->route('backend.procattwo.index');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        $images = Procattwo::whereIn('id',explode(",",$ids))->get();
        if ($ids) {
            foreach($images as $image){
                if ($image->img != 'placeholder.png') {
                    $image_path = public_path().'/storage/uploads/'.$image->img;
                    unlink($image_path);
                }
            }
        }
        $translation = Translation::whereIn('trans_id',explode(",",$ids))->where('trans_type','App\Models\Procattwo')->delete();
        Procattwo::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Danh mục đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $procattwo = Procattwo::find($request->procattwo_id);
        $procattwo->is_featured = $request->is_featured;
        $procattwo->save();
        return response()->json(['success'=>'Procattwo Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $procattwo = Procattwo::find($request->procattwo_id);
        $procattwo->hide_show = $request->hide_show;
        $procattwo->save();
        return response()->json(['success'=>'Procattwo Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $procattwo = Procattwo::find($request->procattwo_id);
        $procattwo->is_new = $request->is_new;
        $procattwo->save();
        return response()->json(['success'=>'Procattwo Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $procattwo = Procattwo::find($request->procattwo_id);
        $procattwo->stt = $request->stt;
        $procattwo->save();
        return response()->json(['success'=>'Procattwo STT change successfully.']);
    }
}
