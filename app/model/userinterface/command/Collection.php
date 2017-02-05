<?php

namespace App\Model\UserInterface\Command;

class Collection extends \App\Model\UserInterface\AbstractComponent {

  public $commands = array();

  public function add($command){
    $this->commands[] = $command;
  }

}
