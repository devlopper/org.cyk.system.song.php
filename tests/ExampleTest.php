<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        //$this->visit('/')->see('Yes');
    }

    public function testDatabase()
    {
        // Make call to application...

        //$this->seeInDatabase('globalidentifier', ['identifier' => '1','code' => 'A','name' => 'Na']);

        //$this->seeInDatabase('globalidentifier', ['identifier' => '2','code' => 'B','name' => 'Nb']);
    }
}
