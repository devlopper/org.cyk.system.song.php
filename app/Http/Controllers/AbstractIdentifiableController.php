<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserInterface\Page\Page;

abstract class AbstractIdentifiableController extends \App\Http\Controllers\AbstractController{

  protected abstract function getBusinessClass();

  protected function getMany(Request $request){
      $businessClass = $this->getBusinessClass();
      $business = new $businessClass;
      $start = intval($request->input('start'));
      $paginator = new \App\Model\Utils\Pagination($start,intval($request->input('length')));
      $identifiables = $business->findAllUsingPagination($paginator);
      $i = 0;
      $dtoClass = $business->getDtoClass();
      $data = array();
      foreach ($identifiables as $identifiable) {
        $dto = new $dtoClass;
        $dto->setIdentifiable($identifiable);
        $editCommand = new \App\Model\UserInterface\Command\Command();
        //$editCommand->name = 'Modifier';
        $editCommand->cascadeStyleSheet->addClass("btn-warning");
        $editCommand->icon = "glyphicon glyphicon-edit";
        $editCommand->gotoLink = route('showSongUpdatePage',[$dto->identifier]);

        $deleteCommand = new \App\Model\UserInterface\Command\Command();
        $deleteCommand->cascadeStyleSheet->addClass("btn-danger");
        $deleteCommand->icon = "glyphicon glyphicon-trash";
        //$deleteCommand->name = 'Supprimer';

        $commands = "";
        $commands = \App\Model\UserInterface\AbstractComponent::concatenateHtml($commands,$editCommand);
        $commands = \App\Model\UserInterface\AbstractComponent::concatenateHtml($commands,$deleteCommand);

        $data[$i++] = $this->getAsArray($request,$start,$i,$dto,$commands);

    }
    return ['draw'=> intval($request->input('draw'))+1,'recordsTotal'=> $business->countAll(),'recordsFiltered'=>$business->countAllUsingPagination($paginator)
      ,'data'=> $data ];
  }

  protected function getAsArray(Request $request,$start,$i,$dto,$commands){
    $entry = array();
    $entry["DT_RowId"] = $dto->identifier;
    $entry["DT_RowData"] = ["pkey"=>$dto->identifier];
    $entry[] = $start+$i;
    $entry[] = $dto->code;
    $entry[] = $dto->name;
    $entry = $this->processDtoArray($request,$dto,$entry);
    $entry[] = $commands;
    return $entry;
  }

  protected function processDtoArray(Request $request,$dto,$entry){
    return $entry;
  }

  /**/

  public function showListPage(Request $request){
    $businessClass = $this->getBusinessClass();
    $business = new $businessClass;
    $page = $this->instanciatePage($request,"List of",$business->getPersistence()->getTableName());
    $table = $this->instanciateTable($request);
    $table = $this->addTableColumns($request,$table);
    return view('song/list', ['page' => $page,'table' => $table]);
  }

  protected function addTableColumns(Request $request,$table){
    $table->addColumn("code");
    $table->addColumn("name");
    $table = $this->addSpecificTableColumns($request,$table);
    return $table;
  }

  protected function addSpecificTableColumns(Request $request,$table){
    return $table;
  }

}
