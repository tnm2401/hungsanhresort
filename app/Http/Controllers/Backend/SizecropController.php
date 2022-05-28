<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\ShareController;
use Footer;
use Size_crop;
use Validate;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class SizecropController extends ShareController
{

    public function index()
    {
        $sizecrop =  Size_crop::all();
        return view('backend.sizecrop.index', compact('sizecrop'));
    }


    public function store(Request $request)
    {
        $sizecrop = new  Size_crop();
        $sizecrop->size = $request->size ?? false;
        $sizecrop->height = $request->height ?? false;
        $sizecrop->width = $request->width ?? false;
        $sizecrop->save();
        alert()->success("Thành công", 'Đã thêm kích thước');
        return redirect()->route('backend.sizecrop.index');
    }

    public function update(Request $request, $id)
    {
        $sizecrop = Size_crop::find($id);
        $sizecrop->size         = $request->size;
        $sizecrop->width         = $request->width;
        $sizecrop->height      = $request->height;
        $sizecrop->save();
        if ($sizecrop->save()) {
            alert()->success("Thành công", 'Đã cập nhật kích thước');
            return redirect()->route('backend.sizecrop.index');
        }
        alert()->error("Thất bại", 'Đã có lỗi xảy ra');
        return redirect()->route('backend.sizecrop.index');
    }

    public function destroy($id)
    {
        $sizecrop = Size_crop::find($id);
        $sizecrop->delete();
        alert()->success("Thành công", 'Đã xóa kích thước');
        return redirect()->route('backend.sizecrop.index');
    }
}
