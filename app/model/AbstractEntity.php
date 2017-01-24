<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AbstractEntity extends Model
{
    public $primaryKey = "identifier";

    public $timestamps = false;
}
