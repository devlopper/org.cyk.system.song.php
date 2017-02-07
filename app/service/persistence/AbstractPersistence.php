<?php

namespace App\Service\Persistence;

require_once(app_path().'\service\AbstractService.php');

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

    /* Read */

    public function read($identifier){
      $class = $this->getEntityClass();
      return $class::find($identifier);
    }

    public function readAll(){
      $class = $this->getEntityClass();
      return $class::all();
    }

    public function readAllUsingPagination($pagination){
      $class = $this->getEntityClass();
      return $class::skip($pagination->firstIndex)->take($pagination->pageSize)->get();
    }

    public function readByCode($code){
      $class = $this->getEntityClass();
      return $class::where('code',$code)->first();
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
