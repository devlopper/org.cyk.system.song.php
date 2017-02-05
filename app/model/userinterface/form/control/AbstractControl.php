<?php

namespace App\Model\UserInterface\Form\Control;

abstract class AbstractControl extends \App\Model\UserInterface\AbstractComponent {

  public function __construct(array $attributes = array()) {
    parent::__construct($attributes);
    $this->cascadeStyleSheet->addClass('form-control');
  }

}
