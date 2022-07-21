<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->integer('purchase_id')->unsigned();
            $table->foreign('purchase_id')->references('id')->on('purchase')->onDelete('RESTRICT');
            $table->integer('supplier_id')->unsigned()->nullable();
            $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('RESTRICT');
            $table->integer('medicine_id')->unsigned()->nullable();
            $table->foreign('medicine_id')->references('id')->on('medicine')->onDelete('RESTRICT');
            $table->string('qty',20);
            $table->decimal('supplier_price',15,2)->default(0);
            $table->decimal('net_vat',15,2)->default(0)->nullable();
            $table->decimal('net_tp',15,2)->default(0);
            $table->decimal('net_discount',15,2)->default(0)->nullable();
            $table->decimal('net_amount',15,2)->default(0);
            $table->date('expire_date');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('RESTRICT');
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_details');
    }
}
