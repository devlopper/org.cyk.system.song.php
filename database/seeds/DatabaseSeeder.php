<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         //$this->call(GlobalIdentifierSeeder::class);
         $this->call(FileSeeder::class);
         //$this->call(JoinedFileSeeder::class);
         $this->call(TagSeeder::class);
        /* $this->call(JoinedTagSeeder::class);
         $this->call(TagHierarchySeeder::class);*/
         $this->call(SongSeeder::class);
    }
}
