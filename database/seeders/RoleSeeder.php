<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Common\Role;
use DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('roles')->insert([
            'company_id' => 1,
            'name' => 'SuperAdmin',
            'status' => true
        ]);

        DB::table('roles')->insert([
            'company_id' => 1,
            'name' => 'Manager',
            'status' => true
        ]);

        DB::table('roles')->insert([
            'company_id' => 1,
            'name' => 'SalesMan',
            'status' => true
        ]);
    }
}
