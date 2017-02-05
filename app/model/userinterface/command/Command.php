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
    return "<a href='".$this->gotoLink."' class='".$this->cascadeStyleSheet->class."'>".$this->name.$iconHtml."</a>";
  }



}
