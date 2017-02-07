<?php

namespace App\Service\Business;

require_once(app_path().'\service\business\AbstractBusiness.php');

class GlobalIdentifierBusiness extends \App\Service\Business\AbstractBusiness {

    public function getIdentifiableClassName(){
        return "\App\Model\Identifiable\GlobalIdentifier";
    }

    public function create($entity){
      $identifier = str_replace('.','',uniqid((new \ReflectionClass($entity))->getShortName()."_"
        ,true))."_".rand(1000000,9999999);
      $entity->identifier = $identifier;
      $this->executeInTransaction(function($entity){
        $this->getPersistence()->create($entity);
      },array($entity));
      return $identifier;
    }

    /* Update */

    public function update($entity){
      $this->executeInTransaction(function($entity){
        $this->getPersistence()->update($entity);
      },array($entity));
    }

    /* Delete */

    public function delete($entity){
      $this->executeInTransaction(function($entity){
        $this->getPersistence()->delete($entity);
      },array($entity));
    }

}
