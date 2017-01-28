<?php

class ClassTest extends TestCase {

    public function testSetAttribute(){
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
