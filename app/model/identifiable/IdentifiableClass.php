<?php

namespace App\Model\Identifiable;

$IDENTIFIABLE_CLASSES = array();

class IdentifiableClass {

  public $className;
  public $simpleClassName;
  public $identifier;
  public $label;

  public static function  getByClassName($className){
    global $IDENTIFIABLE_CLASSES;
    if($IDENTIFIABLE_CLASSES)
      foreach($IDENTIFIABLE_CLASSES as $class)
        if(strcmp($className,$class->className) == 0)
          return $class;
    $class = new IdentifiableClass();
    $class->className=$className;
    $class->simpleClassName=substr($class->className, strrpos($class->className, "\\") + 1);
    $class->identifier=strtolower($class->simpleClassName);
    $class->label=$class->identifier;
    $IDENTIFIABLE_CLASSES[] = $class;
    return $class;
  }

}
