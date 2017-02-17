<?php

namespace App\Model\UserInterface\Page;

use App\Service\Business\Utils\LanguageBusiness;
use App\Model\UserInterface\Table\Table;
use Illuminate\Http\Request;
use App\Model\Constant;

class Page {

  public $title;
  public $contentTitle;
  public $view;
  public $forms = array();
  public $tables = array();

  public function setTitle($title){
    $this->title = $title;
    $this->contentTitle = $this->title;
  }

  public function addForm($form){
    $this->forms[] = $form;
  }

  public function addTable($table){
    $this->tables[] = $table;
  }

  public function navigate(){
    $parameters = ['page' => $this];
    if(count($this->forms)>0)
      $parameters['form'] = $this->forms[0];
    if(count($this->tables)>0)
      $parameters['table'] = $this->tables[0];
    return view($this->view, $parameters);
  }

  /**/

  public static function create($title){
    $page = new Page();
    $page->title = $title;
    return $page;
  }

  public static function createListPage(Request $request,$classInfos){
    $businessClass = \App\Utils::getIdentifiableBusinessClassName($classInfos->className);
    $business = new $businessClass;
    $page = new Page();
    $page->setTitle((new LanguageBusiness())->findAction('list',$classInfos,true));
    $table = Table::instanciateOne($request);
    $page->addTable($table);
    $page->view = $classInfos->identifier.Constant::CHARACTER_SLASH.Page::VIEW_LIST;
    return $page;
  }

  public static function createCrudOne($crud,$identifiable){
    $editable = strcmp(\App\Model\Constant::CRUD_READ,$crud) != 0 && strcmp(\App\Model\Constant::CRUD_DELETE,$crud) != 0;
    $identifiableClassName = get_class($identifiable);
    $classInfos = \App\Model\Identifiable\IdentifiableClass::getByClassName($identifiableClassName);
    $page = Page::create($crud." ".$classInfos->label);
    $page->title = (new LanguageBusiness())->findAction($crud,$classInfos,true);
    $page->contentTitle = $page->title;
    $formClass = \App\Utils::getIdentifiableFormClassName($identifiableClassName);
    $form = new $formClass(["action" => $crud,"editable" => $editable]);
    $form->action = $crud;
    $form->setIdentifiable($identifiable);
    $form->configureCrud();
    if($form->actionable){
      $form->submitCommand->rendered = true;
    }else{
      $form->submitCommand->rendered = false;
    }
    if(!$form->editable){
      $form->setReadOnly("readonly");
    }
    $page->addForm($form);
    //We can do auto control collection build
    $page->view = $classInfos->identifier.'/crud';
    return $page;
  }

  /**/

  const VIEW_LIST = "list";

}
