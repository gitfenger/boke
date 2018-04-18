<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    public $table = 'article';

    public $primaryKey = "art_id";

//    public $fillable = ['']

    public $guarded = [];

    public $timestamps = false;

    public function cate()
    {
        return $this->belongsTo('App\Model\Cate','cate_id','cate_id');
    }
}
