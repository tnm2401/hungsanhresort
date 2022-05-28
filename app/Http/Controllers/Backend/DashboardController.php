<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Illuminate\Http\Request;
use DB;
use Product;
use App\Models\Counter;
use Carbon\Carbon;
use Session;
use Order;
class DashboardController extends ShareController
{
    public function index()
    {

        $date =  Carbon::parse(now()->today()->toDateString());
        $month_of_year =  Carbon::now()->month;
        $year =  Carbon::now()->year;
        if ($month_of_year < 10) {
            $get_month = Carbon::now()->month;
            $month = '0'.$get_month;
        }else {
            $month =  Carbon::now()->month;
        }
        $data['room_all'] = Product::orderBy('code')->get();
        foreach($data['room_all'] as $d){
            $data['room'] = Order::with('room')->where('from_date','<=',Carbon::parse($date)->startOfDay() )->where('to_date', '>=',Carbon::parse($date)->addHours(12))->get();
            foreach($data['room'] as $r){
                if($r->room->code == $d->code){
                    $d['order'] = $r->id;
                    $d->hide_show = 0;
                }
            }
        }
        // dd($data['room']);

        $data['room_this_month'] = Order::whereMonth('from_date', date('m'))
        ->whereYear('from_date', date('Y'))->count();
        $data['room_last_month'] = Order::whereMonth('from_date', date('m',strtotime("-1 month")))
        ->whereYear('from_date',date('Y'))->count();
        if($data['room_last_month'] != NULL){
            $data['percent'] = ($data['room_this_month'] / $data['room_last_month'] ) * 100;
        }
        $data['percent'] = ($data['room_this_month'] / 1 ) * 100;
        return view('backend.dashboard.index',compact('month','year','data'));



    }
        public function counter(){
            $month =  Carbon::now()->month;
            $year =  Carbon::now()->year;
            $get_all_colum_counter =  Counter::select('id','time', DB::raw("DATE_FORMAT(time, '%d') days"))
            ->where(DB::raw("DATE_FORMAT(time, '%Y')"),'=',$year)
            ->where(DB::raw("DATE_FORMAT(time, '%m')"),'=',$month)
            ->get()
            ->groupBy('days');
            $count_day_duplicate = [];
            $count_day = [];
            foreach ($get_all_colum_counter as $key => $value) {
                $count_day_duplicate[(int)$key] = count($value);
            }
            for($i = 1; $i <= Carbon::now()->daysInMonth; $i++){
                if(!empty($count_day_duplicate[$i])){
                    $count_day[$i] = $count_day_duplicate[$i];
                }else{
                    $count_day[$i] = 0;
                }
                $respon[] = array($i, $count_day[$i]);
            }
            return response()->json($respon);
        }

        public function shortday(Request $resquest){
            $month = $resquest->get('getmonth');
            $year = $resquest->get('getyear');
            $timeget = "$year-$month";
            $get_short_colum_counter =  Counter::select('id','time', DB::raw("DATE_FORMAT(time, '%d') days"))
            ->where(DB::raw("DATE_FORMAT(time, '%Y')"),'=',$year)
            ->where(DB::raw("DATE_FORMAT(time, '%m')"),'=',$month)
            ->get()
            ->groupBy('days');
            $short_count_day_duplicate = [];
            $short_count_day = [];
            foreach ($get_short_colum_counter as $keyz => $valueshort) {
                $short_count_day_duplicate[(int)$keyz] = count($valueshort);
            }
            for($i = 1; $i <= Carbon::create($year,$month,1)->daysInMonth; $i++){
                if(!empty($short_count_day_duplicate[$i])){
                    $short_count_day[$i] = $short_count_day_duplicate[$i];
                }else{
                    $short_count_day[$i] = 0;
                }
                $response[] = array($i, $short_count_day[$i]);
            }
            return response()->json($response);
        }

        public function dialyGuestPerMonth()
        {
            $year = Carbon::now()->format('Y');
            $month = Carbon::now()->format('m');
            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            $day_array = array();
            $guests_count_array = array();

            for ($i = 1; $i <= $days_in_month; $i++) {
                array_push($day_array, $i);
                array_push($guests_count_array, $this->countGuestsPerDay($year, $month, $i));
            }

            $max_no = max($guests_count_array);
            $max = round(($max_no + 10 / 2) / 10) * 10;

            $dialyGuestPerMonth = array(
                'day' => $day_array,
                'guest_count_data' => $guests_count_array,
                'max' => $max
            );

            return $dialyGuestPerMonth;
        }

        private function countGuestsPerDay($year, $month, $day)
        {
            $time = strtotime($month . '/' . $day . '/' . $year);
            $date = date('Y-m-d', $time);
            $room_count = Order::where([['from_date', '<=', $date], ['to_date', '>=', $date]])->count();
            return $room_count;
        }

        public function MoneyPerMonth()
        {
            $year = Carbon::now()->format('Y');
            $month = Carbon::now()->format('m');
            $days_in_month = cal_days_in_month(CAL_GREGORIAN, $month, $year);

            $day_array = array();
            $guests_count_array = array();

            for ($i = 1; $i <= $days_in_month; $i++) {
                array_push($day_array, $i);
                array_push($guests_count_array, $this->countMoneyPerDay($year, $month, $i));
            }

            $max_no = max($guests_count_array);
            $max = round(($max_no + 10 / 2) / 10) * 10;

            $dialyGuestPerMonth = array(
                'day' => $day_array,
                'money_count_data' => $guests_count_array,
                'max' => $max
            );

            return $dialyGuestPerMonth;
        }

        private function countMoneyPerDay($year, $month, $day)
        {
            $time = strtotime($month . '/' . $day . '/' . $year);
            $date = date('Y-m-d', $time);

            $room_count = Order::selectRaw("COUNT(*) value, DATE_FORMAT(updated_at, '%Y-%m-%e') date")->where('status',2)
            ->groupBy(DB::raw('date'))
            ->select( DB::raw('DATE(created_at) as date'),
                     DB::raw('SUM(total) as total'))
             ->get();

            return $room_count;
        }

        //  private function countMoneyPerDay($year, $month, $day)
        // {
        //     $data = array();
        //    $quanty = Order::selectRaw("COUNT(*) value, DATE_FORMAT(updated_at, '%Y-%m-%e') date")->where('status',2)
        //    ->groupBy(DB::raw('date'))
        //    ->select( DB::raw('DATE(created_at) as date'),
        //             DB::raw('SUM(total) as total'))
        //     ->get();
        //     foreach($quanty as $q){
        //         $date = $q->date;
        //         $value = $q->total;
        //         // dd($value);
        //         $data[] = array('date' => $date, 'steps' => json_decode($value));
        //     }
        //     return response()->json($data);
        // }
}
