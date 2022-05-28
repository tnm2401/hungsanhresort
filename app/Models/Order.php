<?php

namespace App\Models;

use App\Models\BaseModel;

class Order extends BaseModel
{
    protected $dates = ['from_date','to_date'];

    // protected $fillable = ['ordercode','stt','status','name','email','phone','address','note','province','district','ward','total','order_date','order_note','total','account_id'];

    // public function orderdetail()
    // {
    //     return $this->hasMany(Orderdetail::class);
    // }
    public function orderstatus()
    {
        return $this->belongsTo(Status_order::class,'status');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function account()
    {
    	return $this->belongsTo(Account::class);
    }
    public function room()
    {
    	return $this->belongsTo(Product::class,'product_id');
    }
    public function svroom()
    {
        return $this->hasMany(DetailServiceRoom::class);
    }
}
