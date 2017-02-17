<?php

namespace App\Model\UserInterface\Command;

class Collection extends \App\Model\UserInterface\AbstractComponent {

  public $commands = array();

  public function add($command){
    $this->commands[] = $command;
  }

  public function addCrud($identifiable){
    $classInfos = \App\Model\Identifiable\IdentifiableClass::getByClassName(get_class($identifiable));
    $this->createCommand("read",route('show'.$classInfos->simpleClassName.'ReadPage'
      ,[$identifiable->identifier]),"glyphicon glyphicon-eye-open","btn-primary");
    $this->createCommand("update",route('show'.$classInfos->simpleClassName.'UpdatePage'
      ,[$identifiable->identifier]),"glyphicon glyphicon-edit","btn-warning");
    $this->createCommand("delete",route('show'.$classInfos->simpleClassName.'DeletePage'
      ,[$identifiable->identifier]),"glyphicon glyphicon-trash","btn-danger");

  }

  public function emptyCommandNames(){
    foreach($this->commands as $command){
      $command->name = "";
    }
  }

  public function createCommand($nameIdentifier,$gotoLink,$icon,$cascadeStyleSheetClass){
    $command = \App\Model\UserInterface\Command\Command::instanciateOne($nameIdentifier,$gotoLink,$icon,$cascadeStyleSheetClass);
    $this->add($command);
    return $command;
  }

  public function getHtml(){
    $html = "<div class='btn-group'>";
    foreach($this->commands as $command){
      $html = \App\Model\UserInterface\AbstractComponent::concatenateHtml($html,$command);
    }
    $html = $html."</div>";
    return $html;
  }
}
