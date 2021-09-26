<?php

namespace Database\Seeders;
use App\Models\User;

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            "name"=> "m2Center",
            "email"=> "m2@center.com",
            "password"=> bcrypt("1234")
        ]);
    }
}
