<?php

namespace App\Service\Business\File;

class FileBusiness extends \App\Service\Business\AbstractNotGlobalIdentifierBusiness {

  public function getIdentifiableClassName(){
      return "\App\Model\Identifiable\File\File";
  }

}
