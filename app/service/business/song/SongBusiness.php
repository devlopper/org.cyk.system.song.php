<?php

namespace App\Service\Business\Song;

require_once(app_path().'\service\business\AbstractBusiness.php');

class SongBusiness extends \App\Service\Business\AbstractNotGlobalIdentifierBusiness {

  public function getIdentifiableClassName(){
      return "\App\Model\Identifiable\Song\Song";
  }

}
