<?php

namespace App\Service\Persistence;

require_once(app_path().'\service\persistence\AbstractPersistence.php');

class GlobalIdentifierPersistence extends \App\Service\Persistence\AbstractPersistence {

    public function getEntityModel(){
        return \App\Model\Identifiable\GlobalIdentifier;
    }

    public function getEntityClass(){
        return \App\Model\Identifiable\GlobalIdentifier::class;
    }

    public function getTableName(){
      return "globalidentifier";
    }
}
