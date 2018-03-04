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
        DB::table('users')->delete();
        \App\User::create(array(
            'name' => 'Daniel',
            'email' => 'test@test.com',
            'password' => Hash::make('test123')
        ));
    }
}
