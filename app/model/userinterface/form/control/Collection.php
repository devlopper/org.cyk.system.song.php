<?php

namespace App\Model\UserInterface\Form\Control;

class Collection extends \App\Model\UserInterface\AbstractComponent {

  public $object;
  public $controls;

  public function addInputText($attributeName){
    $input = new \App\Model\UserInterface\Form\Control\Input\Text();
    return $this->addInput($input,$attributeName);
  }

  public function addInputTextarea($attributeName){
    $input = new \App\Model\UserInterface\Form\Control\Input\Textarea();
    return $this->addInput($input,$attributeName);
  }

  protected function addInput($input,$attributeName){
    $input->identifier = $attributeName;
    $input->attributeName = $attributeName;
    $input->value = get_class_vars(get_class($this->object))[$input->attributeName];
    $input->name = $attributeName;
    $this->controls[] = $input;
    return $input;
  }

  protected function addControl($control){
    //$control->identifier = generate;
    $control->cascadeStyleSheet->addClass();
    $this->controls[] = $control;
    return $control;
  }
}
