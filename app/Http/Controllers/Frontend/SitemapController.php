<?php
    namespace App\Http\Controllers\Frontend;
    use App\Http\Controllers\ShareController;
    use Illuminate\Http\Request;
    use Jenssegers\Agent\Agent;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\View;
    use Carbon\Carbon;
    use App\Models\Expertise;
    use App\Models\Slider;
    use Cache;
    use Session;

    class SitemapController extends ShareController
    {
        public function sitemap()
        {
            $expertise = Expertise::where('hide_show',1)->first();
            $galleries = Slider::where('type','gallery')->where('hide_show',1)->orderBy('stt','asc')->orderBy('id','desc')->get();
            $lang = Session::get('locale');
            if (Session::get('locale') == null) {
                $lang = 'vi';
            }else{
                $lang = Session::get('locale');
            }
            return response()->view('frontend.sitemaps.index', compact('expertise','galleries','lang'))->header('Content-Type', 'text/xml');
        }   
    }
        