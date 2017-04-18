<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SignInTest extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testTitle()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/')
                    ->assertSee('SocialNet');
        });
    }
}
