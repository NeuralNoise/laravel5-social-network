<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use App\User;

class ExampleTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A basic browser test example.
     *
     * @return void
     */
    public function testBasicExample()
    {
        $user1 = factory(User::class)->create([
            'username'=>'test1',
            'email'=>'test1@gustr.com',
            'password'=>'qwerty'
        ]);

        $user2 = factory(User::class)->create([
            'username'=>'test2',
            'email'=>'test2@gustr.com',
            'password'=>'qwerty'
        ]);


        $this->browse(function ($first, $second) use ($user1, $user2) {
            $first->loginAs($user1)
                ->visit('/home')
                ->waitForText('Message');

            $second->loginAs($user2)
                ->visit('/home')
                ->waitForText('Message')
                ->type('message', 'Hey Taylor')
                ->press('Send');

            $first->waitForText('Hey Taylor')
                ->assertSee('Jeffrey Way');
        });
    }
}
