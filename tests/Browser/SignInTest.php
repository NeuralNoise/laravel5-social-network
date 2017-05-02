<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SignInTest extends DuskTestCase
{
    /** @test */
    public function test_sign_in_user1()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/signin')
                    ->assertSee('SocialNet');
        });
    }
}
