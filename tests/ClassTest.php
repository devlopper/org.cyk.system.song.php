<?php

class ClassTest extends TestCase {

    public function testGetIdentifiablePersistenceClass(){
      $this->assertGetIdentifiablePersistenceClass("App\Model\Identifiable\Song\Song"
        ,"App\Service\Persistence\Song\SongPersistence");
    }

    public function testGetIdentifiableBusinessClass(){
      $this->assertGetIdentifiableBusinessClass("App\Model\Identifiable\Song\Song"
        ,"App\Service\Business\Song\SongBusiness");
    }

    public function testGetIdentifiableDtoClass(){
      $this->assertGetIdentifiableDtoClass("App\Model\Identifiable\Song\Song"
        ,"App\Model\Identifiable\Song\SongDto");
    }

    public function testGetIdentifiableFormClass(){
      $this->assertGetIdentifiableFormClass("App\Model\Identifiable\Song\Song"
        ,"App\Model\Identifiable\Song\SongForm");
    }

    public function testGetIdentifiableControllerClass(){
      $this->assertGetIdentifiableControllerClass("App\Model\Identifiable\Song\Song"
        ,"App\Http\Controllers\Song\SongController");
    }

    public function assertGetIdentifiablePersistenceClass($identifiableClassName,$expectedFoundClassName){
      $className = \App\Utils::getIdentifiablePersistenceClassName($identifiableClassName);
      $this->assertEquals($expectedFoundClassName,$className );
      $this->assertNotEquals(null,new $className );
    }

    public function assertGetIdentifiableBusinessClass($identifiableClassName,$expectedFoundClassName){
      $className = \App\Utils::getIdentifiableBusinessClassName($identifiableClassName);
      $this->assertEquals($expectedFoundClassName,$className );
      $this->assertNotEquals(null,new $className );
    }

    public function assertGetIdentifiableDtoClass($identifiableClassName,$expectedFoundClassName){
      $className = \App\Utils::getIdentifiableDtoClassName($identifiableClassName);
      $this->assertEquals($expectedFoundClassName,$className );
      $this->assertNotEquals(null,new $className );
    }

    public function assertGetIdentifiableFormClass($identifiableClassName,$expectedFoundClassName){
      $className = \App\Utils::getIdentifiableFormClassName($identifiableClassName);
      $this->assertEquals($expectedFoundClassName,$className );
      $this->assertNotEquals(null,new $className );
    }

    public function assertGetIdentifiableControllerClass($identifiableClassName,$expectedFoundClassName){
      $className = \App\Utils::getIdentifiableControllerClassName($identifiableClassName);
      $this->assertEquals($expectedFoundClassName,$className );
      $this->assertNotEquals(null,new $className );
    }

    public function ftestSetAttribute(){
      $a = new A();
      var_dump($a);
      $a = new A();
      $a->field3 = "value3";
      var_dump($a);
    }

}

class A {

    public $field1;
    public $field2;

    public function getFieldA(){

    }

    public function setFieldA($value){

    }
}
