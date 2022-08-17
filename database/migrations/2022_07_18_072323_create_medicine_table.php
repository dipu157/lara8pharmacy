<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicineTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicine', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('RESTRICT');
            $table->string('medicine_code',20)->unique()->nullable();
            $table->string('name',150);
            $table->integer('shelf_id')->unsigned()->nullable();
            $table->foreign('shelf_id')->references('id')->on('shelf')->onDelete('RESTRICT');
            $table->integer('supplier_id')->unsigned();
            $table->foreign('supplier_id')->references('id')->on('supplier')->onDelete('RESTRICT');
            $table->string('batch_no')->nullable();
            $table->integer('generic_id')->unsigned();
            $table->foreign('generic_id')->references('id')->on('generics')->onDelete('RESTRICT');
            $table->integer('strength_id')->unsigned();
            $table->foreign('strength_id')->references('id')->on('strength')->onDelete('RESTRICT');
            $table->integer('medicine_type_id')->unsigned();
            $table->foreign('medicine_type_id')->references('id')->on('medicine_types')->onDelete('RESTRICT');
            $table->date('expire_date')->nullable();
            $table->string('box_size',30);
            $table->decimal('box_price',15,2)->default(0);
            $table->decimal('mrp',15,2)->default(0);
            $table->decimal('trade_price',15,2)->default(0);
            $table->string('vat',10)->default(0);
            $table->string('p_discount',10)->default(0);
            $table->decimal('u_purchase',15,2)->default(0);
            $table->string('details',150)->nullable();
            $table->string('side_effect',100)->nullable();
            $table->integer('in_stock',10)->default(0);
            $table->integer('sale_qty',10)->default(0)->nullable();
            $table->integer('short_stock',10)->default(1);
            $table->boolean('favourite')->default(0)->nullable();
            $table->boolean('is_discount')->default(1);
            $table->boolean('status')->default(1);
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
        Schema::dropIfExists('medicine');
    }
}
