<?php

namespace App\Service\Persistence\File;

class JoinedFilePersistence extends \App\Service\Persistence\AbstractNotGlobalIdentifierPersistence {

  public function getEntityModel(){
      return \App\Model\Identifiable\File\JoinedFile;
  }

  public function getEntityClass(){
      return \App\Model\Identifiable\File\JoinedFile::class;
  }

  public function getTableName(){
    return "joinedfile";
  }

}
