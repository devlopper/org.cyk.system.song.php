<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

require_once('\database\seeds\AbstractSeeder.php');

class SongPersistenceTest extends TestCase {

    use DatabaseTransactions;

    public function testCreate(){

      /*for($i=0; $i < 3;$i++) {
        $entity = factory(App\Model\Song::class, 1)->make();
        $gid = factory(App\Model\GlobalIdentifier::class, 1)->make();
        $entity->globalidentifier = $gid->identifier;
        $gid->save();
        $entity->save();
      }*/

      //AbstractSeeder::create(App\Model\Song::class,8);

      //echo "LISTE : ".App\Model\Song::all()->count();

      $songPersistence = new App\Service\Persistence\SongPersistence();

      for($i=0; $i < 1;$i++) {
        $entity = factory(App\Model\Song::class, 1)->make();
        $gid = factory(App\Model\GlobalIdentifier::class, 1)->make();
        $songPersistence->create($entity,$gid);
      }


    }

    public function testRead(){

    }

    public function testUpdate(){

    }

    public function testDelete(){

    }
}
