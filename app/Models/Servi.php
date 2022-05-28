<?php

namespace App\Models;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;

class Servi extends BaseModel
{
    protected $fillable = ['id','type','view_count','name_vi','name_en','name_cn','video','video_code','stt','article_type_id','svcategory_id','descriptions_vi','descriptions_en','descriptions_cn','is_featured','is_new','hide_show','content_vi','content_en','content_cn','content1_vi','content1_en','content1_cn','slug','slug_vi','slug_en','slug_cn','title_vi','title_en','title_cn','keywords_vi','keywords_en','keywords_cn','description_vi','description_en','description_cn','img','img1'];
}
