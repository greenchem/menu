<?php

namespace OldSeeder;

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
            ['name' => 'test_company1'],
            ['name' => 'test_company2'],
            ['name' => 'test_company3']
        ];

        foreach ($companies as $company) {
            Company::firstOrCreate($company);
        }
    }
}
