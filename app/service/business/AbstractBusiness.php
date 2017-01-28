<?php

namespace App\Service\Business;

require_once(app_path().'\service\AbstractService.php');

abstract class AbstractBusiness extends \App\Service\AbstractService {

  protected abstract function getPersistence();

  protected function executeInTransaction($function,$parameters){
    try {
      $function($parameters[0],count($parameters)>1?$parameters[1]:0);
      \DB::commit();
    } catch (\Exception $e) {
      \DB::rollback();
      throw $e;
    }
  }

  /* Create */

  /*public function create($entity){
    $this->executeInTransaction(function($entity){
      $this->getPersistence()->create($entity);
    },array($entity));
    return $entity;
  }*/

  /* Find */

  public function find($identifier){
    return $this->getPersistence()->read($identifier);
  }

  public function findByCode($code){
    return $this->getPersistence()->readByCode($code);
  }

  /* Update */

  /*public function update($entity){
    return $this->getPersistence()->save();
  }*/

  /* Delete */

  /*public function delete($entity){
    return $this->getPersistence()->delete();
  }*/

  /* Count */

  public function countAll(){
    return $this->getPersistence()->countAll();
  }
}
