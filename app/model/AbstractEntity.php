<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AbstractEntity extends Model{
    public $primaryKey = "identifier";

    public $timestamps = false;

    protected $globalIdentifierInstance;

    public function __construct(array $attributes = array()) {
      parent::__construct($attributes);
      $this->setGlobalIdentifierInstance(new \App\Model\GlobalIdentifier());
    }

    public function setGlobalIdentifierInstance($globalIdentifierInstance){
      $this->globalIdentifierInstance = $globalIdentifierInstance;
    }

    public function getGlobalIdentifierInstance(){
      return $this->globalIdentifierInstance;
    }

    /**
     * Get the global identifier record associated.
     */
     /*
    public function getGlobalIdentifier(){
        return $this->hasOne('App\Model\GlobalIdentifier','identifier','globalidentifier');
    }
    */
}
