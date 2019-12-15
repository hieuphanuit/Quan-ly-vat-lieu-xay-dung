<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddImportGoodBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       

        Schema::table('import_good_bills', function (Blueprint $table) {
            $table->unsignedBigInteger('total_amount')->nullable()->change();
            $table->unsignedBigInteger('status')->default(0)->change();
        });
    }
  
    /**    ->nullable()->default(0)

     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_import_good_bills');
      
        
    }
}
