<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->string('first_name',150);
            $table->string('last_name',150)->nullable();
            $table->string('full_name',150);
            $table->string('photo')->nullable();
            $table->string('email',190)->nullable();
            $table->string('address',240);
            $table->string('city',25);
            $table->string('state',50)->nullable();
            $table->string('post_code',4);
            $table->string('district',240)->nullable();
            $table->string('mobile',150)->nullable();
            $table->date('dob')->nullable();
            $table->char('gender',1)->comments('M=> Male F=>Female');
            $table->char('blood_group',30)->nullable();
            $table->string('last_education',240)->nullable();
            $table->string('national_id',20)->nullable();
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('employees');
    }
}
