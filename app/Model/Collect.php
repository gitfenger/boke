<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Collect extends Model
{
    public $table = 'collect';

    public $primaryKey = "id";

    public $guarded = [];

    public $timestamps = false;
}
