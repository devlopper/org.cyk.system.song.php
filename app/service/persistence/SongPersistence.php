<?php

namespace App\Service\Persistence;

require_once(app_path().'\service\persistence\AbstractPersistence.php');

class SongPersistence extends \App\Service\Persistence\AbstractNotGlobalIdentifierPersistence {

  protected function getEntityModel(){
      return \App\Model\Song;
  }

  protected function getEntityClass(){
      return \App\Model\Song::class;
  }

  protected function getTableName(){
    return "song";
  }

}
