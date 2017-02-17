<?php

namespace App\Model\Identifiable;

abstract class AbstractJoinDto extends \App\Model\Identifiable\AbstractIdentifiableDto {

    public $joinedIdentifiable;
    public $joinedGlobalIdentifier;

    public function setIdentifiable($dentifiable){
      parent::setIdentifiable($dentifiable);

    }

    const FIELD_JOINED_IDENTIFIABLE = "joinedIdentifiable";
    const FIELD_JOINED_GLOBAL_IDENTIFIER = "joinedGlobalIdentifier";

}
