<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'company_id' => 1,
            'role_id'=>1,
            'employee_id'=>1,
            'name' => 'Admin',
            'email' => 'admin@pharmacy.com',
            'password' => bcrypt('pass123')
        ]);
    }
}
