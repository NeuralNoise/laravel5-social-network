<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SocialAccountTest extends TestCase
{
    /**
     * Check if link on Facebook presents
     *
     * @return void
     */
    public function testSocialAccountRedirect()
    {
        $this->visit('/signin')->click('Facebook Login');
    }

    /**
     * Check if response from Facebook will contains all needed data.
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
