<?php

namespace App\Model\UserInterface\Form\Control;

use \App\Model\UserInterface\Form\Control\Input\File;
use \App\Model\UserInterface\Form\Control\Input\Hidden;
use \App\Model\UserInterface\Form\Control\Input\Text;
use \App\Model\UserInterface\Form\Control\Input\Textarea;

class Collection extends \App\Model\UserInterface\AbstractComponent {

  public $object;
  public $controls;
  public $hiddenInputs;

  public function addInputFile($attributeName){
    $input = new File();
    $input = $this->addInput($input,$attributeName);
    if($this->object->isReadOnly()){
      $input->exporter->setFile($this->object->identifiable);
    }
    return $input;
  }

  public function addInputHidden($attributeName){
    $input = new Hidden();
    return $this->addInput($input,$attributeName);
  }

  public function addInputText($attributeName){
    $input = new Text();
    return $this->addInput($input,$attributeName);
  }

  public function addInputTextarea($attributeName){
    $input = new Textarea();
    return $this->addInput($input,$attributeName);
  }

  protected function addInput($input,$attributeName){
    $input->identifier = $attributeName;
    $input->attributeName = $attributeName;
    $input->value = get_object_vars($this->object)[$input->attributeName];
    //echo $attributeName." : ".get_object_vars($this->object)[$input->attributeName]."\n";
    //echo $attributeName." : ".$this->object->identifier."\n";
    $input->name = trans('field.'.$attributeName);
    if($input instanceof Hidden){
      $hiddenInputs[] = $input;
    }
    $input = $this->addControl($input);
    return $input;
  }

  protected function addControl($control){
    //$control->identifier = generate;
    $control->readOnly = $this->readOnly;
    //$control->cascadeStyleSheet->addClass();
    $this->controls[] = $control;
    return $control;
  }

  public function setReadOnly($value){
    parent::setReadOnly($value);
    foreach ($this->controls as $control) {
      $control->setReadOnly($value);
    }
  }
}
