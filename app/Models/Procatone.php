<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\BaseModel;

class Procatone extends BaseModel

{
    public function images()
    {
        return $this->hasMany(Productsimage::class,'product_id')->whereType(2);
    }
    public function translations()
    {
        return $this->morphOne(Translation::class,'trans')->whereLocale(session('locale'));
    }

    public function delete_trans()
    {
    return $this->hasMany(Translation::class,'trans_id')->whereTrans_type(Procatone::class);
    }

    public function parent()
    {
        return $this->belongsTo(Procatone::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
    public function roombooking()
    {
        return $this->hasMany(Product::class)->where('hide_show','1');
    }
}
