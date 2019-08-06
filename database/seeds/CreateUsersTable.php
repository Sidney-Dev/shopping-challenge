<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name'=> 'Company Admin',
            'email'=> 'fullstack@example.com',
            'password'=> bcrypt('secret'),
            'created_at' => now()
        ]);
    }
}
