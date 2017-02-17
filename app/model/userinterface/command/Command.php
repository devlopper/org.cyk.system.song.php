<?php

namespace App\Model\UserInterface\Command;

class Command extends \App\Model\UserInterface\AbstractComponent {

  public $type = "button";
  public $action;

  public function __construct(array $attributes = array()) {
    parent::__construct($attributes);
    $this->cascadeStyleSheet->addClass("btn btn-default");
  }

  public function getHtml(){
    $iconHtml = "";
    if($this->icon)
      $iconHtml = "<span class='".$this->icon."'/>";
    //return "<button type='".$this->type."' class='btn btn-default'>".$this->name."</button>";
    $href = $this->buildAttribute('href',$this->gotoLink);
    $class = $this->buildAttribute('class',$this->cascadeStyleSheet->class);
    $title = $this->buildAttribute('title',$this->tooltip);
    return "<a ".$href." ".$class." ".$title." >".$this->name.$iconHtml."</a>";
  }

  /**/

  public static function instanciateOne($nameIdentifier,$gotoLink,$icon,$cascadeStyleSheetClass){
    $command = new \App\Model\UserInterface\Command\Command();
    //if($nameIdentifier)
    $command->setName(trans('command.'.$nameIdentifier));
    $command->gotoLink = $gotoLink;
    $command->icon = $icon;
    $command->cascadeStyleSheet->addClass($cascadeStyleSheetClass);
    return $command;
  }

  public static function instanciateOneSubmit($nameIdentifier,$icon,$cascadeStyleSheetClass){
    $command = Command::instanciateOne($nameIdentifier,null,$icon,$cascadeStyleSheetClass);
    $command->type = 'submit';
    return $command;
  }


}
