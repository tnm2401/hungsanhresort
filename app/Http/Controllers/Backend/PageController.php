<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Page;
use Setting;
use Translation;
use Illuminate\Http\Request;
use Validator;
use Validate;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class PageController extends ShareController
{
    public function index()
    {
        $pages = Page::with('translations')->get();
        return view('backend.pages.index', compact('pages'));
    }

    public function create(){
        return view('backend.pages.create');
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
        if ($request->hasFile('img')) {
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $current_time = Carbon::now()->format('Hs');
            $name_save = $name_save_slug.'-'.$current_time.'.'.$ext;
            $res = $file->storeAs('public/uploads/pages', $name_save);
        } else {
            $name_save = 'placeholder.png';
        }

        $data = [
            'type' => $request->type ?? false,
            'hide_show' => 1,
            'view_count' =>1,
            'img' => $name_save,
        ];
        $page = Page::create($data);
        $page->translations()->createMany($request->translation);
        if ($page) {
            alert()->success('Thành công','Đã tạo trang');
            return redirect()->route('backend.page.index');
        }
            alert()->error('Lỗi','Tạo trang thất bại!!!');
            return redirect()->route('backend.page.index');

    }

    public function edit(Request $request, $id)
    {
        $page = Page::find($id);
        return view('backend.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::find($id);
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
            $name_save = $page->img;
        } else {
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $current_time = Carbon::now()->format('Hs');
            $name_save = $name_save_slug.'-'.$current_time.'.'.$ext;
            $res = $file->storeAs('public/uploads/pages', $name_save);
            $image_path_del = public_path().'/storage/uploads/pages/'.$page->img;
            if (file_exists($image_path_del) && $page->img != 'placeholder.png') {
                unlink($image_path_del);
            }
            $img_name = $page->img;
            $find_ext_last_img = Str::replaceLast('.', '.', $img_name);
            $name_without_ext_img = Str::of($find_ext_last_img)->beforeLast('.');
            $ext = Str::of($find_ext_last_img)->afterLast('.');
            $img_size_medium = '370x250';
            $img_size_del_medium = $name_without_ext_img.'-'.$img_size_medium.'.'.$ext;
            $image_path_frontend_medium = public_path().'/frontend/thumb/'.$img_size_del_medium;
            if (file_exists($image_path_frontend_medium)) {
                unlink($image_path_frontend_medium);
            }
        }

        $page->type = $request->type;
        $page->view_count = $request->view_count;
        $page->hide_show       = $request->hide_show;
        $page->img             = $name_save;
        $page->translations()->update($request->translation);
        $page->save();
        if($request->changelang){
            session()->put('locale',$request->changelang);
            return redirect()->back();
        }
        session()->forget('locale');
        alert()->success("Thành công",'Đã cập nhật trang');
        return redirect()->route('backend.page.index');
    }


    public function destroy(Request $request, $id)
    {
        $page = Page::find($id);
        if ($page) {
            $image_path_del = public_path().'/storage/uploads/pages/'.$page->img;
            if (file_exists($image_path_del) && $page->img != 'placeholder.png') {
                unlink($image_path_del);
            }
            $page->delete();
            $page->delete_trans()->delete();
            alert()->success("Thành công", "Đã xóa trang");
            return redirect()->route('backend.page.index');
        }
            alert()->error("Lỗi", "Xóa trang thất bại !");
            return redirect()->route('backend.page.index');

    }

    public function hideShow(Request $request){
        $page = Page::find($request->page_id);
        $page->hide_show = $request->hide_show;
        $page->save();
        return response()->json(['success'=>'Page Hide Show change successfully.']);
    }

}
