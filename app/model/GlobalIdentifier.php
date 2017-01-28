<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GlobalIdentifier extends Model{

    protected $table = 'globalidentifier';
    public $primaryKey = "identifier";
    public $incrementing = false;
    public $timestamps = false;
}
