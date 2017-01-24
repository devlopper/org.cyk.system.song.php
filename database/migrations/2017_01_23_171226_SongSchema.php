<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SongSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('globalidentifier', function (Blueprint $table) {
          $table->string('identifier')->unique();
          $table->string('code');
          $table->string('name');
      });

      //File module
      Schema::create('file', function (Blueprint $table) {
          $table->increments('identifier')->unique();
          $table->string('globalidentifier');
          $table->binary('bytes')->nullable();
          $table->string('extension');
          $table->string('mime');
          $table->string('url');
      });
      Schema::create('joinedfile', function (Blueprint $table) {
          $table->increments('identifier')->unique();
          $table->string('globalidentifier');
          $table->integer('fileidentifier')->unsigned();
      });

      //Relations

      Schema::table('file', function (Blueprint $table) {
          $table->foreign('globalidentifier')->references('identifier')->on('globalidentifier');
      });
      Schema::table('joinedfile', function (Blueprint $table) {
          $table->foreign('globalidentifier')->references('identifier')->on('globalidentifier');
          $table->foreign('fileidentifier')->references('identifier')->on('file');
      });

      //Tag module
      Schema::create('tag', function (Blueprint $table) {
          $table->increments('identifier')->unique();
          $table->string('globalidentifier');
      });
      Schema::create('joinedtag', function (Blueprint $table) {
          $table->increments('identifier')->unique();
          $table->string('globalidentifier');
          $table->integer('tagidentifier')->unsigned();
      });
      Schema::create('taghierarchy', function (Blueprint $table) {
          $table->increments('identifier')->unique();
          $table->string('globalidentifier');
          $table->integer('parent')->unsigned();
          $table->integer('child')->unsigned();
      });

      //Relations

      Schema::table('tag', function (Blueprint $table) {
          $table->foreign('globalidentifier')->references('identifier')->on('globalidentifier');
      });
      Schema::table('joinedtag', function (Blueprint $table) {
          $table->foreign('globalidentifier')->references('identifier')->on('globalidentifier');
          $table->foreign('tagidentifier')->references('identifier')->on('tag');
      });
      Schema::table('taghierarchy', function (Blueprint $table) {
          $table->foreign('globalidentifier')->references('identifier')->on('globalidentifier');
          $table->foreign('parent')->references('identifier')->on('tag');
          $table->foreign('child')->references('identifier')->on('tag');
      });

      //Song module
      Schema::create('song', function (Blueprint $table) {
          $table->increments('identifier')->unique();
          $table->string('globalidentifier');
          $table->string('lyrics',1024);
      });

      //Relations

      Schema::table('song', function (Blueprint $table) {
          $table->foreign('globalidentifier')->references('identifier')->on('globalidentifier');
      });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        foreach (array('song','taghierarchy','joinedtag','tag','joinedfile','file','globalidentifier') as $value) {
          Schema::dropIfExists($value);
        }
    }
}
