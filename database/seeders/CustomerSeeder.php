<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
        'company_id' => 1,
        'customer_code' => 'C1001',
        'name' => 'WalkIn',
        'email' => 'walkin@mail.com',
        'address' => 'Any',
        'phone' => '00000 0000 00',
        'customer_type' => 'walkin',
        'status' => true,
        'user_id' => 1,
        ]);
    }
}
