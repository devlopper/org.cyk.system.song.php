<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserInterface\Page\Page;

abstract class AbstractController extends Controller{

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

}
