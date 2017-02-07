<?php

namespace App\Model\UserInterface\Command;

class Collection extends \App\Model\UserInterface\AbstractComponent {

  public $commands = array();

  public function add($command){
    $this->commands[] = $command;
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
