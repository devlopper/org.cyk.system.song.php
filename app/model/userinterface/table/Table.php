<?php

namespace App\Model\UserInterface\Table;

class Table extends \App\Model\UserInterface\AbstractComponent  {

  public $columns = array();
  public $rows = array();

  public function addColumn($name){
    $column = new Column( (new \App\Service\Business\Utils\LanguageBusiness())->findField($name));
    array_push($this->columns,$column);
    return $column;
  }

  public function addRow(){
    $row = new Row("");
    array_push($this->rows,$row);
    return $row;
  }

  /**/

  public static function instanciateOne(){
    $table = new Table();
    $table->identifier="table";
    return $table;
  }

}
