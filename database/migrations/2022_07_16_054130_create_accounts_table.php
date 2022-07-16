<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('accounts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->decimal('opening_balance',15,2)->default(0);
            $table->decimal('cash_in_hand',15,2)->default(0);
            $table->decimal('cash_in',15,2)->default(0);
            $table->decimal('cash_out',15,2)->default(0);
            $table->decimal('closing_balance',15,2)->default(0);
            $table->integer('other_income_id')->unsigned()->nullable();
            $table->foreign('other_income_id')->references('id')->on('other_incomes')->onDelete('RESTRICT');
            $table->integer('other_expense_id')->unsigned()->nullable();
            $table->foreign('other_expense_id')->references('id')->on('other_expense')->onDelete('RESTRICT');
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
        Schema::dropIfExists('accounts');
    }
}
