<?php

use Illuminate\Database\Seeder;

class FileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      foreach (factory(App\Model\File::class, 2)->make() as $index) {
        $gid = factory(App\Model\GlobalIdentifier::class, 1)->make();
        $index->globalidentifier = $gid->identifier;
        $gid->save();
        $index->save();
      }
    }
}
