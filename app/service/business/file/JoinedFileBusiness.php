<?php

namespace App\Service\Business\File;

class JoinedFileBusiness extends \App\Service\Business\AbstractNotGlobalIdentifierBusiness {

  public function getIdentifiableClassName(){
      return "\App\Model\Identifiable\File\JoinedFile";
  }

}
