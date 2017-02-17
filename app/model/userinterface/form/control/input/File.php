<?php

namespace App\Model\UserInterface\Form\Control\Input;

class File extends \App\Model\UserInterface\Form\Control\Input\AbstractInput {

  public $exporter;

  public function __construct(array $attributes = array()) {
    parent::__construct($attributes);
    //$this->cascadeStyleSheet->addClass('form-control');
    $this->exporter = new \App\Model\UserInterface\Output\File();
  }

}
