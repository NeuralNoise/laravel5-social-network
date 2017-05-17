<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Traits\InitDatabaseTrait;

class SignUpTest extends DuskTestCase
{
    use InitDatabaseTrait, DatabaseTransactions;

    public static $testUser = [
        'username' => 'test101',
        'email' => 'test101@gustr.com',
        'password' => 'qwerty'
    ];

    /** @test */
    public function test_signup_user()
    {
        //Override user data from Model Factory
        $user = factory(User::class)->create(self::$testUser);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/signup')
                ->type('email', $user->email)
                ->type('username', $user->username)
                ->type('password', 'qwerty')
                ->press('Sign up')
                ->assertPathIs('/cabinet')
                ->logout();
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
