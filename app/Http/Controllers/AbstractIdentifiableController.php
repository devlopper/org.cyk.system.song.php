<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\UserInterface\Page\Page;
use App\Model\UserInterface\Form\AbstractForm;
use App\Model\Constant;
use App\Model\Identifiable\GlobalIdentifier;
use App\Model\Identifiable\AbstractIdentifiable;
use App\Model\Utils\Pagination;
use App\Service\Business\Utils\LanguageBusiness;

abstract class AbstractIdentifiableController extends \App\Http\Controllers\AbstractController{

  protected function getFieldNames(Request $request){
    return [GlobalIdentifier::FIELD_CODE,GlobalIdentifier::FIELD_NAME];
  }

  protected function getMany(Request $request){
      $classInfos = \App\Model\Identifiable\IdentifiableClass::getByClassName($this->getIdentifiableClassName());
      $business = $this->getBusinessInstance();
      $start = intval($request->input(Pagination::START));
      $paginator = new Pagination($start,intval($request->input(Pagination::LENGTH)));
      $identifiables = $business->findAllUsingPagination($paginator);
      $i = 0;
      $dtoClass = $this->getDtoClass();
      $data = array();
      foreach ($identifiables as $identifiable) {
        $dto = new $dtoClass;
        $dto->setIdentifiable($identifiable);
        $commandCollection = new \App\Model\UserInterface\Command\Collection();
        $commandCollection->addCrud($identifiable);
        $commandCollection->emptyCommandNames();
        $data[$i++] = $this->getAsArray($request,$start,$i,$dto,$commandCollection->getHtml());
    }
    return ['draw'=> intval($request->input('draw'))+1,'recordsTotal'=> $business->countAll()
      ,'recordsFiltered'=>$business->countAllUsingPagination($paginator),'data'=> $data ];
  }

  protected function getAsArray(Request $request,$start,$i,$dto,$commands){
    $entry = array();
    $entry["DT_RowId"] = $dto->identifier;
    $entry["DT_RowData"] = ["pkey"=>$dto->identifier];
    $entry[] = $start+$i;
    foreach($this->getFieldNames($request) as $fieldName)
        $entry[] = $dto->$fieldName;
    $entry = $this->processDtoArray($request,$dto,$entry);
    $entry[] = $commands;
    return $entry;
  }

  protected function processDtoArray(Request $request,$dto,$entry){
    return $entry;
  }

  /**/

  public function showListPage(Request $request){
    $classInfos = \App\Model\Identifiable\IdentifiableClass::getByClassName($this->getIdentifiableClassName());
    $page = Page::createListPage($request,$classInfos);
    $this->addTableColumns($request,$page->tables[0]);
    return $this->gotoPage($page);
  }

  protected function addTableColumns(Request $request,$table){
    foreach($this->getFieldNames($request) as $fieldName)
      $table->addColumn($fieldName);
    $table = $this->addSpecificTableColumns($request,$table);
    return $table;
  }

  protected function addSpecificTableColumns(Request $request,$table){
    return $table;
  }

  /**/

  public function createCrudOnePage(Request $request,$crud,$identifiable){
    $page = Page::createCrudOne($crud,$identifiable);
    $controlCollection = $this->buildFormControlCollection($request,$page->forms[0]);
    return $page;
  }

  public function showCrudOnePage(Request $request,$crud,$identifier){
    $business = $this->getBusinessInstance();
    $identifiable = $identifier == null ? $business->instanciateOne() : $business->find($identifier);
    $page = $this->createCrudOnePage($request,$crud,$identifiable);
    return $page->navigate();
  }

  public function showCreatePage(Request $request){
    return $this->showCrudOnePage($request,Constant::CRUD_CREATE,null);
  }

  public function showReadPage(Request $request,$identifier){
    return $this->showCrudOnePage($request,Constant::CRUD_READ,$identifier);
  }

  public function showUpdatePage(Request $request,$identifier){
    return $this->showCrudOnePage($request,Constant::CRUD_UPDATE,$identifier);
  }

  public function showDeletePage(Request $request,$identifier){
    return $this->showCrudOnePage($request,Constant::CRUD_DELETE,$identifier);
  }

  public function crudOne(Request $request){
    $this->validateRequest($request);
    $classInfos = \App\Model\Identifiable\IdentifiableClass::getByClassName($this->getIdentifiableClassName());
    $business = $this->getBusinessInstance();

    $identifier = $request->all()[Constant::FIELD_IDENTIFIER];
    if(empty($identifier)){
        $identifiable = $business->instanciateOne();
    }else{
        $identifiable = $business->find($identifier);
    }

    $form = $this->getFormInstance($identifiable,1);
    $form->setFromRequest($request);
    $form->writeToIdentifiable();
    $identifiable = $form->getIdentifiable();
    if(strcmp(Constant::CRUD_DELETE,$form->action)==0){
        $business->delete($identifiable);
    }else{
        $business->save($identifiable);
    }

    return redirect()->route('show'.$classInfos->simpleClassName.'ListPage');
  }

  protected function buildFormControlCollection(Request $request,$form){
    $controlCollection = $form->addControlCollection();
    $controlCollection->addInputHidden(AbstractForm::FIELD_ACTION);
    $controlCollection->addInputHidden(AbstractIdentifiable::FIELD_IDENTIFIER);
    $controlCollection->addInputText(GlobalIdentifier::FIELD_CODE);
    $controlCollection->addInputText(GlobalIdentifier::FIELD_NAME);
    return $controlCollection;
  }

  /**/

  protected abstract function getIdentifiableClassName();

  protected function getBusinessClass(){
    return \App\Utils::getIdentifiableBusinessClassName($this->getIdentifiableClassName());
  }

  protected function getBusinessInstance(){
    $businessClass = $this->getBusinessClass();
    $business = new $businessClass;
    return $business;
  }

  protected function getDtoClass(){
    return \App\Utils::getIdentifiableDtoClassName($this->getIdentifiableClassName());
  }

  protected function getDtoInstance($identifiable){
    $dto = new $dtoClass;
    $dto = new $dtoClass;
    $dto->setIdentifiable($identifiable);
    return $dto;
  }

  protected function getFormClass(){
    return \App\Utils::getIdentifiableFormClassName($this->getIdentifiableClassName());
  }

  protected function getFormInstance($identifiable,$editable){
    $formClass = $this->getFormClass();
    $form = new $formClass([AbstractForm::FIELD_EDITABLE => $editable,AbstractForm::FIELD_ACTION=>1]);
    $form->setIdentifiable($identifiable);
    return $form;
  }

  protected function getValidationRules(Request $request){
    $rules = parent::getValidationRules($request);
    $rules[GlobalIdentifier::FIELD_CODE] = 'required';
    $rules[GlobalIdentifier::FIELD_NAME] = 'required';
    return $rules;
  }

}
