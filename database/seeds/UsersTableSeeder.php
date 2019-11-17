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
            'name' =>'hieule',
            'email' => 'hieu@gmail.com',
            'password' => bcrypt('admin2'),
            'role'  => 2,
            'phone'=> '0123456789',
            'agency_id' => 1
        ]);
    }
}
