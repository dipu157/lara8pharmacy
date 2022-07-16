<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class PaymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payment_types')->insert([
            'company_id' => 1,
            'payment_method' => 'Cash',
            'status' => true,
            'user_id' => 1
        ]);

        DB::table('payment_types')->insert([
            'company_id' => 1,
            'payment_method' => 'Credit',
            'status' => true,
            'user_id' => 1
        ]);

        DB::table('payment_types')->insert([
            'company_id' => 1,
            'payment_method' => 'Card',
            'status' => true,
            'user_id' => 1
        ]);

        DB::table('payment_types')->insert([
            'company_id' => 1,
            'payment_method' => 'Bank',
            'status' => true,
            'user_id' => 1
        ]);
    }
}
