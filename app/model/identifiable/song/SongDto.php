<?php

namespace App\Model\Identifiable\Song;

class SongDto extends \App\Model\Identifiable\AbstractIdentifiableDto {

    public $lyrics;

    public function setIdentifiable($song){
      parent::setIdentifiable($song);
      $this->lyrics = $song->lyrics;
    }

    const FIELD_LYRICS = "lyrics";
}
