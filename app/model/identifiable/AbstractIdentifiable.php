<?php

namespace App\Model\Identifiable;

use Illuminate\Database\Eloquent\Model;

class AbstractIdentifiable extends Model{
    public $primaryKey = "identifier";

    public $timestamps = false;

    //protected $guarded = array('identifier');

    protected $globalIdentifierInstance;

    public function __construct(array $attributes = array()) {
      parent::__construct($attributes);
      $this->setGlobalIdentifierInstance(new \App\Model\Identifiable\GlobalIdentifier());
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

    public function getGlobalIdentifier(){
        return $this->hasOne('App\Model\Identifiable\GlobalIdentifier','identifier','globalidentifier');
    }

    /**/

    const FIELD_IDENTIFIER = "identifier";
    const FIELD_GLOBAL_IDENTIFIER = "globalidentifier";

}
