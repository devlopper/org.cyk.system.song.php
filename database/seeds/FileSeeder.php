<?php

use Illuminate\Database\Seeder;

require_once('\database\seeds\AbstractSeeder.php');

class FileSeeder extends AbstractSeeder
{
  protected function getEntityClass(){
      return App\Model\File::class;
  }

  protected function getEntityCount(){
      return 1;
  }
}
