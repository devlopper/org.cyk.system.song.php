<?php

namespace App\Model\UserInterface\Table;

class Row extends Dimension {

  public $cells = array();
  public $commands = array();

  public function addCell($value){
    $cell = new Cell($value);
    array_push($this->cells,$cell);
    return $cell;
  }

  public function addCommand($name){
    $command = new \App\Model\UserInterface\Command\Command($name);
    array_push($this->commands,$command);
    return $command;
  }

}
