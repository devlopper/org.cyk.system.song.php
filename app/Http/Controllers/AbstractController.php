<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserInterface\Page\Page;

abstract class AbstractController extends Controller{

  protected function getValidationRules(Request $request){
    return [];
  }

  protected function validateRequest(Request $request){
    $rules = $this->getValidationRules($request);
    if($rules)
      \Validator::make($request->all(), $rules)->validate();
  }

  /**/

  protected function instanciatePageTitled(Request $request,$title){
    $page = new \App\Model\UserInterface\Page\Page();
    $page->title = $title;
    return $page;
  }

  protected function instanciatePage(Request $request,$action,$subject){
    return $this->instanciatePageTitled($request,$action." ".$subject);
  }

  /**/

  protected function instanciateTable(Request $request){
    $table = new \App\Model\UserInterface\Table\Table();
    $table->identifier="table";
    return $table;
  }

  /**/

  protected function createCommandCollection(){

  }

  /**/

  protected function gotoPage($page){
    $parameters = ['page' => $page];
    if(count($page->forms)>0)
      $parameters['form'] = $page->forms[0];
    if(count($page->tables)>0)
      $parameters['table'] = $page->tables[0];
    return view($page->view, $parameters);
  }

}
