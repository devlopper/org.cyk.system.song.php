<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Model\Identifiable\File\JoinedFile;
use App\Model\Identifiable\File\JoinedFileForm;

class JoinedFileController extends \App\Http\Controllers\AbstractIdentifiableController{

    protected function getIdentifiableClassName(){
      return "\App\Model\Identifiable\File\JoinedFile";
    }

    protected function getFieldNames(Request $request){
      $fieldNames = parent::getFieldNames($request);
      $fieldNames[] = JoinedFileForm::FIELD_JOINED_GLOBAL_IDENTIFIER;
      $fieldNames[] = JoinedFileForm::FIELD_JOINED_IDENTIFIABLE;
      return $fieldNames;
    }

    protected function buildFormControlCollection(Request $request,$form){
      $controlCollection = parent::buildFormControlCollection($request,$form);
      $controlCollection->addInputText(JoinedFileForm::FIELD_JOINED_GLOBAL_IDENTIFIER);
      $controlCollection->addInputText(JoinedFileForm::FIELD_JOINED_IDENTIFIABLE);
      return $controlCollection;
    }

    protected function getValidationRules(Request $request){
      $rules = parent::getValidationRules($request);
      $rules[JoinedFileForm::FIELD_JOINED_GLOBAL_IDENTIFIER] = 'required';
      $rules[JoinedFileForm::FIELD_JOINED_IDENTIFIABLE] = 'required';
      return $rules;
    }

}
