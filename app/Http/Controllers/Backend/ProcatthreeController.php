<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Procatthree;
use Procattwo;
use Procatone;
use Product;
use Translation;
use Cache;
use Image;
use Validate;
use Validator;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class ProcatthreeController extends ShareController
{
    public function index()
    {
        $procatthrees = Procatthree::with('translations')->get();
        // dd($procatthrees);
        $procatones = Procatone::with('translations')->get();
        $procattwos = Procattwo::with('translations')->get();
        return view('backend.procatthrees.index', compact('procatones','procattwos','procatthrees'));
    }
    public function select(Request $request){
        $data = $request->all();
        if ($data['action']) {
            $output = '';
            if ($data['action'] == 'procatone') {
                $select_procattwo = Procattwo::with('translations')->where('procatone_id',$data['code_id'])->orderBy('id','ASC')->get();
                // $output.='<option>Không có danh mục cấp 2</option>';
                foreach ($select_procattwo as $key => $procattwo){
                    $output.='<option value="'.$procattwo->id.'" data-id="'.$procattwo->id.'">'.$procattwo->translations->name.'</option>';
                }
            }
        }
        echo $output;
    }
    public function create()
    {
        $procattwos = Procattwo::with('translations')->get();
        $procatones = Procatone::with('translations')->get();
        return view('backend.procatthrees.create', compact('procattwos','procatones'));
    }

    public function edit(Request $request, $id)
    {
        $procattwos = Procattwo::with('translations')->get();
        $procatones = Procatone::with('translations')->get();
        $procatthree = Procatthree::find($id);

        return view('backend.procatthrees.edit', compact('procatthree','procattwos', 'procatones'));
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
            $name_save = $name_save_slug.'.'.$ext;
            $res  = $file->storeAs('public/uploads', $name_save);
        } else
        {
            $name_save = 'placeholder.png';
        }

        $procatthree               = new Procatthree;
        $procatthree->stt          = $request->stt ?? false;
        $procatthree->procatone_id = $request->procatone ?? false;
        $procatthree->procattwo_id = $request->procattwo ?? false;
        $procatthree->hide_show    = $request->hide_show ?? false;
        $procatthree->show_nav     = $request->show_nav ?? false;
        $procatthree->is_featured  = $request->is_featured ?? false;
        $procatthree->img          = $name_save;
        $procatthree->save();
        $procatthree->translations()->createMany($request->translation);


        if ($procatthree) {
            alert()->success('Thành công','Đã thêm danh mục cấp 3');
            return redirect()->route('backend.procatthree.index');
        }
            alert()->error('Lỗi','Thêm danh mục thất bại !');
            return redirect()->route('backend.procatthree.index');
    }

    public function update(Request $request, $id)
    {
        $procatthree = Procatthree::find($id);
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
            $name_save = $procatthree->img;
        } else
        {
            $file = $request->file('img');
            $full_name_img = $file->getClientOriginalName();
            $find_ext_last = Str::replaceLast('.', '.', $full_name_img);
            $name_without_ext = Str::of($find_ext_last)->beforeLast('.');
            $ext = $file->getClientOriginalExtension();
            $name_save_slug = Str::slug($name_without_ext, '-');
            $name_save = $name_save_slug.'.'.$ext;
            $res  = $file->storeAs('public/uploads', $name_save);
        }
        $a = request()->all();
        $procatthree               = Procatthree::find($id);
        $procatthree->stt          = $request->stt;
        $procatthree->procatone_id = $request->procatone ?? false;
        $procatthree->procattwo_id = $request->procattwo ?? false;
        $procatthree->hide_show    = $request->hide_show;
        $procatthree->show_nav     = $request->show_nav;
        $procatthree->is_featured  = $request->is_featured;
        $procatthree->img          = $name_save;
        $procatthree->translations()->update($request->translation);
        $procatthree->save();
        return redirect()->route('backend.procatthree.index')->with('success','Cập nhật Danh mục thành công !');
    }

    public function destroy(Request $request, $id)
    {
        $procatthree = Procatthree::find($id);
        if ($procatthree) {
            if ($procatthree->img != 'placeholder.png') {
                $image_path = public_path().'/storage/uploads/'.$procatthree->img;
                unlink($image_path);
            }
            $procatthree->delete();
            $procatthree->delete_trans()->delete();
            alert()->success('Thành công','đã xóa danh mục cấp 3 !');
            return redirect()->route('backend.procatthree.index');
        }
            alert()->error('Lỗi','xóa dah mục cấp 3 thất bại');
            return redirect()->route('backend.procatthree.index');
    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        $translation = Translation::whereIn('trans_id',explode(",",$ids))->where('trans_type','App\Models\Procatthree')->delete();
        Procatthree::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các Danh mục đã chọn !']);
    }
    public function ChangeIsFeatured(Request $request){
        $procatthree = Procatthree::find($request->procatthree_id);
        $procatthree->is_featured = $request->is_featured;
        $procatthree->save();
        return response()->json(['success'=>'Procatthree Is Featured change successfully.']);
    }
    public function hideShow(Request $request){
        $procatthree = Procatthree::find($request->procatthree_id);
        $procatthree->hide_show = $request->hide_show;
        $procatthree->save();
        return response()->json(['success'=>'Procatthree Hide Show change successfully.']);
    }
    public function isNew(Request $request){
        $procatthree = Procatthree::find($request->procatthree_id);
        $procatthree->is_new = $request->is_new;
        $procatthree->save();
        return response()->json(['success'=>'Procatthree Is New change successfully.']);
    }
    public function changeStt(Request $request){
        $procatthree = Procatthree::find($request->procatthree_id);
        $procatthree->stt = $request->stt;
        $procatthree->save();
        return response()->json(['success'=>'Procatthree STT change successfully.']);
    }
}
