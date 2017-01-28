<?php

namespace App\Service\Business;

require_once(app_path().'\service\business\AbstractBusiness.php');

class SongBusiness extends \App\Service\Business\AbstractNotGlobalIdentifierBusiness {

    protected function getPersistence(){
        return new \App\Service\Persistence\SongPersistence();
    }

}
