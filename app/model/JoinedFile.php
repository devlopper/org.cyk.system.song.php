<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

require_once(app_path().'\model\AbstractEntity.php');

class JoinedFile extends AbstractEntity
{
    protected $table = 'joinedfile';

}
