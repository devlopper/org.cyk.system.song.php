<?php

class FileBusinessTest extends AbstractIdentifiableTest {

  protected function getIdentifiableClassName(){
    return "\App\Model\Identifiable\File\File";
  }

  protected function getDirectFieldNames(){
    return ['extension','mime','url'];
  }

  protected function setIdentifiableFieldValues($when,$identifiable){
    parent::setIdentifiableFieldValues($when,$identifiable);
    $filename = "tests/resources/image0.jpg";
    $handle = fopen($filename, "r");
    $contents = fread($handle, filesize($filename));
    fclose($handle);
    $identifiable->bytes = $contents;
    return $identifiable;
  }
  
  protected function doIdentifiableAssertions($when,$file,$memory){
    parent::doIdentifiableAssertions($when,$file,$memory);
    $this->assertEquals(null, $file->bytes);
  }

}
