<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use App\Models\About;
use Validate;
use Artisan;
use Config;
use Hash;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Model;

class IndexController extends ShareController
{
    public function down_web(Request $request)
{
    $pass=$request->pass;
    $slug = Str::slug($pass);
    Artisan::call("down --secret=$slug");
    $maintain = Setting::firstorfail();
    $maintain->maintain = 1;
    $maintain->maintainpass = Hash::make($slug);
    $maintain->save();
    // Config::set('app.debug', true);
    alert()->warning('Cảnh báo','Đã đưa trang web vào trạng thái bảo trì !');
    return redirect("/$slug")->with('maintain','đã bảo trì');


}
public function up_web(Request $request)
{
    $maintain = Setting::firstorfail();
    if( Hash::check($request->pass  , $maintain->maintainpass)){
        $maintain->maintain = 0;
        $maintain->save();
        Artisan::call('up');
        alert()->success('Thành công','Website đã hoạt động lại !');
        // Config::set('app.debug', false);
    }
    else{
        alert()->error('Thất bại','Mật khẩu chưa chính xác !');
    }
    return redirect()->route('backend.dashboard.index');
}
public function filemanager(){
    return view('backend.filemanager.index');
}

public function changelocale($locale){
    session()->put('locale', $locale);
    return redirect()->back();
}
}
