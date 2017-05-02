<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
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
        foreach(range(1,10) as $index):
            DB::table('users')->insert([
                'email' => $faker->email,
                'username' => $faker->userName,
                'password' => bcrypt('secret'),
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'location' => $faker->city . ' ' . $faker->countryCode,
                'created_at' => $faker->dateTimeThisMonth($max = 'now')
            ]);
        endforeach;
    }
}
