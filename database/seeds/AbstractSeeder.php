<?php

use Illuminate\Database\Seeder;

abstract class AbstractSeeder extends Seeder
{

    protected abstract function getEntityClass();
    protected abstract function getEntityCount();

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      /*for($i=0; $i < $this::getEntityCount();$i++) {
        $entity = factory($this::getEntityClass(), 1)->make();
        $gid = factory(App\Model\Identifiable\GlobalIdentifier::class, 1)->make();
        $entity->globalidentifier = $gid->identifier;
        $gid->save();
        $entity->save();
      }*/

      AbstractSeeder::create($this::getEntityClass(),$this::getEntityCount());
    }

    public static function create($entityClass,$entityCount){
      for($i=0; $i < $entityCount;$i++) {
        $entity = factory($entityClass, 1)->make();
        $gid = factory(App\Model\Identifiable\GlobalIdentifier::class, 1)->make();
        //echo "ENTITY : ".$entity."\r\n";
        //echo "GID    : ".$gid."\r\n";
        $entity->globalidentifier = $gid->identifier;
        $gid->save();
        $entity->save();
      }
    }
}
