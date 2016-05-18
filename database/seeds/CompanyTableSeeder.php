<?php

use Illuminate\Database\Seeder;

// Model
use App\Objects\Company;

class CompanyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $companies = [
            ['name' => '生科體系'],
            ['name' => '嘉良特化'],
            
        ];

        foreach ($companies as $company) {
            Company::firstOrCreate($company);
        }
    }
}
