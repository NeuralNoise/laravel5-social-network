<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTest extends TestCase
{

    use WithoutMiddleware;

    /**
     * Test if user not exist
     *
     * @return void
     */
    public function testUserNotExist()
    {
        $this->visit('/cabinet')
            ->type('abracadra', 'query')
            ->press('Search')
            ->see('No Results found');
    }
}
