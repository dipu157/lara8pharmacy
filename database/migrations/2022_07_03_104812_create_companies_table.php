<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
             $table->increments('id');
            $table->string('name',240);
            $table->string('title',100);
            $table->string('description',500)->nullable();
            $table->string('address',200);
            $table->string('city',200)->nullable();
            $table->string('state',200)->nullable();
            $table->string('post_code',200)->nullable();;
            $table->string('country',100)->nullable();
            $table->string('phone',200)->nullable();;
            $table->string('email',190)->unique()->nullable();
            $table->string('website',190)->nullable();
            $table->string('logo_img')->nullable();
            $table->char('currency',3)->default('BDT');
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('companies');
    }
}
