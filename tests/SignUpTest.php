<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class SignUpTest extends TestCase
{

    public function testNewUserRegistration()
    {
        $this->withoutMiddleware();

        $this->visit('/signup')
            ->type('test@gustr.com', 'email')
            ->type('test100', 'username')
            ->type('12345678qwerty', 'password')
            ->press('Sign Up')
            ->seePageIs('/');
    }
}
