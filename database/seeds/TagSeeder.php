<?php

use Illuminate\Database\Seeder;

require_once('\database\seeds\AbstractSeeder.php');

class TagSeeder extends AbstractSeeder
{
  protected function getEntityClass(){
      return App\Model\Tag::class;
  }

  protected function getEntityCount(){
      return 1;
  }
}
