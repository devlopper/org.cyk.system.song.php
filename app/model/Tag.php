<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

require_once('\app\model\AbstractEntity.php');

class Tag extends AbstractEntity
{
    protected $table = 'tag';

}
