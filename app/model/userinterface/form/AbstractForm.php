<?php

namespace App\Model\UserInterface\Form;

abstract class AbstractForm extends \App\Model\UserInterface\AbstractComponent {

  public $controlCollections = array();
  public $commandCollection;
  public $submitCommand;

  public function __construct(array $attributes = array()) {
    parent::__construct($attributes);
    $this->includedLayout = "include.form.one";
    $this->commandCollection = new \App\Model\UserInterface\Command\Collection();

    $this->submitCommand = new \App\Model\UserInterface\Command\Command();
    $this->submitCommand->name = 'Enregister le chant';
    $this->submitCommand->type = 'submit';
    $this->submitCommand->cascadeStyleSheet->addClass("btn-success");
    $this->commandCollection->add($this->submitCommand);

  }

  public function addControlCollection(){
    $controlCollection = new \App\Model\UserInterface\Form\Control\Collection();
    $controlCollection->object = $this;
    $this->controlCollections[] = $controlCollection;
    return $controlCollection;
  }

}
