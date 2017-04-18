<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SignUpTest extends DuskTestCase
{
    /** @test */
    public function test_signup_user()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/signup')
                ->type('email', 'test1@gustr.com')
                ->type('username', 'test1')
                ->type('password', 'test')
                ->assertSee('SocialNet');
        });
    }

    /** @test */
    public function test_email_field_require()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/signup')
                ->type('username', 'test1')
                ->type('password', 'test')
                ->press('.submit')
                ->assertSee('The email field is required');
        });
    }

    /** @test */
    public function it_returns_all_validation_errors()
    {
        $this->browse(function ($browser) {
            $browser->visit('/signup')
                ->press('.submit')
                ->assertSee('The email is required')
                ->assertSee('The username  is required')
                ->assertSee('The password is required');
        });
    }
}
