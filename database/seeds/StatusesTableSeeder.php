<?php

use Illuminate\Database\Seeder;

class StatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $users = App\User::where('id', '<', 10)->get();

        if (count($users) == 0) {
            $users = factory(App\User::class, 10)
                ->create();
        }

        $users->each(function ($u) {
            $u->statuses()->save(factory(App\Models\Status::class)->make());
        });
    }
}
