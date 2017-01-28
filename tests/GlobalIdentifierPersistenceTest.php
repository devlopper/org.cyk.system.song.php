<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

require_once('\database\seeds\AbstractSeeder.php');

class GlobalIdentifierPersistenceTest extends TestCase {

    use DatabaseTransactions;

    public function testCreate(){
      $globalIdentifier = new App\Model\GlobalIdentifier();
      $globalIdentifier->identifier = "myid";
      $globalIdentifier->code = "mycode";
      $globalIdentifier->name = "mynameh";

      $globalIdentifierPersistence = new App\Service\Persistence\GlobalIdentifierPersistence();

      $globalIdentifierPersistence->create($globalIdentifier);

      $this->seeInDatabase('globalidentifier', ['identifier' => 'myid','code' => 'mycode','name' => 'mynameh']);
    }

    public function testRead(){

    }

    public function testUpdate(){

    }

    public function testDelete(){

    }
}
