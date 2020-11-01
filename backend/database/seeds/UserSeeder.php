<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        DB::table('users')->insert([
            'name' => 'Sales user test',
            'email' => 'sales@user.com',
            'department' => 'sales',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('password123'),
        ]);

        DB::table('users')->insert([
            'name' => 'Logistic User Test',
            'email' => 'logistic@user.com',
            'department' => 'logistics',
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
            'password' => Hash::make('password123'),
        ]);

    }
}
