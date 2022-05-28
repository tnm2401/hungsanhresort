<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Productsimage;
use Procatone;
use Procattwo;
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

class ProcatoneController extends ShareController
{
    public function index()
    {
        $procatones = Procatone::with('translations')->orderBy('stt','asc')->orderBy('id','desc')->get();
       session()->forget('locale');
        return view('backend.procatones.index', compact('procatones'));
    }
    public function create()
    {
        $procatones = Procatone::get();
        return view('backend.procatones.create', compact('procatones'));
    }

    public function edit(Request $request, $id)
    {
        $procatone = Procatone::with('images')->find($id);
        return view('backend.procatones.edit', compact('procatone'));
    }

    public function store(Request $request)
    {
        $lang = [
            '0.name.required' => 'Vui lòng nhập tên Tiếng Việt!',
            '1.name.required' => 'Vui lòng nhập tên Tiếng Anh!',
            '0.slug.required' => 'Vui lòng nhập url Tiếng Việt!',
            '1.slug.required' => 'Vui lòng nhập url Tiếng Anh !',
            '0.slug.unique' => 'URL Tiếng Việt đã tồn tại',
            '1.slug.unique' => 'URL Tiếng Anh đã tồn tại',
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
            $res = $file->storeAs('public/uploads/cateroom', $name_save);
        }
        $procatone = new  Procatone();
        $procatone->stt = $request->stt ?? false;
        $procatone->hide_show = $request->hide_show ?? false;
        $procatone->location = $request->location ?? false;
        $procatone-> price = str_replace(',', '',(number_format(str_replace(',', '', $request->price)))) ?? false;
        $procatone-> selling_price = str_replace(',', '',(number_format(str_replace(',', '', $request->price) - (str_replace(',', '', $request->price) * ($request->discount / 100))))) ?? false;
        $procatone-> discount = $request->discount ?? NULL;
        $procatone->img = $name_save ?? 'placeholder.png';
        $procatone->save();
        if ($request->hasFile('imgs')) {
            $files = $request->file('imgs');
            foreach ($files as $file){
                if($file->isValid()){
                    $full_name_img = $file->getClientOriginalName();
                    $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
                    $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                    $ext = $file->getClientOriginalExtension();
                    $name_save_slug = Str::slug($name_without_ext, '-');
                    $current_time = Carbon::now()->format('Hs');
                    $name_img = $name_save_slug.'-'.$current_time.'.'.$ext;
                    $res = $file->storeAs('public/uploads/cateroom', $name_img);
                    Productsimage::create([
                                            'product_id' => $procatone->id,
                                            'imgs' => $name_img,
                                            'type'=> 2
                                         ]);
                }
            }
        }
        $procatone->translations()->createMany($request->translation);
        if ($procatone) {
            alert()->success("Thành Công", "Đã thêm danh mục !");
            session()->forget('locale');
            return redirect()->route('backend.procatone.index');
        }
            alert()->danger("Lỗi", "Thêm danh mục thất bại !");
            session()->forget('locale');
            return redirect()->route('backend.procatone.index');
    }

