<?php

use Illuminate\Database\Seeder;

require_once('/database/seeds/AbstractSeeder.php');

class SongSeeder extends AbstractSeeder
{
  protected function getEntityClass(){
    return App\Model\Song::class;
  }

  protected function getEntityCount(){
    return 100;
  }
}
