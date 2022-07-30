<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->string('sale_code',20)->unique()->nullable();
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('RESTRICT');
            $table->integer('refd_doctor_id')->unsigned()->nullable();
            $table->foreign('refd_doctor_id')->references('id')->on('doctors');
            $table->integer('payment_type_id')->unsigned()->nullable();
            $table->foreign('payment_type_id')->references('id')->on('payment_types');
            $table->decimal('total_amount',15,2)->default(0);
            $table->string('p_discount',20)->nullable();
            $table->decimal('total_discount',15,2)->default(0);
            $table->decimal('net_amount',15,2)->default(0);
            $table->decimal('paid_amount',15,2)->default(0);
            $table->decimal('due_amount',15,2)->default(0);
            $table->string('invoice_no',20)->unique();
            $table->date('sale_date',20);
            $table->string('counter',20)->nullable();
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
        Schema::dropIfExists('sales');
    }
}
