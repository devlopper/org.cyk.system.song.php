<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

require_once(app_path().'\model\AbstractEntity.php');

class JoinedTag extends AbstractEntity
{
    protected $table = 'joinedtag';

}
