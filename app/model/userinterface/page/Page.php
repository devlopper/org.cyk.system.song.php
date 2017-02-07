<?php

namespace App\Model\UserInterface\Page;

class Page {

  public $title;
  public $view;
  public $forms = array();
  public $tables = array();

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

  public static function createCrudOne($crud,$identifiable){
    $editable = strcmp(\App\Model\Constant::CRUD_READ,$crud) != 0 && strcmp(\App\Model\Constant::CRUD_DELETE,$crud) != 0;
    $identifiableClassName = get_class($identifiable);
    $classInfos = \App\Model\Identifiable\IdentifiableClass::getByClassName($identifiableClassName);
    $page = Page::create($crud." ".$classInfos->label);
    $formClass = \App\Utils::getIdentifiableFormClassName($identifiableClassName);
    $form = new $formClass(["action" => $crud,"editable" => $editable]);
    $form->action = $crud;
    $form->setIdentifiable($identifiable);
    if($form->actionable){
      $form->configureCrud();
    }
    if(!$form->editable){
      $form->setReadOnly("readonly");
    }
    $page->addForm($form);
    //We can do auto control collection build
    $page->view = $classInfos->identifier.'/crud';
    return $page;
  }

}
