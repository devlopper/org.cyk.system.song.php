<?php

namespace App\Http\Controllers\Song;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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

    protected function processDtoArray(Request $request,$dto,$entry){
      $entry[] = $dto->lyrics;
      return $entry;
    }

    protected function addSpecificTableColumns(Request $request,$table){
      $table->addColumn("lyrics");
      return $table;
    }

    protected function buildFormControlCollection(Request $request,$form){
      $controlCollection = parent::buildFormControlCollection($request,$form);
      $controlCollection->addInputTextarea("lyrics");
      return $controlCollection;
    }

    protected function getValidationRules(Request $request){
      return [
        'code' => 'required',
        'name' => 'required',
        'lyrics' => 'required'
      ];
    }

}
