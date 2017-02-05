<?php

namespace App\Model\Identifiable\Song;

class SongForm extends \App\Model\Identifiable\AbstractIdentifiableForm {

    public $lyrics;

    public function setIdentifiable($song){
      parent::setIdentifiable($song);
      $this->lyrics = $song->lyrics;
    }
}
