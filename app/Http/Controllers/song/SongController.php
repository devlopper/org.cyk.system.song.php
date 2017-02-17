<?php

namespace App\Http\Controllers\Song;

use Illuminate\Http\Request;
use App\Model\Identifiable\GlobalIdentifier;
use App\Model\Identifiable\Song\Song;
use App\Model\Identifiable\Song\SongDto;
use App\Model\Identifiable\Song\SongForm;
use App\Model\UserInterface\Page\Page;
use App\Service\Business\Song\SongBusiness;
use App\Model\UserInterface\Form\Control\Collection;

class SongController extends \App\Http\Controllers\AbstractIdentifiableController{

    protected function getIdentifiableClassName(){
      return "\App\Model\Identifiable\Song\Song";
    }

    protected function getFieldNames(Request $request){
      $fieldNames = parent::getFieldNames($request);
      $fieldNames[] = SongForm::FIELD_LYRICS;
      return $fieldNames;
    }

    protected function buildFormControlCollection(Request $request,$form){
      $controlCollection = parent::buildFormControlCollection($request,$form);
      $controlCollection->addInputTextarea(SongForm::FIELD_LYRICS);
      return $controlCollection;
    }

    protected function getValidationRules(Request $request){
      $rules = parent::getValidationRules($request);
      $rules[SongForm::FIELD_LYRICS] = 'required';
      return $rules;
    }

}
