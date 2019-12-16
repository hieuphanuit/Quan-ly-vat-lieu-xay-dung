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
        DB::table('users')->insert([
            'name' =>'ducnguyen',
            'email' => 'ducnguyen@gmail.com',
            'password' => bcrypt('123'),
            'role'  => 0,
            'phone'=> '0123456789',
            'agency_id' => 2
        ]);
        DB::table('users')->insert([
            'name' =>'hieuminh',
            'email' => 'hieuminh@gmail.com',
            'password' => bcrypt('123'),
            'role'  => 1,
            'phone'=> '0123456789',
            'agency_id' => 3
        ]);
        DB::table('users')->insert([
            'name' =>'ducnguyen1',
            'email' => 'ducnguyen1@gmail.com',
            'password' => bcrypt('123'),
            'role'  => 4,
            'phone'=> '0123456789',
            'agency_id' => 4
        ]);
        DB::table('users')->insert([
            'name' =>'hieuminh5',
            'email' => 'hieuminh5@gmail.com',
            'password' => bcrypt('123'),
            'role'  => 5,
            'phone'=> '0123456789',
            'agency_id' => 5
        ]);
        DB::table('users')->insert([
            'name' =>'hieuminh2',
            'email' => 'hieuminh2@gmail.com',
            'password' => bcrypt('123'),
            'role'  => 3,
            'phone'=> '0123456789',
            'agency_id' => 6
        ]);
    }
}
