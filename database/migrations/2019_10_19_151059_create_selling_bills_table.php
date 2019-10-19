<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellingBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('selling_bills', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('created_by')->index();
            $table->unsignedInteger('agency_id')->index();
            $table->unsignedInteger('customer_id')->index();
            $table->unsignedBigInteger('total_amount');
            $table->unsignedBigInteger('total_paid');
            $table->unsignedTinyInteger('status');

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
        Schema::dropIfExists('selling_bills');
    }
}
