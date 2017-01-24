<?php

use Illuminate\Database\Seeder;

class GlobalIdentifierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('globalidentifier')->insert([
          'identifier' => str_random(10),
          'name' => str_random(10),
          'code' => str_random(10),
      ]);
    }
}
