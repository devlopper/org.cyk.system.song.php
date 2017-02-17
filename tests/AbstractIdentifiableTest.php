<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

require_once('\database\seeds\AbstractSeeder.php');

abstract class AbstractIdentifiableTest extends TestCase {

  use DatabaseMigrations;

  protected abstract function getIdentifiableClassName();

  protected function getTableName(){
    $classInfos = \App\Model\Identifiable\IdentifiableClass::getByClassName($this->getIdentifiableClassName());
    return strtolower($classInfos->simpleClassName);
  }

  protected function getBusinessClass(){
    return \App\Utils::getIdentifiableBusinessClassName($this->getIdentifiableClassName());
  }

  protected function getBusinessInstance(){
    $businessClass = $this->getBusinessClass();
    $business = new $businessClass;
    return $business;
  }

  protected function getGlobalIdentifierBusinessInstance(){
    return new App\Service\Business\GlobalIdentifierBusiness();
  }

  protected function setIdentifiableFieldValues($when,$identifiable){
    $identifiable->getGlobalIdentifierInstance()->code = "MyCode".rand();
    $identifiable->getGlobalIdentifierInstance()->name = "The name";
    foreach ($this->getDirectFieldNames() as $name)
      $identifiable->$name = $this->setIdentifiableFieldValue($when,$identifiable,$name);

    if($when == AbstractIdentifiableTest::TEST_UPDATE_UPDATE_IDENTIFIABLE){
      $identifiable->getGlobalIdentifierInstance()->name = "updated name : ".rand();
    }
    return $identifiable;
  }

  protected function setIdentifiableFieldValue($when,$identifiable,$fieldName){
    return "VALUE".rand();
  }

  /**/

  public function testInstanciateOne(){
    $identifiable = $this->getBusinessInstance()->instanciateOne();
    $this->assertNotEquals(null, $identifiable);
  }

  public function testCreate(){
    $business = $this->getBusinessInstance();
    $identifiable = $business->instanciateOne();
    $identifiable = $this->setIdentifiableFieldValues(AbstractIdentifiableTest::TEST_CREATE_CREATE_IDENTIFIABLE,$identifiable);
    $memory = $identifiable;

    $globalIdentifierCount = $this->getGlobalIdentifierBusinessInstance()->countAll();
    $songCount = $business->countAll();

    $business->create($identifiable);

    $this->assertEquals($globalIdentifierCount+1, $this->getGlobalIdentifierBusinessInstance()->countAll());
    $this->assertEquals($songCount+1, $business->countAll());

    $this->doDatabaseAssertions(AbstractIdentifiableTest::TEST_CREATE_AFTER_CREATE_IDENTIFIABLE,$identifiable,$memory);
    $identifiable = $business->findByCode($memory->getGlobalIdentifierInstance()->code);
    $this->doIdentifiableAssertions(AbstractIdentifiableTest::TEST_CREATE_AFTER_READ_BY_CODE,$identifiable,$memory);
  }

  public function testRead(){
    $business = $this->getBusinessInstance();
    $identifiable = $business->instanciateOne();
    $identifiable = $this->setIdentifiableFieldValues(AbstractIdentifiableTest::TEST_READ_CREATE_IDENTIFIABLE,$identifiable);
    $memory = $identifiable;
    $business->create($identifiable);
    $identifiable = $business->findByCode($memory->getGlobalIdentifierInstance()->code);
    $this->doIdentifiableAssertions(AbstractIdentifiableTest::TEST_READ_AFTER_READ_BY_CODE,$identifiable,$memory);
  }

  public function testUpdate(){
    $business = $this->getBusinessInstance();
    $identifiable = $business->instanciateOne();
    $identifiable = $this->setIdentifiableFieldValues(AbstractIdentifiableTest::TEST_UPDATE_CREATE_IDENTIFIABLE,$identifiable);
    $memory = $identifiable;
    $business->create($identifiable);
    $identifiable = $business->findByCode($memory->getGlobalIdentifierInstance()->code);
    $this->doIdentifiableAssertions(AbstractIdentifiableTest::TEST_UPDATE_AFTER_READ_BY_CODE_1,$identifiable,$memory);

    $identifiable = $this->setIdentifiableFieldValues(AbstractIdentifiableTest::TEST_UPDATE_UPDATE_IDENTIFIABLE,$identifiable);
    $memory = $identifiable;

    $business->update($identifiable);
    $identifiable = $business->findByCode($memory->getGlobalIdentifierInstance()->code);

    $this->doIdentifiableAssertions(AbstractIdentifiableTest::TEST_UPDATE_AFTER_READ_BY_CODE_2,$identifiable,$memory);

  }

