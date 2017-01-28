<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

require_once(app_path().'\model\AbstractEntity.php');

class Song extends AbstractEntity {

    protected $table = 'song';

    /*protected $attributes = ['code', 'name','lyrics'];

    protected $fillable = [
        'identifier',
        'globalidentifier',
        'code',
        'name',
        'lyrics',
    ];*/

    /**/

}
