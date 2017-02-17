<?php

namespace App\Model\Identifiable\Song;

class SongForm extends \App\Model\Identifiable\AbstractIdentifiableForm {

    public $lyrics;

    protected function getIdentifiableClassName(){
      return "\App\Model\Identifiable\Song\Song";
    }

    public function setIdentifiable($song){
      parent::setIdentifiable($song);
      $this->lyrics = $song->lyrics;
    }

    public function writeToIdentifiable(){
      parent::writeToIdentifiable();
      $this->identifiable->lyrics = $this->lyrics;
    }

    const FIELD_LYRICS = "lyrics";
}
