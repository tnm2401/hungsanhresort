<?php
namespace App\Http\Controllers\Backend;
use App\Http\Controllers\ShareController;
use Order;
use Province;
use District;
use Ward;
use Validate;
use Status_order;
use ServiceRoom;
use Carbon\Carbon;
use Illuminate\Support\Str;
use DetailServiceRoom;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use DB;
use View;

class CartController extends ShareController
{

    public function index(){
        $carts = Order::orderBy('status','desc')->get();
        $data['status_order'] = Status_order::orderBy('id','asc')->get();
        return view('backend.cart.index', compact('carts','data'));
    }
    public function create(){
        $carts = Order::all();
        return view('frontend.cart.index', compact('carts'));
    }
    public function edit(Request $request, $id){

            $data['cart'] = Order::find($id);
            $data['status_order'] = Status_order::get();
            $data['night'] = $data['cart']->from_date->diffInDays($data['cart']->to_date);

            // $data['detailsv'] =  DetailServiceRoom::where('order_id',$id)
            // ->selectRaw('name, sum(quantity) as total')
            // ->groupBy('name')
            // ->get();
            $data['detailsv'] =  DetailServiceRoom::where('order_id',$id)
            ->get();
            $data['total_price_service'] = $data['cart']->svroom->sum('totalprice');
            $data['price_room'] = $data['night'] * $data['cart']->room->procatone->selling_price;
            $data['vat'] = (( $data['total_price_service']+  $data['price_room']) * $data['cart']->vat ) / 100;
            $data['total_invoice'] = $data['total_price_service'] + $data['price_room'] + $data['vat'];
            $data['cart']->total = $data['total_invoice'];
            $data['cart']->save();
        return view('backend.cart.edit', compact('data'));

    }
    public function update(Request $request, $id){

        $cart = Order::find($id);
        $cart->from_date = $request->from_date;
        $cart->to_date = $request->to_date;
        $cart->note        = $request->note;
        $cart->status      = $request->status;
        $cart->vat = $request->vat;
        $cart->update();
        if ($cart->update()) {
            alert()->success('Thành công','Cập nhật hóa đơn thành công');
            return redirect()->back();
        }
            alert()->error("Thất bại",'Cập nhật hóa đơn bị lỗi ');
            return redirect()->back();
    }

    public function updatedate(Request $request){
        $id = $request->id;
        if($request->from_date > $request->to_date){
            $msg1 =  __('Chọn sai ngày');
            $msg2 = __('Ngày đến không thể sau ngày đi !');
            return response()->json(['msg1' => $msg1,'msg2'=>$msg2]);
        }
        $cart = Order::find($id);
        $count_night_first = $cart->from_date->diffInDays($cart->to_date);
        $price_one_night = $cart->total / $count_night_first;
        $total_update = $price_one_night * $request->date;
        $cart->from_date = $request->from_date;
        $cart->to_date = $request->to_date;
        $cart->total = $total_update;
        $cart->save();
        return response()->json(['status'=>'success','price' => number_format($cart->total)]);
    }

    public function destroy(Request $request, $id){
        $cart = Order::find($id);
        if ($cart){
            $cart->delete();
            alert()->success('Xóa thông tin Đơn hàng thành công !');
            return redirect()->route('backend.cart.index');
        }
            alert()->error('Xóa thông tin Đơn hàng lỗi');
            return redirect()->route('backend.cart.index');
    }

    public function addservice(Request $request){
        $detailsvroom = new DetailServiceRoom;
        $detailsvroom->order_id = $request->order_id;
        $detailsvroom->unit = $request->unit;
        $detailsvroom->name = $request->name;
        $detailsvroom->quantity = $request->quantity;
        $detailsvroom->price = $request->price;
        $detailsvroom->totalprice = $request->quantity * $request->price;
        $detailsvroom->save();
        return response()
        ->json(['status'=>'success']);
    }


    public function deleteservice(Request $request){
        $id = $request->id;
        $detailsvroom = DetailServiceRoom::find($id);
        $detailsvroom->delete();
        return response()
        ->json(['status'=>'success']);
    }

    public function updateservice(Request $request){
        $id = $request->id;
        $detailsvroom = DetailServiceRoom::find($id);
        $detailsvroom->quantity = $request->quantity;
        $detailsvroom->totalprice = $request->quantity * $detailsvroom->price;
        $detailsvroom->save();
        return response()
        ->json(['update_price'=>number_format($detailsvroom->totalprice)]);
    }

    public function print($id){
        $data['cart'] = Order::find($id);
        $data['status_order'] = Status_order::get();
        $data['serviceroom'] = ServiceRoom::get();
        $data['night'] = $data['cart']->from_date->diffInDays($data['cart']->to_date);

        $data['detailsv'] =  DetailServiceRoom::where('order_id',$id)
        ->get();
        $data['total_price_service'] = $data['cart']->svroom->sum('totalprice');
        $data['price_room'] = $data['night'] * $data['cart']->room->procatone->price;
        $data['vat'] = (( $data['total_price_service']+  $data['price_room']) * $data['cart']->vat ) / 100;
        $data['total_invoice'] = $data['total_price_service'] + $data['price_room'] + $data['vat'];
        $data['cart']->total = $data['total_invoice'];
        $data['cart']->save();
        return view ('backend.cart.print',compact('data'));
    }


    public function postSearchTable(Request $request){
        $lang = [
            'fromday.required' => 'Vui lòng chọn ngày bắt đầu !',
            'today.required' => 'Vui lòng chọn ngày kết thúc !',
            'status.required' => 'Vui lòng chọn tình trạng !',
            'today.after_or_equal' => 'Ngày kết thúc phải lớn hơn hoặc bằng ngày bắt đầu !',
        ];
        $request->validate([
            'fromday' => 'required|date',
            'today' => 'required|date|after_or_equal:fromday',
            'status' => 'required',
        ], $lang);
        $data['status_order'] = Status_order::orderBy('id','asc')->get();
        $from = Carbon::parse($request->fromday)->startOfDay(); //2016-09-29 00:00:00.000000
        $to = Carbon::parse($request->today)->endOfDay(); //2016-09-29 23:59:59.000000
        $status = $request->status;
        if($status == 0){
            $carts = Order::whereBetween('from_date', [$from, $to])->whereBetween('to_date',[$from,$to])->get();
        }

        else{
            $carts = Order::whereBetween('from_date', [$from, $to])->whereBetween('to_date',[$from,$to])->where('status',$status)->get();
        }
        // $returnHTML = view('backend.orders.ajax-search')->with('orders', $orders)->render();
        return view('backend.cart.ajax-search', compact('carts','from','to','status','data'));
    }

}
