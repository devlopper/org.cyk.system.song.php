<?php

namespace App\Service\Persistence;

use App\Service\Persistence\ReadArguments;

abstract class AbstractPersistence extends \App\Service\AbstractService {

    public abstract function getEntityModel();
    //public abstract function getEntityClass();
    public function getTableName(){
      return (new \ReflectionClass(new $this->getEntityModel()))->getShortName();
    }

    /* Create */

    public function create($entity){
      return $entity->save();
    }

    /* Query */

    public function getReadArguments(){
      $arguments = new ReadArguments();
      $arguments->columns = array('*');
      return $arguments;
    }

    public function getSelect($arguments){
      $class = $this->getEntityClass();
      if(isset($arguments) && $arguments!=null){
        $columns = $arguments->columns;
      }else{
        $columns = $this->getReadArguments()->columns;
      }
      if($columns == null)
        $columns = ['*'];
      return $class::select($columns);
    }

    /* Read */

    public function readWithArguments($identifier,$arguments){
      return $this->getSelect($arguments)->where(\App\Model\Identifiable\AbstractIdentifiable::FIELD_IDENTIFIER,$identifier)->first();
    }

    public function read($identifier){
      return $this->readWithArguments($identifier,$this->getReadArguments());
    }

    public function readAll(){
      return $this->getSelect()->all();
    }

    public function readAllUsingPagination($pagination){
      $class = $this->getEntityClass();
      return $class::skip($pagination->firstIndex)->take($pagination->pageSize)->get();
    }

    public function readByCode($code){
      $class = $this->getEntityClass();
      return $this->getSelect($this->getReadArguments())->where(\App\Model\Identifiable\GlobalIdentifier::FIELD_CODE,$code)->first();
    }

    /* Update */

    public function update($entity){
      return $entity->save();
    }

    /* Delete */

    public function delete($entity){
      return $entity->delete();
    }

    /* Count */

    public function countAll(){
      return \DB::table($this->getTableName())->count();
    }

    public function countAllUsingPagination($pagination){
      return \DB::table($this->getTableName())/*->paginate($paginator->perPage())*/->count();
    }

}
