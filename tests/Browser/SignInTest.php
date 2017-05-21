<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Traits\InitDatabaseTrait;

class SignInTest extends DuskTestCase
{
    use InitDatabaseTrait, DatabaseTransactions;

    public static $testUser = [
        'username' => 'test101',
        'email' => 'test101@gustr.com',
        'password' => 'qwerty'
    ];

    /** @test */
    public function test_sign_in_user1()
    {
        $user = factory(User::class)->create(self::$testUser);

        $this->browse(function ($browser) use ($user) {
            $browser->visit('/signin')
                ->type('email', $user->email)
                ->type('password', 'qwerty')
                ->press('Sign in')
                ->assertPathIs('/cabinet');
        });
    }
}