    public function update(Request $request, $id)
    {
        $id_unique = Translation::where('trans_id',$id)->where('trans_type','App\Models\Procatone')->where('locale',session('locale'))->first()->id;
        $procatone = Procatone::find($id);
        $lang = [
            'name.required' => 'Vui lòng nhập tên !',
            'slug.required' => 'Vui lòng nhập url !',
            'slug.unique' => 'URL đã tồn tại',

        ];
        $validator = Validator::make(request()->translation, [
            'slug' =>'required| unique:translations,slug,'.$id_unique,
            'name' => 'required',
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
            $res = $file->storeAs('public/uploads/cateroom', $name_save);
            $image_path_del = public_path().'/storage/uploads/cateroom/'.$procatone->img;
            if (file_exists($image_path_del) && $procatone->img != 'placeholder.png') {
                unlink($image_path_del);
            }
        }
        $procatone->stt = $request->stt ?? $procatone->stt;
        $procatone->hide_show = $request->hide_show ?? $procatone->hide_show;
        $procatone->location = $request->location ??  $procatone->location;
        $procatone->price = str_replace(',', '',(number_format(str_replace(',', '', $request->price)))) ??  $procatone->price;
        $procatone->selling_price = str_replace(',', '',(number_format(str_replace(',', '', $request->price) - (str_replace(',', '', $request->price) * ($request->discount / 100))))) ??   $procatone->selling_price;
        $procatone-> discount = $request->discount ??    $procatone-> discount;
        $procatone->img  = $name_save ?? $procatone->img;
        $procatone->translations()->update($request->translation);
        if ($request->hasFile('imgs')) {
            $files = $request->file('imgs');
            foreach ($files as $file){
                if($file->isValid()){
                    $full_name_img = $file->getClientOriginalName();
                    $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
                    $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                    $ext = $file->getClientOriginalExtension();
                    $name_save_slug = Str::slug($name_without_ext, '-');
                    $current_time = Carbon::now()->format('Hs');
                    $name_img = $name_save_slug.'-'.$current_time.'.'.$ext;
                    $res = $file->storeAs('public/uploads/cateroom', $name_img);

                    Productsimage::create([
                                            'product_id' => $procatone->id,
                                            'imgs' => $name_img,
                                            'type'=> 2
                                         ]);
                }
            }
        }
        $procatone->save();
        if($request->changelang){
            session()->put('locale',$request->changelang);
            return redirect()->back();
        }
        session()->forget('locale');
        alert()->success("Thành công","Đã cập nhật lại danh mục");
        return redirect()->route('backend.procatone.index');
    }

    public function destroy(Request $request, $id)
    {
        $procatone = Procatone::find($id);
        if ($procatone) {
            $image_path_del = public_path().'/storage/uploads/cateroom/'.$procatone->img;
            if (file_exists($image_path_del) && $procatone->img != 'placeholder.png') {
                unlink($image_path_del);
            }
            $imgdetail =   Productsimage::whereIn('product_id',explode(",",$id))->whereType(2)->get();
            foreach($imgdetail as $image){
                $image_path = public_path().'/storage/uploads/cateroom/'.$image->imgs;
                if (file_exists($image_path) && $image->img != 'placeholder.png') {
                    unlink($image_path);
                }
            }
            Productsimage::whereIn('product_id',explode(",",$id))->whereType(2)->delete();

            $procatone->delete();
            $procatone->delete_trans()->delete();
            alert()->success("Thành công", "Đã xóa danh mục");
            session()->forget('locale');
            return redirect()->route('backend.procatone.index');
        }
            alert()->error("Lỗi", "Xóa danh mục thất bại !");
            session()->forget('locale');
            return redirect()->route('backend.procatone.index');

    }

    public function delete($id){
        $image = Productsimage::find($id);
        if ($image) {
            $image_path_del = public_path().'/storage/uploads/cateroom/'.$image->imgs;
            if(File::exists($image_path_del)) {
                unlink($image_path_del);
            }
            $imgs_name = $image->imgs;
            $find_ext_last = Str::replaceLast('.', '.', $imgs_name);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = Str::of($find_ext_last)->afterLast('.');
            $imgs_size_small = '92x60';
            $imgs_size_del_small = $name_without_ext.'-'.$imgs_size_small.'.'.$ext;
            $imgs_path_backend_small = public_path().'/backend/thumb/'.$imgs_size_del_small;
            if (file_exists($imgs_path_backend_small)) {
                unlink($imgs_path_backend_small);
            }
        }
        $image->delete($id);
        session()->forget('locale');
        return response()->json(['status'=>true,'message'=>'Xoá thành công']);
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
        session()->forget('locale');
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Danh mục đã chọn !']);
    }

    public function ChangeIsFeatured(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->is_featured = $request->is_featured;
        $procatone->save();
        session()->forget('locale');
        return response()->json(['success'=>'Procatone Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->hide_show = $request->hide_show;
        $procatone->save();
        session()->forget('locale');
        return response()->json(['success'=>'Procatone Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->is_new = $request->is_new;
        $procatone->save();
        session()->forget('locale');
        return response()->json(['success'=>'Procatone Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $procatone = Procatone::find($request->procatone_id);
        $procatone->stt = $request->stt;
        $procatone->save();
        session()->forget('locale');
        return response()->json(['success'=>'Procatone STT change successfully.']);
    }
}
