<?php

namespace App\Service\Persistence\Song;

require_once(app_path().'\service\persistence\AbstractPersistence.php');

class SongPersistence extends \App\Service\Persistence\AbstractNotGlobalIdentifierPersistence {

  public function getEntityModel(){
      return \App\Model\Identifiable\Song\Song;
  }

  public function getEntityClass(){
      return \App\Model\Identifiable\Song\Song::class;
  }

  public function getTableName(){
    return "song";
  }

}
