<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SearchTest extends DuskTestCase
{
    use DatabaseMigrations, DatabaseTransactions;
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function test_search()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/search')
                ->assertPathIs('/');
        });
    }
}
