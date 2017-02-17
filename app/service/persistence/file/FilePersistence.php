<?php

namespace App\Service\Persistence\File;

class FilePersistence extends \App\Service\Persistence\AbstractNotGlobalIdentifierPersistence {

  public function getEntityModel(){
      return \App\Model\Identifiable\File\File;
  }

  public function getEntityClass(){
      return \App\Model\Identifiable\File\File::class;
  }

  public function getTableName(){
    return "file";
  }

  public function getReadArguments(){
    $arguments = new \App\Service\Persistence\ReadArguments();
    $arguments->columns[] = 'file.identifier';
    $arguments->columns[] = 'file.globalidentifier';
    $arguments->columns[] = 'file.extension';
    $arguments->columns[] = 'file.mime';
    $arguments->columns[] = 'file.url';
    return $arguments;
  }

}
