<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

require_once(app_path().'\model\AbstractEntity.php');

class TagHierarchy extends AbstractEntity
{
    protected $table = 'taghierarchy';

}
