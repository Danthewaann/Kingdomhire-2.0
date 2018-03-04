<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
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
            'email' => 'test@test.com',
            'password' => Hash::make('test123')
        ));
    }
}
