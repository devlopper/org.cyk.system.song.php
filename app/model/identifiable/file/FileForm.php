<?php

namespace App\Model\Identifiable\File;

use Illuminate\Http\Request;

class FileForm extends \App\Model\Identifiable\AbstractIdentifiableForm {

    public $bytes;
    public $extension;
    public $mime;
    public $url;

    protected function getIdentifiableClassName(){
      return "\App\Model\Identifiable\File\File";
    }

    public function setIdentifiable($file){
      parent::setIdentifiable($file);
      $this->bytes = $file->bytes;
      $this->extension = $file->extension;
      $this->mime = $file->mime;
      $this->url = $file->url;
    }

    public function writeToIdentifiable(){
      parent::writeToIdentifiable();
      $this->identifiable->bytes = $this->bytes;
      $this->identifiable->extension = $this->extension;
      $this->identifiable->mime = $this->mime;
      $this->identifiable->url = $this->url;
    }

    public function setFromRequest(Request $request){
      parent::setFromRequest($request);
      $this->bytes = \File::get($request->file('bytes'));
      $this->extension = $request->bytes-> getClientOriginalExtension();
      if(empty($this->extension))
        $this->extension = $request->bytes-> guessExtension();
      $this->mime = $request->bytes-> getClientMimeType();
      if(empty($this->mime))
        $this->mime = $request->bytes-> getMimeType();
    }

    const FIELD_BYTES = "bytes";
    const FIELD_EXTENSION = "extension";
    const FIELD_MIME = "mime";
    const FIELD_URL = "url";
}
