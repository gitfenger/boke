<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    public $table = 'config';

    public $primaryKey = "conf_id";

//    public $fillable = ['']

    public $guarded = [];

    public $timestamps = false;
}
