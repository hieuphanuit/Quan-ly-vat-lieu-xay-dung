<?php

use Illuminate\Database\Seeder;

class ImportGgoodBillsDetailTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('import_goods_bill_details')->insert([
            'import_goods_bill_id' => 1,
            'product_id'=> 1,
            'unit_price'=> 10,
            'quantity'=> 3,
            'total'=> 10,
        ]);
        DB::table('import_goods_bill_details')->insert([
            'import_goods_bill_id' => 5,
            'product_id'=> 2,
            'unit_price'=> 15,
            'quantity'=> 5,
            'total'=> 15,
        ]);
    }
}
