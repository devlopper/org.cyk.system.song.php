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
      $identifiable = $class::select('*',$tableName.'.identifier as identifier','globalidentifier.identifier as globalidentifier')
        ->join('globalidentifier', $tableName.'.globalidentifier', '=', 'globalidentifier.identifier')
        ->where('globalidentifier.code', $code)
        ->first();
      $identifiable = $this->afterReadOne($identifiable);
      return $identifiable;
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
