<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class FriendsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        foreach (range(1, 10) as $index):
            DB::table('friends')->insert([
                'user_id' => $faker->randomDigit,
                'friend_id' => $faker->randomDigit,
                'accepted' => $faker->randomNumber(1),
            ]);
        endforeach;
    }
}
