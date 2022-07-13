<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Common\Employee;
use DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('employees')->insert([
            'company_id' => 1,
            'first_name' => 'Super',
            'last_name' => 'Admin',
            'full_name' => 'Super Admin',
            'email' => 'info@pharmacy.com',
            'address' => 'Dhaka-1215',
            'city' => 'Dhaka',
            'state' => 'Dhaka',
            'post_code'=>'1215',
            'district'=>'Bangladesh',
            'gender'=>'m'
        ]);
    }
}
