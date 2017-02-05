<?php

namespace App\Http\Controllers\Song;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Identifiable\Song\Song;
use App\Model\Identifiable\Song\SongDto;
use App\Model\Identifiable\Song\SongForm;
use App\Model\UserInterface\Page\Page;
use App\Service\Business\SongBusiness;
use App\Model\UserInterface\Form\Control\Collection;

class SongController extends \App\Http\Controllers\AbstractIdentifiableController{

    protected function getBusinessClass(){
      return \App\Service\Business\SongBusiness::class;
    }

    protected function processDtoArray(Request $request,$dto,$entry){
      $entry[] = $dto->lyrics;
      return $entry;
    }

    protected function addSpecificTableColumns(Request $request,$table){
      $table->addColumn("lyrics");
      return $table;
    }

    public function getSongs(Request $request){
      return $this->getMany($request);
    }

    public function showCreatePage(){
      $songBusiness = new SongBusiness();
      $song = $songBusiness->instanciateOne();
      $page = new Page();
      $page->title ="Create ";
      $form = new SongForm();
      $form->setIdentifiable($song);
      $controlCollection = $form->addControlCollection();
      $controlCollection->addInputText("identifier");
      $controlCollection->addInputText("code");
      $controlCollection->addInputText("name");
      $controlCollection->addInputTextarea("lyrics");

      $form->submitCommand->action = 'song\SongController@save';

      return view('song/update', ['page' => $page,'form' => $form]);
    }

    public function showUpdatePage($identifier){
      $songBusiness = new SongBusiness();
      $song = $songBusiness->find($identifier);
      $page = new Page();
      $page->title ="Edit ".$identifier;
      $form = new SongForm();
      $form->setIdentifiable($song);

      $inputIdentifier = new \App\Model\UserInterface\Form\Control\Input\Text();
      $inputIdentifier->identifier = "identifier";
      $inputIdentifier->name = "identifier";

      $inputCode = new \App\Model\UserInterface\Form\Control\Input\Text();
      $inputCode->identifier = "code";
      $inputCode->name = "code";

      $inputName = new \App\Model\UserInterface\Form\Control\Input\Text();
      $inputName->identifier = "name";
      $inputName->name = "name";

      $inputLyrics = new \App\Model\UserInterface\Form\Control\Input\Textarea();
      $inputLyrics->identifier = "lyrics";
      $inputLyrics->name = "lyrics";

      $form->inputs = [$inputIdentifier,$inputCode,$inputName,$inputLyrics];
      $form->submitCommand->action = 'song\SongController@save';

      return view('song/update', ['page' => $page,'form' => $form]);
    }

    public function save(Request $request){
      $songBusiness = new SongBusiness();
      $this->validate($request, [
          'code' => 'required',
          'name' => 'required',
      ]);

      $identifier = $request->all()["identifier"];
      if(empty($identifier)){
          $song = $songBusiness->instanciateOne();
      }else{
          $song = $songBusiness->find($identifier);
      }

      $song->getGlobalIdentifierInstance()["code"] = $request->all()["code"];
      $song->getGlobalIdentifierInstance()["name"] = $request->all()["name"];
      $song["lyrics"] = $request->all()["lyrics"];

      $songBusiness->save($song);

      return redirect()->route('showSongListPage');
    }

}
