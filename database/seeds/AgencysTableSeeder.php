<?php

use Illuminate\Database\Seeder;

class AgencysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        factory(App\Entities\Agency::class, 100)->create();
    }
}