  public function testDelete(){
    $business = $this->getBusinessInstance();
    $identifiable = $business->instanciateOne();
    $identifiable = $this->setIdentifiableFieldValues(AbstractIdentifiableTest::TEST_DELETE_CREATE_IDENTIFIABLE,$identifiable);
    $memory = $identifiable;

    $globalIdentifierCount = $this->getGlobalIdentifierBusinessInstance()->countAll();
    $identifiableCount = $business->countAll();

    $business->create($identifiable);

    $this->assertEquals($globalIdentifierCount+1, (new App\Service\Business\GlobalIdentifierBusiness())->countAll());
    $this->assertEquals($identifiableCount+1, $business->countAll());

    $identifiable = $business->findByCode($memory->getGlobalIdentifierInstance()->code);

    $globalIdentifierCount = (new App\Service\Business\GlobalIdentifierBusiness())->countAll();
    $identifiableCount = $business->countAll();
    $business->delete($identifiable);
    $this->assertEquals($globalIdentifierCount-1, (new App\Service\Business\GlobalIdentifierBusiness())->countAll());
    $this->assertEquals($identifiableCount-1, $business->countAll());

    $this->assertEquals(null, (new App\Service\Business\GlobalIdentifierBusiness())->findByCode($memory->getGlobalIdentifierInstance()->code));
    $this->assertEquals(null, $business->findByCode($memory->getGlobalIdentifierInstance()->code));
  }

  public function testPagination(){
    $business = $this->getBusinessInstance();
    $codes = array();
    for($i = 0 ; $i < 10 ; $i++){
      $identifiable = $business->instanciateOne();
      $identifiable = $this->setIdentifiableFieldValues(AbstractIdentifiableTest::TEST_PAGINATION_CREATE_IDENTIFIABLE,$identifiable);
      $codes[] = $identifiable->getGlobalIdentifierInstance()->code;
      $business->create($identifiable);
    }

    $paginator = new \App\Model\Utils\Pagination(0,3);
    $identifiables = $business->findAllUsingPagination($paginator);
    $this->doPaginationAssertions(array_slice($codes,0,3),$paginator,$identifiables);

    $paginator = new \App\Model\Utils\Pagination(3,3);
    $identifiables = $business->findAllUsingPagination($paginator);
    $this->doPaginationAssertions(array_slice($codes,3,3),$paginator,$identifiables);

  }

  /**/

  protected function doDatabaseAssertions($when,$identifiable,$memory){
    $this->seeInDatabase('globalidentifier', ['identifier' => $identifiable->getGlobalIdentifierInstance()->identifier
      ,'code' => $memory->getGlobalIdentifierInstance()->code,'name' => $memory->getGlobalIdentifierInstance()->name]);

    $tuple = ['globalidentifier' => $identifiable->getGlobalIdentifierInstance()->identifier];
      foreach ($memory->getAttributes() as $name => $value)
        $tuple[$name] = $value;
    $this->seeInDatabase($this->getTableName(), $tuple);
  }

  protected function doIdentifiableAssertions($when,$identifiable,$memory){
    $this->assertNotEquals(null, $identifiable);
    $this->assertNotEquals(null, $identifiable->getGlobalIdentifierInstance());
    $this->assertEquals($identifiable->globalidentifier, $identifiable->getGlobalIdentifierInstance()->identifier);
    $this->assertEquals($memory->getGlobalIdentifierInstance()->code, $identifiable->getGlobalIdentifierInstance()->code);
    $this->assertEquals($memory->getGlobalIdentifierInstance()->name, $identifiable->getGlobalIdentifierInstance()->name);

    foreach ($this->getDirectFieldNames() as $name){
      //echo "Assert : ".$name." , ".$memory->$name." : ".$identifiable->$name;
      $this->assertEquals($memory->$name, $identifiable->$name);
    }
  }

  protected function doPaginationAssertions($codes,$paginator,$identifiables){
    for($i = 0 ; $i < count($identifiables) ; $i++){
      $this->assertEquals($codes[$i], $identifiables[$i]->getGlobalIdentifier->code);
    }
  }

  protected function getDirectFieldNames(){
    return [];
  }

  /**/

  const TEST_CREATE_CREATE_IDENTIFIABLE = 1000;
  const TEST_CREATE_AFTER_CREATE_IDENTIFIABLE = 1001;
  const TEST_CREATE_AFTER_READ_BY_CODE = 1002;

  const TEST_READ_CREATE_IDENTIFIABLE = 2000;
  const TEST_READ_AFTER_CREATE_IDENTIFIABLE = 2001;
  const TEST_READ_AFTER_READ_BY_CODE = 2002;

  const TEST_UPDATE_CREATE_IDENTIFIABLE = 3000;
  const TEST_UPDATE_AFTER_CREATE_IDENTIFIABLE = 3001;
  const TEST_UPDATE_AFTER_READ_BY_CODE_1 = 3002;
  const TEST_UPDATE_UPDATE_IDENTIFIABLE = 3003;
  const TEST_UPDATE_AFTER_READ_BY_CODE_2 = 3004;

  const TEST_DELETE_CREATE_IDENTIFIABLE = 4000;
  const TEST_DELETE_AFTER_CREATE_IDENTIFIABLE = 4001;
  const TEST_DELETE_AFTER_READ_BY_CODE = 4002;

  const TEST_PAGINATION_CREATE_IDENTIFIABLE = 9000;
}
