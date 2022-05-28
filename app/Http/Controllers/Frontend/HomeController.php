<?php
    namespace App\Http\Controllers\Frontend;
    use App\Http\Controllers\ShareController;
    use Illuminate\Http\Request;
    use Setting;
    use Slider;
    use Post;
    use Contact;
    use Gallery;
    use Author;
    use Svcategory;
    use Page;
    use Counter;
    use Online;
    use View;
    use Auth;
    use Cache;
    use Session;
    use Carbon;
    use Procatone;
    use Product;
    use Translation;
    use Newcatone;
    use Customer;
    use Order;
    use CartHelper;
    use Productsimage;
    use Mail;
    use Jenssegers\Agent\Agent;
    use Illuminate\Support\Str;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\URL;
    use Illuminate\Support\Facades\Config;

    class HomeController extends ShareController
    {
        /* trang chủ */
        public function index(Request $request)
        {
            if(session('checking') == ''){
                $data=([
                    'from_date' => now(),
                    'to_date' => now()->addDays(2),
                    'night' => 2
                ]);
                $request->session()->put('checking',$data);
            }
            $setting = Setting::first();
            $data['about-us'] = Page::where('id',2)->FirstorFail();
            $data['type_room'] = Procatone::orderby('stt','asc')->whereHide_show(1)->get();
            $data['feature_posts'] = Post::with('translations')->orderby('id','desc')->orderby('stt','asc')
            ->where('hide_show',1)->where('is_featured',1)->limit(6)->get();
            $data['slider'] = Slider::with('translations')->orderby('id','desc')->orderby('stt','asc')->where('hide_show',1)->get();
            $data['gallery'] = Gallery::with('translations')->with('images')->orderby('id','desc')->orderby('stt','asc')->where('hide_show',1)->limit(8)->get();
            $data['services'] = Svcategory::with('translations')->orderby('id','desc')->orderby('stt','asc')->where('hide_show',1)->limit(4)->get();

            $time_now = Carbon::now('Asia/Ho_Chi_Minh');
            $user_online = $request->session()->getId();
            if (Online::where('session_id', '=', $user_online)->count() > 0) {
            } else {
                $online = new Online([
                    'session_id' => $user_online,
                ]);
                $online->save();
            }
            $time_db = Online::get();
            foreach ($time_db as $item) {
                $time_old = $item->created_at;
                $time_id = $item->id;
                $check_time = $time_now->diffInMinutes($time_old);
                $check_time_counter = $time_now->diffInMinutes($time_old);
                $ip_user = $_SERVER['REMOTE_ADDR'];
                if (Counter::where('time', '=', $time_old)->count() > 0) {
                } else {
                DB::table('counters')->whereDate('time', '>=', date('Y-m-d H:i:s',strtotime('-1 minutes')) )->insert(['time' => $time_old,'ip'=>$ip_user]);
                }
                if ($check_time_counter > 1) {
                    $deletedRows = Online::where('id', $time_id)->delete();
                }
                // dd(session('checking'));

            }
            return view("frontend.home.index",compact('setting','data'));
        }

        // slug
        public function slug($slug){
            $data = Translation::where('slug',$slug)->FirstOrFail();
            // dd($data->slug);
            switch($data->trans_type){
                case('App\Models\Page');
                if($data->slug == 'gioi-thieu'  || $data->slug == 'about-us'){
                    $page = Page::with('translations')->where('id',$data->trans_id)->First();
                    $gallery = Productsimage::orderBy('id','desc')->where('type',3)->limit(30)->get();
                    $master =
                    [
                        'name' => $page->translations->name,
                        'title' => $page->translations->title,
                        'keywords' => $page->translations->keywords,
                        'description' => $page->translations->description,
                        'img' => 'pages/'.$page->img,
                        'type' => $page->type,
                        'created_at' => $page->created_at,
                        'updated_at' => $page->updated_at
                    ];
                    return view('frontend.site.about-us',compact('page','gallery','master'));
                }
                elseif($data->slug == 'lien-he' || $data->slug == 'contact'){
                    $page = Page::with('translations')->where('id',$data->trans_id)->First();
                    $master =
                    [
                        'name' => $page->translations->name,
                        'title' => $page->translations->title,
                        'keywords' => $page->translations->keywords,
                        'description' => $page->translations->description,
                        'img' => 'pages/'.$page->img,
                        'type' => $page->type,
                        'created_at' => $page->created_at,
                        'updated_at' => $page->updated_at
                    ];
                    return view('frontend.site.contact',compact('page','master'));
                }
                elseif($data->slug == 'tat-ca-phong' || $data->slug == 'all-room'){
                    $page = Page::with('translations')->where('id',$data->trans_id)->First();
                    $room = Product::orderby('stt','asc')->get();
                    $master =
                    [
                        'name' => $page->translations->name,
                        'title' => $page->translations->title,
                        'keywords' => $page->translations->keywords,
                        'description' => $page->translations->description,
                        'img' => 'pages/'.$page->img,
                        'type' => $page->type,
                        'created_at' => $page->created_at,
                        'updated_at' => $page->updated_at
                    ];
                    return view('frontend.site.all-room',compact('page','room','master'));
                }
                elseif($data->slug == 'tat-ca-bai-viet' || $data->slug == 'all-post'){
                    $page = Page::with('translations')->where('id',$data->trans_id)->First();
                    $master =
                    [
                        'name' => $page->translations->name,
                        'title' => $page->translations->title,
                        'keywords' => $page->translations->keywords,
                        'description' => $page->translations->description,
                        'img' => 'pages/'.$page->img,
                        'type' => $page->type,
                        'created_at' => $page->created_at,
                        'updated_at' => $page->updated_at
                    ];
                    $post = Post::where('hide_show','1')->orderby('stt','asc')->orderby('id','desc')->paginate(12);
                    return view('frontend.site.all-post',compact('post','page','master'));
                }
                elseif($data->slug == 'tat-ca-dich-vu' || $data->slug == 'all-services'){
                    $page = Page::with('translations')->where('id',$data->trans_id)->First();
                    $master =
                    [
                        'name' => $page->translations->name,
                        'title' => $page->translations->title,
                        'keywords' => $page->translations->keywords,
                        'description' => $page->translations->description,
                        'img' => 'pages/'.$page->img,
                        'type' => $page->type,
                        'created_at' => $page->created_at,
                        'updated_at' => $page->updated_at
                    ];
                    $service = Svcategory::where('hide_show','1')->orderby('stt','asc')->orderby('id','desc')->paginate(9);
                    return view('frontend.site.all-service',compact('page','service','master'));
                }
                elseif($data->slug == 'tat-ca-anh' || $data->slug == 'all-gallery'){
                    $page = Page::with('translations')->where('id',$data->trans_id)->First();
                    $master =
                    [
                        'name' => $page->translations->name,
                        'title' => $page->translations->title,
                        'keywords' => $page->translations->keywords,
                        'description' => $page->translations->description,
                        'img' => 'pages/'.$page->img,
                        'type' => $page->type,
                        'created_at' => $page->created_at,
                        'updated_at' => $page->updated_at
                    ];
                    $data = Gallery::orderby('id','desc')->orderBy('stt','asc')->get();
                    return view('frontend.site.all-gallery',compact('page','data','master'));
                }
                  break;
                case('App\Models\Product');
                $room = Product::with('translations')->with('images')->where('id',$data->trans_id)->FirstOrFail();
                $relatedroom = Product::where('id','!=',$room->id)->where('procatone_id',$room->procatone_id)->get();
                $master =   [
                    'name' => $room->translations->name,
                    'title' => $room->translations->title,
                    'keywords' => $room->translations->keywords,
                    'description' => $room->translations->description,
                    'descriptions' => $room->translations->descriptions,
                    'img' => $room->code.'/'.$room->img,
                    'type' => 'product',
                    'created_at' => $room->created_at,
                    'updated_at' => $room->updated_at
                            ];
                    return view('frontend.site.room',compact('room','relatedroom','master'));
                break;
                case('App\Models\Post');
                $post = Post::with('translations')->where('id',$data->trans_id)->FirstOrFail();
                $relatedpost = Post::with('translations')->where('id','!=',$post->id)->where('newcatone_id',$post->newcatone_id)->orderby('id','desc')->orderby('stt','desc')->get();
                $master =   [
                    'name' => $post->translations->name,
                    'title' => $post->translations->title,
                    'keywords' => $post->translations->keywords,
                    'description' => $post->translations->description,
                    'descriptions' => $post->translations->descriptions,
                    'img' => 'post/'.$post->img,
                    'type' => 'article',
                    'created_at' => $post->created_at,
                    'updated_at' => $post->updated_at
                            ];
                    return view('frontend.site.post',compact('post','relatedpost','master'));
                break;
                case('App\Models\Newcatone');
                $cate = Newcatone::with('translations')->where('id',$data->trans_id)->FirstOrFail();
                $post = Post::where('newcatone_id',$cate->id)->orderby('id','desc')->orderby('stt','desc')->paginate(6);
                $master =   [
                    'name' => $cate->translations->name,
                    'title' => $cate->translations->title,
                    'keywords' => $cate->translations->keywords,
                    'description' => $cate->translations->description,
                    'descriptions' => $cate->translations->descriptions,
                    'img' => 'newcatone/'.$cate->img,
                    'type' => 'article',
                    'created_at' => $cate->created_at,
                    'updated_at' => $cate->updated_at
                            ];
                    return view('frontend.site.catepost',compact('cate','post','master'));
                break;
                case('App\Models\Procatone');
                $cateroom = Procatone::with('translations')->where('id',$data->trans_id)->FirstOrFail();
                $room = Product::with('translations')->with('images')->where('procatone_id',$cateroom->id)->get();
                $master =   [
                    'name' => $cateroom->translations->name,
                    'title' => $cateroom->translations->title,
                    'keywords' => $cateroom->translations->keywords,
                    'description' => $cateroom->translations->description,
                    'descriptions' => $cateroom->translations->descriptions,
                    'img' => 'catecateroom/'.$cateroom->img,
                    'type' => 'article',
                    'created_at' => $cateroom->created_at,
                    'updated_at' => $cateroom->updated_at
                            ];
                    return view('frontend.site.cateroom',compact('cateroom','room','master'));
                break;
                case('App\Models\Svcategory');
                $service = Svcategory::with('translations')->where('id',$data->trans_id)->FirstOrFail();
                $master =   [
                    'name' => $service->translations->name,
                    'title' => $service->translations->title,
                    'keywords' => $service->translations->keywords,
                    'description' => $service->translations->description,
                    'descriptions' => $service->translations->descriptions,
                    'img' => 'svcategory/'.$service->img,
                    'type' => 'article',
                    'created_at' => $service->created_at,
                    'updated_at' => $service->updated_at
                            ];
                return view('frontend.site.service',compact('service','master'));
                break;
                case('App\Models\Gallery');
                $gallery = Gallery::with('translations')->where('id',$data->trans_id)->FirstOrFail();
                $master =   [
                    'name' => $gallery->translations->name,
                    'title' => $gallery->translations->title,
                    'keywords' => $gallery->translations->keywords,
                    'description' => $gallery->translations->description,
                    'descriptions' => $gallery->translations->descriptions,
                    'img' => 'gallery/'.$gallery->img,
                    'type' => 'image',
                    'created_at' => $gallery->created_at,
                    'updated_at' => $gallery->updated_at
                            ];
                return view('frontend.site.gallery',compact('gallery','master'));
                break;
                return redirect()->back();
                default;
            }
        }

        public function checking(Request $request){
            session()->forget('checking');
            session()->forget('order');
            $data = ([
                'from_date' =>date("Y-m-d", strtotime($request->from_date)),
                'to_date' => date("Y-m-d", strtotime($request->to_date)),
                'night' =>  $request->night,
                'room' => $request->room,
            ]);
            if($data['from_date'] > $data['to_date']){
                $msg1 =  __('Chọn sai ngày');
                $msg2 = __('Ngày đến không thể sau ngày đi !');
                alert()->error($msg1,$msg2)->autoClose(5000);
                return redirect()->back();
            }
            $request->session()->put('checking',$data);
            $fromdate = session('checking')['from_date'];
            $todate = session('checking')['to_date'];
            $outroom = Order::whereBetween('from_date',[$fromdate,$todate])->
            OrwhereBetween('to_date',[$fromdate,$todate])
            ->pluck('product_id');
            $room = Product::with('procatone')->whereNotIn('id',$outroom)->get();
            if($room->count() == 0){
                $msg1 = __('Đã hết phòng');
                $msg2 = __('Vui lòng chọn lại thời gian khác !');
                $msg3 = __('Xin cảm ơn !');
                alert()->html('<i>'.$msg1.'</i>'," $msg2 <br> <b> $msg3 </b></br> ",'error')->autoClose(4000);
                return redirect()->back();
            }
            else{
                session()->put('checked','1');
                $msg1 = __('Còn');
                $msg2 = __('phòng');
                $msg3 = __('Chọn phòng bên dưới và đặt ngay !!!');
                alert()->html(''.$msg1.' <i>' .$room->count().'</i> '.$msg2.'',''.$msg3.'','success')->autoClose(3500);
            }
            // Order::with('room')->get()->filter(function($item) {
            //     if (Carbon::now()->between($item->from_date, $item->to_date)) {
            //         $item->room->update(['hide_show'=> 0]);
            //     }
            //     else{
            //         $item->room->update(['hide_show'=> 1]);
            //     }
            //     });
            $request->session()->put('room',$room);
            return view ('frontend.site.booking',compact('room'));

        }

        public function booking(Request $request ,CartHelper $cart){
            $customer = new Customer;
            $customer->name = $request->name ;
            $customer->email = $request->email ;
            $customer->phone = $request->phone ;
            $customer->save();

            if(session()->has('order'))
            foreach ($cart->items as $product_id => $item) {
                $order = new Order;
                $order->code = rand(10000000000,90000000000);
                $order->customer_id = $customer->id;
                $order->product_id = $product_id;
                $order->from_date = session('checking')['from_date'];
                $order->to_date =session('checking')['to_date'];
                $order->note = $request->note;
                $order->save();
            }
            // else{
            //     $order = new Order;
            //     $order->code = rand(10000000000,90000000000);
            //     $order->customer_id = $customer->id;
            //     $order->product_id = json_decode($request->room);
            //     $order->from_date = session('checking')['from_date'];
            //     $order->to_date =session('checking')['to_date'];
            //     $order->note = $request->note;
            //     $order->save();
            // }

        $setting = Setting::get()->first();
        $web = $setting->website;
        $emailadmin = $setting->email;
        $account_email = $request->email;
        $account_name = $request->name;

        $from_date = session('checking')['from_date'];
        $to_date =session('checking')['to_date'];
        if(isset($request->email) && !empty($request->email)){
            Mail::send('frontend.email.booking',[
                'account_name' => $request->name,
                'items' => $cart->items,
                'web' => $setting->website,
                'from_date' => $from_date,
                'to_date' => $to_date
            ], function($mail) use($request,$web,$emailadmin,$from_date,$to_date,$account_email,$account_name){
                $mail->to($account_email, $account_name);
                $mail->cc($emailadmin);
                $mail->subject('Thư thông báo từ Website: '.$web);
            });
        }
        Session::forget('order');
        Session::forget('checking');
        Session::forget('room');
        $msg = __('Đặt phòng thành công');
        $msg2 = __('Chúng tôi sẽ liên lạc lại để xác nhận ngay !');
            alert()->success($msg,$msg2)->autoClose(3500);
            return redirect()->route('frontend.home.index');
        }

        public function bookingview(){
            if(session('checking')){
                return view ('frontend.site.booking');
            }
            else{
                return redirect()-> route('frontend.home.index') ;
            }
        }
    }
