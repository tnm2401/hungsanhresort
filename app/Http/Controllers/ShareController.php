<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

use Setting;

use Newcategory;
use Svcategory;
use Post;
use Contact;
use Contactform;
use Slider;
use View;
use User;
use Session;
use App;
use Procatone;
use Gallery;
use Newcatone;
use Language;
class ShareController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
  {

    $setting = Setting::first();
    $language = Language::get();
    $lang = session()->get('locale') ?? 'vi';
    $master =
            [
                'name' => $setting->translations->name,
                'title' => $setting->translations->title,
                'keywords' => $setting->translations->keywords,
                'description' => $setting->translations->description,
                'img' => 'setting/'.$setting->img,
                'type' => $setting->type,
                'created_at' => $setting->published,
                'updated_at' => $setting->updated_at
            ];

    $menu['cateroom'] = Procatone::orderBy('stt','asc')->where('hide_show','1')->get();
    $menu['services'] = Svcategory::orderBy('stt','desc')->where('hide_show','1')->get();
    $menu['post'] = Newcatone::orderBy('id','desc')->orderBy('stt','desc')->where('hide_show','1')->get();
    $menu['gallery'] = Gallery::orderBy('id','desc')->orderBy('stt','desc')->where('hide_show','1')->get();

    View::share('menu', $menu);
    View::share('setting', $setting);
    View::share('language', $language);
    View::share('master',$master);
    View::share('lang',$lang);
  }
}
