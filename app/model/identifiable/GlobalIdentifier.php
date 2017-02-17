<?php

namespace App\Model\Identifiable;

use Illuminate\Database\Eloquent\Model;

class GlobalIdentifier extends Model{

    protected $table = 'globalidentifier';
    public $primaryKey = "identifier";
    public $incrementing = false;
    public $timestamps = false;

    /**/

    const FIELD_CODE = "code";
    const FIELD_NAME = "name";

}
