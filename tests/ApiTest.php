<?php

class ApiTest extends TestCase {

    public function testReadFile(){
      $filename = "tests/resources/image.png";
      $handle = fopen($filename, "r");
      echo "File size : ".filesize($filename);
      $contents = fread($handle, filesize($filename));
      fclose($handle);
    }

}
