<?php

use Illuminate\Database\Seeder;

class ImportGgoodBillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('import_good_bills')->insert([
            'created_by' => 1,
            'agency_id' => 1,
            'vendor_id'=> 1,
            'total_amount'=> 50,
            'total_paid'=> 70,
            'status' => 0,
        ]);
        DB::table('import_good_bills')->insert([
            'created_by' => 2,
            'agency_id'  => 2,
            'vendor_id' => 2,
            'total_amount'=> 60,
            'total_paid'=> 80,
            'status' => 0,
        ]);


        DB::table('import_good_bills')->insert([
            'created_by' => 1,
            'agency_id' => 1,
            'vendor_id'=> 1,
            'total_amount'=> 50,
            'total_paid'=> 70,
            'status' => 1,
        ]);
        DB::table('import_good_bills')->insert([
            'created_by' => 2,
            'agency_id'  => 2,
            'vendor_id' => 2,
            'total_amount'=> 60,
            'total_paid'=> 80,
            'status' => 1,
        ]);
        DB::table('import_good_bills')->insert([
            'created_by' => 1,
            'agency_id' => 1,
            'vendor_id'=> 1,
            'total_amount'=> 50,
            'total_paid'=> 70,
            'status' => 2,
        ]);
        DB::table('import_good_bills')->insert([
            'created_by' => 2,
            'agency_id'  => 2,
            'vendor_id' => 2,
            'total_amount'=> 60,
            'total_paid'=> 80,
            'status' => 2,
        ]);
    }
}
