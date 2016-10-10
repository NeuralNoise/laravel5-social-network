<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SocialAccountTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSocialAccountRedirect()
    {
        $this->visit('/signin')->click('Facebook Login');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSocialAccountCallback()
    {
        // replace the return value of true with whatever values you wish to return for your test
        Socialite::shouldReceive('driver->fields->scopes->user')->andReturn(true);

        $this->visit('/callback');
    }
}
