<?php

namespace App\Service\Business\Song;

class SongBusiness extends \App\Service\Business\AbstractNotGlobalIdentifierBusiness {

  public function getIdentifiableClassName(){
      return "\App\Model\Identifiable\Song\Song";
  }

}
