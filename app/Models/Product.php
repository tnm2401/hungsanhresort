<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
class Product extends BaseModel
{
    protected $fillable = ['id','type','hide_show','code','stt','is_featured','is_new','user_id','img','procatone_id','tags','bed','person','cover'];


    public function images()
    {
        return $this->hasMany(Productsimage::class)->whereType(NULL);
    }

    public function procatone () {
        return $this->belongsTo(Procatone::class);
    }


    public function translations()
    {
        return $this->morphOne(Translation::class,'trans')->whereLocale(session('locale'));
    }

    public function delete_trans()
    {
    return $this->hasMany(Translation::class,'trans_id')->whereTrans_type(Product::class);
    }

    public function get_tags(){
        return $this->belongsToMany(Tag::class);
    }

}
