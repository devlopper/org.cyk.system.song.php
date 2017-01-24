<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

require_once('\app\model\AbstractEntity.php');

class File extends AbstractEntity
{
    protected $table = 'file';

}
