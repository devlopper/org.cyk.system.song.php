<?php

namespace App\Model\Identifiable;

abstract class AbstractIdentifiableDto {

    public $identifiable;
    public $globalIdentifier;
    public $identifier;
    public $code;
    public $name;

    public function setIdentifiable($identifiable){
      $this->identifiable = $identifiable;
      $this->globalIdentifier = $identifiable->globalidentifier;
      $this->identifier = $identifiable->identifier;
      $this->code = $identifiable->getGlobalIdentifier->code;
      $this->name = $identifiable->getGlobalIdentifier->name;
    }

    public function getIdentifiable(){
      return $this->identifiable;
    }

}
