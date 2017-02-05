<?php

namespace App\Model\UserInterface\Table;

class Table extends \App\Model\UserInterface\AbstractComponent  {

  public $columns = array();
  public $rows = array();

  public function addColumn($name){
    $column = new Column($name);
    array_push($this->columns,$column);
    return $column;
  }

  public function addRow(){
    $row = new Row("");
    array_push($this->rows,$row);
    return $row;
  }

}
