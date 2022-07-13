<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

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
            'status' => true
        ]);

        DB::table('payment_types')->insert([
            'company_id' => 1,
            'payment_method' => 'Credit',
            'status' => true
        ]);

        DB::table('payment_types')->insert([
            'company_id' => 1,
            'payment_method' => 'Card',
            'status' => true
        ]);

        DB::table('payment_types')->insert([
            'company_id' => 1,
            'payment_method' => 'Bank',
            'status' => true
        ]);
    }
}
