<?php

namespace App\Model\UserInterface\Form;

use App\Service\Business\Utils\LanguageBusiness;

abstract class AbstractForm extends \App\Model\UserInterface\AbstractComponent {

  public $controlCollections = array();
  public $commandCollection;
  public $submitCommand;
  public $editable;
  public $action;
  public $actionable;

  public function __construct(array $attributes = array()) {
    parent::__construct($attributes);

    $this->includedLayout = "include.form.one";
    $this->commandCollection = new \App\Model\UserInterface\Command\Collection();

    $this->action = $attributes['action'];
    $this->editable = $attributes['editable'];
    $this->readOnly = $this->editable == 0 ? "readonly" : "";
    $this->actionable = strcmp(\App\Model\Constant::CRUD_READ,$this->action)!=0;
  }

  public function createSubmitCommand(){
    $this->submitCommand = \App\Model\UserInterface\Command\Command::instanciateOneSubmit(null,'glyphicon glyphicon-save',"btn-success");
    $this->submitCommand->name = (new LanguageBusiness())->findVerb($this->action);
    $this->commandCollection->add($this->submitCommand);
  }

  public function addControlCollection(){
    $controlCollection = new \App\Model\UserInterface\Form\Control\Collection();
    $controlCollection->object = $this;
    $controlCollection->readOnly = $this->readOnly;
    $this->controlCollections[] = $controlCollection;
    return $controlCollection;
  }

  public function setReadOnly($value){
    parent::setReadOnly($value);
    foreach ($this->controlCollections as $controlCollection) {
      $controlCollection->setReadOnly($value);
    }
  }

  /**/

  const FIELD_ACTION = "action";
  const FIELD_EDITABLE = "editable";
  const FIELD_ACTIONABLE = "actionable";
}
