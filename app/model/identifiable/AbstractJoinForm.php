<?php

namespace App\Model\Identifiable;

use Illuminate\Http\Request;

abstract class AbstractJoinForm extends \App\Model\Identifiable\AbstractIdentifiableForm {

    public $joinedIdentifiable;
    public $joinedGlobalIdentifier;

    protected abstract function getJoinFieldName();

    public function setIdentifiable($dentifiable){
      parent::setIdentifiable($dentifiable);

    }

    public function writeToIdentifiable(){
      parent::writeToIdentifiable();
      //$joinName = $this->getJoinFieldName();
      //$this->identifiable->$joinName = $this->joinedGlobalIdentifier;
    }

    public function setFromRequest(Request $request){
      parent::setFromRequest($request);
      //$this->joinedGlobalIdentifier = (new \App\Service\Business\GlobalIdentifierBusiness())->find($request->joinedGlobalIdentifier);

    }

    const FIELD_JOINED_IDENTIFIABLE = "joinedIdentifiable";
    const FIELD_JOINED_GLOBAL_IDENTIFIER = "joinedGlobalIdentifier";
}
