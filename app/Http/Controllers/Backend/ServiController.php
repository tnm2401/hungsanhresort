<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use App\Models\Svcategory;
use Servi;
use Cache;
use Validate;
use Translation;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ServiController extends ShareController
{
    public function index()
    {
        $svcategories = Svcategory::all();
        $servis = Servi::orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.servis.index', compact('servis','svcategories'));
    }
    public function create()
    {
        $svcategories = Svcategory::all();
        return view('backend.servis.create', compact('svcategories'));
    }

    public function edit(Request $request, $id)
    {
        $svcategories = Svcategory::all();
        $servi = Servi::find($id);
        return view('backend.servis.edit', compact('svcategories','servi'));
    }

    public function store(Request $request)
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
        if ($request->hasFile('img')){
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
        if ($request->hasFile('img1')){
            $file = $request->file('img1');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $current_time = Carbon::now()->format('Hs');
            $name_save1 = $name_save_slug.'-'.$current_time.'.'.$ext;
            $res = $file->storeAs('public/uploads', $name_save1);
        } else {
            $name_save1 = 'placeholder.png';
        }
        if ($request->slug){
            $slug = $request->slug;
        }else{
            $slug = Str::slug($request->slug,'-');
        }
        $video_url = $request->video;
        $video_code = Str::after($video_url, 'https://www.youtube.com/watch?v=');
        $data = [
            'type' => $request->type,
            'stt' => $request->stt,
            'svcategory_id' => $request->svcategory_id,
            'article_type_id' => $request->article_type_id,
            'name_vi' => $request->name_vi,
            'name_en' => $request->name_en,
            'name_cn' => $request->name_cn,
            'video' => $request->video,
            'video_code' => $video_code,
            'descriptions_vi' => $request->descriptions_vi,
            'descriptions_en' => $request->descriptions_en,
            'descriptions_cn' => $request->descriptions_cn,
            'is_featured' => $request->is_featured,
            'is_new' => $request->is_new,
            'hide_show' => $request->hide_show,
            'content_vi' => $request->content_vi,
            'content_en' => $request->content_en,
            'content_cn' => $request->content_cn,
            'content1_vi' => $request->content1_vi,
            'content1_en' => $request->content1_en,
            'content1_cn' => $request->content1_cn,
            'slug' => Str::slug($request->slug,'-'),
            'title_vi' => $request->title_vi,
            'title_en' => $request->title_en,
            'title_cn' => $request->title_cn,
            'keywords_vi' => $request->keywords_vi,
            'keywords_en' => $request->keywords_en,
            'keywords_cn' => $request->keywords_cn,
            'description_vi' => $request->description_vi,
            'description_en' => $request->description_en,
            'description_cn' => $request->description_cn,
            'img' => $name_save,
            'img1' => $name_save1
        ];
        $servi = Servi::create($data);
        if ($servi) {
            return redirect()->route('backend.servi.index')->with('success','Thêm bài viết thành công !');
        }
            return redirect()->route('backend.servi.index')->with('error','Thêm bài viết lỗi !');

    }
    public function update(Request $request, $id)
    {
        $servi = Servi::find($id);
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
            $name_save = $servi->img;
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
            $image_path_del = public_path().'/storage/uploads/'.$servi->img;
            if (file_exists($image_path_del) && $servi->img != 'placeholder.png') {
                unlink($image_path_del);
            }
            $img_name = $servi->img;
            $find_ext_last_img = Str::replaceLast('.', '.', $img_name);
            $name_without_ext_img = Str::of($find_ext_last_img)->beforeLast('.');
            $ext = Str::of($find_ext_last_img)->afterLast('.');
            $img_size_medium = '568x330';
            $img_size_del_medium = $name_without_ext_img.'-'.$img_size_medium.'.'.$ext;
            $image_path_frontend_medium = public_path().'/frontend/thumb/'.$img_size_del_medium;
            if (file_exists($image_path_frontend_medium)) {
                unlink($image_path_frontend_medium);
            }
        }
        if (!$request->hasFile('img1')) {
            $name_save1 = $servi->img1;
        } else {
            $file = $request->file('img1');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $current_time = Carbon::now()->format('Hs');
            $name_save1 = $name_save_slug.'-'.$current_time.'.'.$ext;
            $res = $file->storeAs('public/uploads', $name_save1);
            $image_path_del = public_path().'/storage/uploads/'.$servi->img1;
            if (file_exists($image_path_del) && $servi->img1 != 'placeholder.png') {
                unlink($image_path_del);
            }
        }
        if ($request->slug) {
            $slug = $request->slug;
        }else{
            $slug = Str::slug($request->slug,'-');
        }
        $video_url = $request->video;
        $video_code = Str::after($video_url, 'https://www.youtube.com/watch?v=');
        $servi->type            = $request->type;
        $servi->stt             = $request->stt;
        $servi->svcategory_id   = $request->svcategory_id;
        $servi->article_type_id = $request->article_type_id;
        $servi->name_vi         = $request->name_vi;
        $servi->name_en         = $request->name_en;
        $servi->name_cn         = $request->name_cn;
        $servi->video           = $request->video;
        $servi->video_code      = $video_code;
        $servi->descriptions_vi = $request->descriptions_vi;
        $servi->descriptions_en = $request->descriptions_en;
        $servi->descriptions_cn = $request->descriptions_cn;
        $servi->is_featured     = $request->is_featured;
        $servi->is_new          = $request->is_new;
        $servi->hide_show       = $request->hide_show;
        $servi->content_vi      = $request->content_vi;
        $servi->content_en      = $request->content_en;
        $servi->content_cn      = $request->content_cn;
        $servi->content1_vi     = $request->content1_vi;
        $servi->content1_en     = $request->content1_en;
        $servi->content1_cn     = $request->content1_cn;
        $servi->slug            = Str::slug($request->slug,'-');
        $servi->title_vi        = $request->title_vi;
        $servi->title_en        = $request->title_en;
        $servi->title_cn        = $request->title_cn;
        $servi->keywords_vi     = $request->keywords_vi;
        $servi->keywords_en     = $request->keywords_en;
        $servi->keywords_cn     = $request->keywords_cn;
        $servi->description_vi  = $request->description_vi;
        $servi->description_en  = $request->description_en;
        $servi->description_cn  = $request->description_cn;
        $servi->img             = $name_save;
        $servi->img1            = $name_save1;
        Cache::forget($slug);
        $servi->save();
        return redirect()->route('backend.servi.index')->with('success','Cập nhật bài viết thành công !');
    }

    public function destroy(Request $request, $id)
    {
        $servi = Servi::find($id);
        if ($servi) {
            $img_name = $servi->img;
            $find_ext_last = Str::replaceLast('.', '.', $img_name);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = Str::of($find_ext_last)->afterLast('.');
            $img_size_medium = '568x330';
            $img_size_del_medium = $name_without_ext.'-'.$img_size_medium.'.'.$ext;
            $image_path_del = public_path().'/storage/uploads/'.$servi->img;
            $image_path_del_img1 = public_path().'/storage/uploads/'.$servi->img1;
            $image_path_frontend_medium = public_path().'/frontend/thumb/'.$img_size_del_medium;
            if (file_exists($image_path_del) && $servi->img != 'placeholder.png') {
                unlink($image_path_del);
            }
            if (file_exists($image_path_del_img1) && $servi->img1 != 'placeholder.png') {
                unlink($image_path_del_img1);
            }
            if (file_exists($image_path_frontend_medium)) {
                unlink($image_path_frontend_medium);
            }
            $servi->delete();
            return redirect()->route('backend.servi.index')->with('success','Xóa bài viết thành công !');
        }
            return redirect()->route('backend.servi.index')->with('success','Bài viết không tồn tại !');
    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        $images = Servi::whereIn('id',explode(",",$ids))->get();
        if ($ids) {
            foreach($images as $image){
                // img index
                $image_path = public_path().'/storage/uploads/'.$image->img;
                $image_path_img1 = public_path().'/storage/uploads/'.$image->img1;
                if (file_exists($image_path) && $image->img != 'placeholder.png') {
                    unlink($image_path);
                }
                if (file_exists($image_path_img1) && $image->img1 != 'placeholder.png') {
                    unlink($image_path_img1);
                }
                // img small & medium
                $img_name = $image->img;
                $find_ext_last = Str::replaceLast('.', '.', $img_name);
                $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                $ext = Str::of($find_ext_last)->afterLast('.');
                $img_size_medium = '568x330';
                $img_size_del_medium = $name_without_ext.'-'.$img_size_medium.'.'.$ext;
                $image_path_frontend_medium = public_path().'/frontend/thumb/'.$img_size_del_medium;
                if (file_exists($image_path_frontend_medium)) {
                    unlink($image_path_frontend_medium);
                }
            }
        }
        Servi::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các bài viết đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $servi = Servi::find($request->servi_id);
        $servi->is_featured = $request->is_featured;
        $servi->save();
        return response()->json(['success'=>'Service Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $servi = Servi::find($request->servi_id);
        $servi->hide_show = $request->hide_show;
        $servi->save();
        return response()->json(['success'=>'Service Hide Show change successfully.']);
    }
    public function changeStt(Request $request){
        $servi = Servi::find($request->servi_id);
        $servi->stt = $request->stt;
        $servi->save();
        return response()->json(['success'=>'Service STT change successfully.']);
    }
}
