<?php

namespace App\Model\Identifiable;

abstract class AbstractIdentifiableForm extends \App\Model\UserInterface\Form\AbstractForm {

    public $identifiable;

    public $identifier;
    public $globalIdentifier;
    public $code;
    public $name;

    public function setIdentifiable($identifiable){
      $this->identifiable = $identifiable;
      $this->identifier = $identifiable->identifier;
      $this->globalIdentifier = $identifiable->globalidentifier;
      if($this->identifiable->getGlobalIdentifier){
        $this->code = $this->identifiable->getGlobalIdentifier->code;
        $this->name = $this->identifiable->getGlobalIdentifier->name;
      }
    }

    public function getIdentifiable(){
      return $this->identifiable;
    }

}
