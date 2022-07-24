<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddPurchaseReturnIDToPurchaseReturnDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchase_return_details', function (Blueprint $table) {
            $table->integer('purchase_return_id')->unsigned();

            $table->foreign('purchase_return_id')->references('id')->on('purchase_return');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('add_purchase__return_i_d_to__purchase_return_details');
    }
}
