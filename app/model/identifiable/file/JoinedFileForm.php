<?php

namespace App\Model\Identifiable\File;

use Illuminate\Http\Request;

class JoinedFileForm extends \App\Model\Identifiable\AbstractJoinForm {

    protected function getIdentifiableClassName(){
      return "\App\Model\Identifiable\File\JoinedFile";
    }

    protected function getJoinFieldName(){
      return "fileidentifier";
    }

}
