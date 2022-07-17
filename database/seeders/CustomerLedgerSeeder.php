<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CustomerLedgerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customer_ledger')->insert([
            'company_id' => 1,
            'customer_id' => 1,
            'total_balance' => 0.00,
            'paid' => 0.00,
            'due' => 0.00,
            'user_id' => 1,
            ]);
    }
}
