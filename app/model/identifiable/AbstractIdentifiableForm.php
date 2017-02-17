<?php

namespace App\Model\Identifiable;

use Illuminate\Http\Request;

abstract class AbstractIdentifiableForm extends \App\Model\UserInterface\Form\AbstractForm {

    public $identifiable;

    public $identifier;
    public $globalIdentifier;
    public $code;
    public $name;

    protected abstract function getIdentifiableClassName();

    public function __construct(array $attributes = array()) {
      parent::__construct($attributes);
    }

    public function setIdentifiable($identifiable){
      $this->identifiable = $identifiable;
      $this->readFromIdentifiable();
    }

    public function getIdentifiable(){
      return $this->identifiable;
    }

    public function readFromIdentifiable(){
      $this->identifier = $this->identifiable->identifier;
      $this->globalIdentifier = $this->identifiable->globalidentifier;
      if($this->identifiable->getGlobalIdentifier){
        $this->code = $this->identifiable->getGlobalIdentifier->code;
        $this->name = $this->identifiable->getGlobalIdentifier->name;
      }
    }

    public function writeToIdentifiable(){
      $this->identifiable->identifier = $this->identifier;
      $this->identifiable->globalidentifier = $this->globalIdentifier;
      if($this->identifiable->getGlobalIdentifierInstance()){
        $this->identifiable->getGlobalIdentifierInstance()->code = $this->code;
        $this->identifiable->getGlobalIdentifierInstance()->name = $this->name;
      }
    }

    public function setFromRequest(Request $request){
      foreach(array_keys($request->all()) as $parameterName){
        $this->$parameterName = $request->all()[$parameterName];
      }
      if(empty($this->identifier))
        $this->identifier = null;
    }

    public function configureCrud(){
      $this->createSubmitCommand();
      $this->submitCommand->action = \App\Utils::getIdentifiableControllerClassName($this->getIdentifiableClassName())
        .'@crudOne';
    }

    const FIELD_IDENTIFIABLE = "identifiable";
}
