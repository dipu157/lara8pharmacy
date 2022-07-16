<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOtherExpenseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('other_expense', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->string('purpose',150);
            $table->integer('payment_type_id')->unsigned();
            $table->foreign('payment_type_id')->references('id')->on('payment_types')->onDelete('RESTRICT');
            $table->string('description',240)->nullable();
            $table->decimal('amount',15,2);
            $table->date('dob')->nullable();
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
        Schema::dropIfExists('other_expense');
    }
}
