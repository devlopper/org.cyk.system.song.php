<?php

namespace App\Model\UserInterface\Output;

class File extends \App\Model\UserInterface\AbstractComponent {

  public $file;
  public $width = 100;
  public $height = 100;

  public function __construct(array $attributes = array()) {
    parent::__construct($attributes);
    //$this->cascadeStyleSheet->addClass('form-control');
  }

  public function setFile($file){
    $this->file = $file;
  }

}
