<?php

namespace App\Model\Identifiable;

use Illuminate\Database\Eloquent\Model;

class GlobalIdentifier extends Model{

    protected $table = 'globalidentifier';
    public $primaryKey = "identifier";
    public $incrementing = false;
    public $timestamps = false;
}
