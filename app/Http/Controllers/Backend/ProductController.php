<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Product;
use Productsimage;
use App\User;
use Procatone;
use Procattwo;
use Procatthree;
use TagTranslation;
use Tag,DB;
use ProductTag;
use Translation;
use Cache;
use Image;
use Validate;
use Language;
use Carbon\Carbon;
use Validator;
use File;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class ProductController extends ShareController
{
    public function index()
    {
        $products = Product::with('translations')->orderBy('stt','asc')->orderBy('id','desc')->get();
        $procatones = Procatone::with('translations')->get();
        return view('backend.products.index', compact('products','procatones'));
    }

    public function create()
    {
        $tags = Tag::with('translations')->whereType('product')
        ->whereHide_show(1)->get();
        $procatones = Procatone::with('translations')->orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.products.create', compact('procatones','tags'));
    }
    public function edit(Request $request, $id)
    {
        $procatones = Procatone::orderBy('stt','asc')->orderBy('id','desc')->get();

        $id_category = array();
        $product = Product::with('get_tags')->with('images')->find($id);
        // lấy tất cả tag
        $tags1 = json_decode(Tag::whereType('product')->whereHide_show(1)->pluck('id'));
        // lấy tag của sản phẩm đó
        $tags2 = json_decode(ProductTag::where('product_id',$id)->pluck('tag_id'));
        // lọc ra tag đã hiển thị
        $result = array_diff($tags1, $tags2);
        // show những tag còn lại
        $tags=Tag::with('translations')->whereType('product')->whereIn('id',$result)->get();
        $images = $product->images;
        $json = $product->imgs;
        $json = json_decode($json, true);
        return view('backend.products.edit', compact('product','json','images','procatones','tags'));
    }
    public function store(Request $request) // tạo mới
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
            $res = $file->storeAs('public/uploads/'.$request->code.'', $name_save);
        }

        $data = [
            'stt' => $request->stt ?? false,
            'procatone_id' => $request->procatone,
            'code' =>  ucwords($request->code),
            'is_featured' => $request->is_featured ?? false,
            'is_new' => $request->is_new ?? false,
            'hide_show' => $request->hide_show ?? false,
            'bed' => $request->bed ?? '' ,
            'person' => $request->person ?? '',
            'cover' => $request->cover ?? '',
            'img'  => $name_save ?? 'placeholder.png',

        ];
        $product = Product::create($data);
        $product->translations()->createMany($request->translation);
        if(isset($request->tags)){
            for ($i = 0; $i < count($request->tags); $i++) {
                if (TagTranslation::where('tag_id', '=', $request->tags[$i])->exists()) {
                    // trùng tag thì bỏ
                    // đẩy data vào bảng tag_product ( trùng )
                    $producttag_default = new ProductTag();
                    $producttag_default->tag_id = json_decode($request->tags[$i]);
                    $producttag_default->product_id = $product->id;
                    $producttag_default->save();
                    //done
                     }
                else{
                    //  insert data vào tag và translation_tag
            $tags = new  Tag();
            $tags->type = 'product' ?? false;
            $tags->hide_show = true;
            $tags->stt = true;
            $tags->save();
                    //done
                    // đẩy data vào tag_product ( k trùng)
            $producttag= new ProductTag();
            $producttag->tag_id = $tags->id;
            $producttag->product_id = $product->id;
            $producttag->save();
                    //done
                    //đẩy tag vào bảng dịch ( lấy theo số lượng ngôn ngữ hiện có)
            $language = Language::get();
            foreach($language as $lang){
            $tag_tran = new TagTranslation();
            $tag_tran->tag_id = $tags->id;
            $tag_tran->locale = $lang->locale;
            $tag_tran->name = $request->tags[$i];
            $tag_tran->slug = Str::slug($tag_tran->name);
            $tag_tran->save();
                //done
            }
                }
            }
        }
        $inputImgs = $request->all();
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
                    $res = $file->storeAs('public/uploads/'.$product->code.'', $name_img);
                    Productsimage::create([
                                            'product_id' => $product->id,
                                            'imgs' => $name_img

                                         ]);
                }
            }
        }
        if ($product) {
            alert()->success("Thành công","Đã thêm phòng !");
            return redirect()->route('backend.product.index');
        }
        alert()->error("Lỗi","Thêm phòng thất bại");
        return redirect()->route('backend.product.index');

    }
    public function update(Request $request, $id)
    {
        $id_unique = Translation::where('trans_id',$id)->where('trans_type','App\Models\Product')->where('locale',session('locale'))->first()->id;
        $product = Product::find($id);
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
        if (!$request->hasFile('img')) {
            $name_save = $product->img;
        } else {
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $current_time = Carbon::now()->format('Hs');
            $name_save = $name_save_slug.'-'.$current_time.'.'.$ext;
            $res = $file->storeAs('public/uploads/'.$product->code.'', $name_save);
            $image_path = public_path().'/storage/uploads/'.$product->code.'/'.$product->img;
            if (file_exists($image_path) && $product->img != 'placeholder.png') {
                unlink($image_path);
            }
        }

        $product->stt           = $request->stt ?? $product->stt;
        // $product->code           = ucwords($request->code) ?? $product->code;
        $product->is_featured   = $request->is_featured ?? false;
        $product->person   = $request->person ;
        $product->bed  = $request->bed;
        $product->cover  = $request->cover;
        $product->is_new        = $request->is_new ?? false;
        $product->procatone_id  = $request->procatone ?? $product->procatone_id;
        $product->hide_show     = $request->hide_show ??  $product->hide_show;
        $product->img           = $name_save ??   $product->img ;


        if($request->tags){
            // dd(array_unique($request->tags));

            // $request->tags = (array_unique($request->tags));
            $producttag_default_old = ProductTag::where('product_id',$product->id)->delete(); // lấy data cũ và xóa
            for ($i = 0; $i < count($request->tags); $i++) {
                // dd($request->tags);
                if (TagTranslation::where('tag_id', '=', $request->tags[$i])->exists()) {
                    // trùng tag thì bỏ
                    // // đẩy data vào bảng tag_product ( trùng )
                    $producttag_default = new ProductTag();
                    $producttag_default->tag_id = json_decode($request->tags[$i]);
                    $producttag_default->product_id = $product->id;
                    $producttag_default->save();
                    // //done

                     }
                else{
                    //  insert data vào tag và translation_tag
            $tags = new  Tag();
            $tags->type = 'product' ?? false;
            $tags->hide_show = true;
            $tags->stt = true;
            $tags->save();
                    //done
                    // đẩy data vào tag_product ( k trùng)
            $producttag= new ProductTag();
            $producttag->tag_id = $tags->id;
            $producttag->product_id = $product->id;
            $producttag->save();
                    //done
                    //đẩy tag vào bảng dịch ( lấy theo số lượng ngôn ngữ hiện có)
            $language = Language::get();
            foreach($language as $lang){
            $tag_tran = new TagTranslation();
            $tag_tran->tag_id = $tags->id;
            $tag_tran->locale = $lang->locale;
            $tag_tran->name = $request->tags[$i];
            $tag_tran->slug = Str::slug($tag_tran->name);
            $tag_tran->save();
                //done
            }
                }
            }
        }

        $inputImgs = $request->all();
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
                    $res = $file->storeAs('public/uploads/'.$product->code.'', $name_img);
                    Productsimage::create([
                                            'product_id' => $product->id,
                                            'imgs' => $name_img
                                         ]);
                    // Productsimage::create($inputImgs);
                }
            }
        }
        $product->translations()->update($request->translation);
        $product->save();
        if($request->changelang){
            session()->put('locale',$request->changelang);
            return redirect()->back();
        }
        alert()->success("Thành công","Đã cập nhật sản phẩm");
        session()->forget('locale');
        return redirect()->route('backend.product.index');
    }

    public function destroy(Request $request, $id)
    {
        $product = Product::find($id);
        $img_name = $product->img;
        $find_ext_last = Str::replaceLast('.', '.', $img_name);
        $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
        $ext = Str::of($find_ext_last)->afterLast('.');
        $img_size_medium = '278x278';
        $img_size_small = '74x48';
        $img_size_del_medium = $name_without_ext.'-'.$img_size_medium.'.'.$ext;
        $img_size_del_small = $name_without_ext.'-'.$img_size_small.'.'.$ext;
        if ($product) {
            if ($product->img != 'placeholder.png') {
                $image_path = public_path().'/storage/uploads/'.$product->code.'/'.$product->img;
                if (File::exists($image_path)) {
                    unlink($image_path );
                  }
            }
            $image_path_frontend_medium = public_path().'/frontend/thumb/'.$img_size_del_medium;
            $image_path_frontend_small = public_path().'/frontend/thumb/'.$img_size_del_small;
            if (file_exists($image_path_frontend_medium)) {
                unlink($image_path_frontend_medium);
            }
            if (file_exists($image_path_frontend_small)) {
                unlink($image_path_frontend_small);
            }
            $images = Productsimage::select('id','imgs')->where('product_id',$product->id)->get();
            foreach($images as $image){
                if ($image->imgs != 'NULL') {
                    $images_path = public_path().'/storage/uploads/'.$product->code.'/'.$image->imgs;
                    if (File::exists($image_path)) {
                        unlink($image_path );
                      }
                      $image->delete();

                }
                $imgs_name = $image->imgs;
                $find_ext_last = Str::replaceLast('.', '.', $imgs_name);
                $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                $ext = Str::of($find_ext_last)->afterLast('.');
                $imgs_size_small = '74x48';
                $imgs_size_del_small = $name_without_ext.'-'.$imgs_size_small.'.'.$ext;
                $imgs_path_frontend_small = public_path().'/frontend/thumb/'.$imgs_size_del_small;
                if (file_exists($imgs_path_frontend_small)) {
                    unlink($imgs_path_frontend_small);
                }
            }
            $product->delete();
            $product->delete_trans()->delete();
            alert()->success("Thành công","Đã xóa sản phẩm");
            return redirect()->route('backend.product.index');
        }
            alert()->error("Lỗi","Xóa sản phẩm không thành công");
            session()->forget('locale');
            return redirect()->route('backend.product.index');
    }
    public function delete($id){
        $image = Productsimage::with('product')->find($id);
        $path = $image->product->code;
        if ($image) {
            $image_path_del = public_path().'/storage/uploads/'.$path.'/'.$image->imgs;
            unlink($image_path_del);
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
        return response()->json(['status'=>true,'message'=>'Xoá thành công']);
    }
    public function deletemultiple(Request $request){
        $ids = $request->ids;
        $images = Product::whereIn('id',explode(",",$ids))->get();
        if ($ids) {
            foreach($images as $image){
                // img index
                if ($image->img != 'placeholder.png') {
                    $image_path = public_path().'/storage/uploads/'.$image->code.'/'.$image->img;
                    unlink($image_path);
                }
                // img small & medium
                $img_name = $image->img;
                $find_ext_last = Str::replaceLast('.', '.', $img_name);
                $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                $ext = Str::of($find_ext_last)->afterLast('.');
                $img_size_small = '74x48';
                $img_size_medium = '278x278';
                $img_size_del_small = $name_without_ext.'-'.$img_size_small.'.'.$ext;
                $img_size_del_medium = $name_without_ext.'-'.$img_size_medium.'.'.$ext;
                $image_path_frontend_small = public_path().'/frontend/thumb/'.$img_size_del_small;
                $image_path_frontend_medium = public_path().'/frontend/thumb/'.$img_size_del_medium;
                if (file_exists($image_path_frontend_small)) {
                    unlink($image_path_frontend_small);
                }
                if (file_exists($image_path_frontend_medium)) {
                    unlink($image_path_frontend_medium);
                }
                $imgs_dels = Productsimage::with('product')->where('product_id',$image->id)->get();
                foreach($imgs_dels as $img_del) {
                    $path = $img_del->product->code;
                    $imgs_path = public_path().'/storage/uploads/'.$path.'/'.$img_del->imgs;
                    unlink($imgs_path);
                    // img small
                    $imgs_name = $img_del->imgs;
                    $find_ext_last = Str::replaceLast('.', '.', $imgs_name);
                    $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
                    $ext = Str::of($find_ext_last)->afterLast('.');
                    $imgs_size_small = '74x48';
                    $imgs_size_del_small = $name_without_ext.'-'.$imgs_size_small.'.'.$ext;
                    $imgs_path_frontend_small = public_path().'/frontend/thumb/'.$imgs_size_del_small;
                    if (file_exists($imgs_path_frontend_small)) {
                        unlink($imgs_path_frontend_small);
                    }
                    $img_del->delete();
                }

            }
        }
        $translation = Translation::whereIn('trans_id',explode(",",$ids))->where('trans_type','App\Models\Product')->delete();
        Product::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các sản phẩm đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $product = Product::find($request->product_id);
        $product->is_featured = $request->is_featured;
        $product->save();
        return response()->json(['success'=>'Product Is Featured change successfully.']);
    }
    public function ChangeIsNew(Request $request){
        $product = Product::find($request->product_id);
        $product->is_new = $request->is_new;
        $product->save();
        return response()->json(['success'=>'Product Is New change successfully.']);
    }
    public function hideShow(Request $request){
        $product = Product::find($request->product_id);
        $product->hide_show = $request->hide_show;
        $product->save();
        return response()->json(['success'=>'Product Hide Show change successfully.']);
    }
    public function changeStt(Request $request){
        $product = Product::find($request->product_id);
        $product->stt = $request->stt;
        $product->save();
        return response()->json(['success'=>'Product STT change successfully.']);
    }
}
