<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImportGoodsBillDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('import_goods_bill_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('import_goods_bill_id')->index();
            $table->unsignedInteger('product_id');
            $table->unsignedBigInteger('unit_price');
            $table->unsignedBigInteger('quantity');
            $table->unsignedBigInteger('total');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('import_goods_bill_details');
    }
}
