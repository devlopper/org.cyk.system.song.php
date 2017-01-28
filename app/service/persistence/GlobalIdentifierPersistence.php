<?php

namespace App\Service\Persistence;

require_once(app_path().'\service\persistence\AbstractPersistence.php');

class GlobalIdentifierPersistence extends \App\Service\Persistence\AbstractPersistence {

    protected function getEntityModel(){
        return \App\Model\GlobalIdentifier;
    }

    protected function getEntityClass(){
        return \App\Model\GlobalIdentifier::class;
    }

    protected function getTableName(){
      return "globalidentifier";
    }
}
