<?php

namespace App\Service\Persistence;

require_once(app_path().'\service\AbstractService.php');

abstract class AbstractNotGlobalIdentifierPersistence extends \App\Service\Persistence\AbstractPersistence {

    public function read($identifier){
      $identifiable = parent::read($identifier);
      return $this->afterReadOne($identifiable);
    }

    public function readByCode($code){
      $class = $this->getEntityClass();
      $tableName = $this->getTableName();
      $arguments = $this->getReadArguments();
      /*$arguments->columns = $arguments->columns.','.$tableName.'.identifier as identifier';
      $arguments->columns = $arguments->columns.','.'globalidentifier.identifier as globalidentifier';
      $identifiable = $this->getSelect($arguments)
        ->join('globalidentifier', $tableName.'.globalidentifier', '=', 'globalidentifier.identifier')
        ->where('globalidentifier.code', $code)
        ->first();*/
      //var_dump($arguments->columns);
      $columns = [];
      foreach ($arguments->columns as $column)
      //foreach ($this->readByCodeColumns() as $column)
        $columns[] = $column;
      $columns[] = $tableName.'.identifier as identifier';
      $columns[] = 'globalidentifier.identifier as globalidentifier';

      $identifiable = $class::select($columns)
        ->join('globalidentifier', $tableName.'.globalidentifier', '=', 'globalidentifier.identifier')
        ->where('globalidentifier.code', $code)
        ->first();

      $identifiable = $this->afterReadOne($identifiable);
      return $identifiable;
    }

    public function readByCodeColumns(){
      return ['*'];
    }

    protected function afterReadOne($identifiable){
      if($identifiable && $identifiable->globalidentifier)
        $identifiable->setGlobalIdentifierInstance( (new \App\Service\Persistence\GlobalIdentifierPersistence())->read($identifiable->globalidentifier) ) ;
      return $identifiable;
    }

    public function update($entity){
      $class = $this->getEntityClass();
      //$entity->setGlobalIdentifierInstance(null);
      return $entity->save();

    }

}
