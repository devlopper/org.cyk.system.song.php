<?php

namespace App\Service\Business;

require_once(app_path().'\service\business\AbstractBusiness.php');

class SongBusiness extends \App\Service\Business\AbstractNotGlobalIdentifierBusiness {

    public function getDtoClass(){
        return \App\Model\Identifiable\Song\SongDto::class;
    }

    public function getPersistence(){
        return new \App\Service\Persistence\SongPersistence();
    }

}
