<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\BaseModel;

class DetailServiceRoom extends BaseModel

{
    public $timestamps = false;

    public function service(){
            return $this->belongsTo(Order::class,'order_id');
    }

}
