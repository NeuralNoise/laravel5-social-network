<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SignUpTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testNewUserRegistration()
    {
        $this->visit('/signup')
            ->type('test@gustr.com', 'email')
            ->type('test100', 'username')
            ->type('12345678qwerty', 'password')
            ->press('Sign Up')
            ->seePageIs('/');
    }
}
