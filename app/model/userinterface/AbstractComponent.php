<?php

namespace App\Model\UserInterface;

abstract class AbstractComponent {

  public $identifier;
  public $name;
  public $cascadeStyleSheet;
  public $gotoLink;
  public $includedLayout;
  public $icon;
  public $readOnly;
  public $rendered;
  public $tooltip;

  public $parent;
  public $children;

  public function __construct(array $attributes = array()) {
    $this->rendered = true;
    $this->cascadeStyleSheet = new \App\Model\UserInterface\CascadeStyleSheet();
    $this->includedLayout = str_replace("App\Model\UserInterface","include",$this->getIncludedLayoutClassName());
    //$this->includedLayout = "include"./form/control/input/.strtolower((new \ReflectionClass($this))->getShortName());
  }

  protected function getIncludedLayoutClassName(){
    return get_class($this);
  }

  public function getHtml(){
    return null;
  }

  public static function concatenateHtml($string,$command){
    return $string . $command->getHtml();
  }

  public function setReadOnly($value){
    $this->readOnly = $value;
  }

  public function isReadOnly(){
    return strcmp($this->readOnly,"readonly")==0;
  }

  public function setName($name){
    $this->name = $name;
    $this->setTooltip($this->name);
  }

  public function setTooltip($tooltip){
    $this->tooltip = $tooltip;
  }

  /**/

  public static function buildAttribute($name,$value){
    return $name."='".$value."'";
  }
}
