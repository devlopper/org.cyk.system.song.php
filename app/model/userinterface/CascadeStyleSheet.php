<?php

namespace App\Model\UserInterface;

class CascadeStyleSheet {

  public $inline;
  public $class;

  public function addClass($class){
    $this->class = $this->class." ".$class;
  }

}
