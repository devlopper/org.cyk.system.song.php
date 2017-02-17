<?php

namespace App\Service\Business;

abstract class AbstractIdentifiableBusiness extends \App\Service\Business\AbstractBusiness {

  protected function executeInTransaction($function,$parameters){
    try {
      $function($parameters[0],count($parameters)>1?$parameters[1]:0);
      \DB::commit();
    } catch (\Exception $e) {
      \DB::rollback();
      throw $e;
    }
  }

  public abstract function getIdentifiableClassName();

  protected function getPersistence(){
    $class = \App\Utils::getIdentifiablePersistenceClassName($this->getIdentifiableClassName());
    return new $class;
  }

  /* Create */

  public function create($entity){}

  /* Find */

  public function find($identifier){
    return $this->getPersistence()->read($identifier);
  }

  public function findWithArguments($identifier,$arguments){
    return $this->getPersistence()->readWithArguments($identifier,$arguments);
  }

  public function findAll(){
    return $this->getPersistence()->readAll();
  }

  public function findAllUsingPagination($pagination){
    return $this->getPersistence()->readAllUsingPagination($pagination);
  }

  public function findByCode($code){
    return $this->getPersistence()->readByCode($code);
  }

  /* Update */

  public function update($entity){}

  public function save($entity){
    if(empty($entity->identifier)){
        $this->create($entity);
    }else{
        $this->update($entity);
    }
  }

  /* Delete */

  /*public function delete($entity){
    return $this->getPersistence()->delete();
  }*/

  /* Count */

  public function countAll(){
    return $this->getPersistence()->countAll();
  }

  public function countAllUsingPagination($pagination){
    return $this->getPersistence()->countAllUsingPagination($pagination);
  }

  /* Instanciate */

  public function instanciateOne(){
    $class =  $this->getIdentifiableClassName();
    $identifiable = new $class;
    return $identifiable;
  }
}
