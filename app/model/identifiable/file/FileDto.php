<?php

namespace App\Model\Identifiable\File;

class FileDto extends \App\Model\Identifiable\AbstractIdentifiableDto {

    public $bytes;
    public $extension;
    public $mime;
    public $url;

    public function setIdentifiable($file){
      parent::setIdentifiable($file);
      $this->bytes = $file->bytes;
      $this->extension = $file->extension;
      $this->mime = $file->mime;
      $this->url = $file->url;
    }

    const FIELD_BYTES = "bytes";
    const FIELD_EXTENSION = "extension";
    const FIELD_MIME = "mime";
    const FIELD_URL = "url";
}
