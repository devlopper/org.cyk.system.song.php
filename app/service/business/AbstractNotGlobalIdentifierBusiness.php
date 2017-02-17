<?php

namespace App\Service\Business;

abstract class AbstractNotGlobalIdentifierBusiness extends \App\Service\Business\AbstractIdentifiableBusiness {

  public function findByCode($code){
    return $this->getPersistence()->readByCode($code);
  }

  /* Create */

  public function create($entity){
    $this->executeInTransaction(function($entity){
      $createdGlobalIdentifier = (new \App\Service\Business\GlobalIdentifierBusiness())->create($entity->getGlobalIdentifierInstance());
      $entity->getGlobalIdentifierInstance()->globalidentifier = $createdGlobalIdentifier;
      $entity->globalidentifier = $createdGlobalIdentifier;// setting one to one relationship
      $this->getPersistence()->create($entity);
    },array($entity));
  }

  /* Update */

  public function update($entity){
    $this->executeInTransaction(function($entity){
      (new \App\Service\Business\GlobalIdentifierBusiness())->update($entity->getGlobalIdentifierInstance());
      $this->getPersistence()->update($entity);
    },array($entity));
  }

  /* Delete */

  public function delete($entity){
    $this->executeInTransaction(function($entity){
      $this->getPersistence()->delete($entity);
      (new \App\Service\Business\GlobalIdentifierBusiness())->delete($entity->getGlobalIdentifierInstance());
    },array($entity));
  }

  /**/

  public function instanciateOne(){
    $identifiable = parent::instanciateOne();
    return $identifiable;
  }

}
