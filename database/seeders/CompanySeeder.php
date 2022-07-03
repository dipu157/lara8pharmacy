<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Common\Company;
use DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('companies')->insert([
            'name' => 'Your Pharmacy',
            'title' => 'Your Pharmacy',
            'description' => '',
            'address' => 'Dhaka-1215',
            'city' => 'Dhaka',
            'state' => 'Dhaka',
            'country'=>'Bangladesh',
            'email' => 'info@pharmacy.com',
            'phone'=>'01709635863',
            'post_code'=>'1215',
            'currency' =>'BDT',
            'website' => 'www.pharmacy.com'
        ]);
    }
}
