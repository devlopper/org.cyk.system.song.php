<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

require_once(app_path().'\model\AbstractIdentifiable.php');

class JoinedTag extends AbstractIdentifiable
{
    protected $table = 'joinedtag';

}
