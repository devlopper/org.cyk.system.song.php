<?php

namespace App\Http\Controllers\File;

use Illuminate\Http\Request;
use App\Model\Identifiable\File\File;
use App\Model\Identifiable\File\FileForm;
use App\Service\Business\File\FileBusiness;

class FileController extends \App\Http\Controllers\AbstractIdentifiableController{

    protected function getIdentifiableClassName(){
      return "\App\Model\Identifiable\File\File";
    }

    public function getOneBytes(Request $request,$identifier){
      $readArguments = new \App\Service\Persistence\ReadArguments();
      $readArguments->columns[] = '*';
      $file = (new FileBusiness())->findWithArguments($identifier,$readArguments);
      header("Content-type: ".$file->mime);
      echo $file->bytes;
    }

    protected function getFieldNames(Request $request){
      $fieldNames = parent::getFieldNames($request);
      //$fieldNames[] = FileForm::FIELD_BYTES;
      $fieldNames[] = FileForm::FIELD_EXTENSION;
      $fieldNames[] = FileForm::FIELD_MIME;
      $fieldNames[] = FileForm::FIELD_URL;
      return $fieldNames;
    }

    protected function buildFormControlCollection(Request $request,$form){
      $controlCollection = parent::buildFormControlCollection($request,$form);
      $controlCollection->addInputFile(FileForm::FIELD_BYTES);
      $controlCollection->addInputText(FileForm::FIELD_EXTENSION);
      $controlCollection->addInputText(FileForm::FIELD_MIME);
      $controlCollection->addInputText(FileForm::FIELD_URL);
      return $controlCollection;
    }

    protected function getValidationRules(Request $request){
      $rules = parent::getValidationRules($request);
      $rules[FileForm::FIELD_BYTES] = 'required';
      $rules[FileForm::FIELD_EXTENSION] = 'required';
      $rules[FileForm::FIELD_MIME] = 'required';
      //$rules[FileForm::FIELD_URL] = 'required';
      return $rules;
    }

}
