<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use TagTranslation;
use Cache;
use Image;
use Validate;
use Carbon\Carbon;
use Tag;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Input;

class TagController extends ShareController
{
    public function index()
    {
        $tags = Tag::with('translations')->orderBy('stt','asc')->orderBy('id','desc')->get();
        return view('backend.tag.index', compact('tags'));
    }
    public function create()
    {
        return view('backend.tag.create');
    }

    public function edit(Request $request, $id)
    {
        $tag = tag::find($id);
        return view('backend.tag.edit', compact('tag'));
    }

    public function store(Request $request)
    {
        // $lang = [
        // ];
        // $request->validate([

        // ], $lang);
        $tag = new Tag();
        $tag->stt = $request->stt ?? false;
        $tag->hide_show = $request->hide_show ?? false;
        $tag->type = $request->type ?? false;
        $tag->save();

        $tag->translations()->createMany($request->translation);
        if ($tag) {
            alert()->success("Thành Công", "Đã thêm tag !");
            return redirect()->route('backend.tag.index');
        }
            alert()->danger("Lỗi", "Thêm tag thất bại !");
            return redirect()->route('backend.tag.index');
    }

    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);


        $tag->stt             = $request->stt;
        $tag->hide_show       = $request->hide_show;
        $tag->type            = $request->type;
        $tag->translations()->update($request->translation);
        $tag->save();
        if($request->changelang){
            session()->put('locale',$request->changelang);
            return redirect()->back();
        }
        session()->forget('locale');
        alert()->success("Thành công","Đã cập nhật lại tag");
        return redirect()->route('backend.tag.index');
    }


    public function destroy(Request $request, $id)
    {
        $tag = Tag::find($id);
            $tag->delete();
            $tag->delete_trans()->delete();
            alert()->success("Thành công", "Đã xóa danh mục");
            return redirect()->route('backend.tag.index');

    }
    public function deletemultiple(Request $request)
    {
        $ids = $request->ids;
        $translation = TagTranslation::whereIn('tag_id',explode(",",$ids))->delete();
        Tag::whereIn('id',explode(",",$ids))->delete();
        return response()->json(['status'=>true,'message'=>'Xoá thành công các mục đã chọn !']);
    }
    public function hideShow(Request $request){
        $tag = Tag::find($request->tag_id);
        $tag->hide_show = $request->hide_show;
        $tag->save();
        return response()->json(['success'=>'tag Hide Show change successfully.']);
    }

    public function changeStt(Request $request){
        $tag = Tag::find($request->tag_id);
        $tag->stt = $request->stt;
        $tag->save();
        return response()->json(['success'=>'tag STT change successfully.']);
    }
}
