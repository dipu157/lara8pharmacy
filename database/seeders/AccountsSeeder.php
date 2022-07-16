<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class AccountsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'company_id' => 1,
            'opening_balance' => 0.00,
            'cash_in_hand' => 0.00,
            'cash_in' => 0.00,
            'cash_out' => 0.00,
            'closing_balance' => 0.00,
            'user_id' => 1
        ]);
    }
}
