<?php

namespace OldSeeder;

use Illuminate\Database\Seeder;

// Models
use App\Objects\Company;
use App\Objects\Group;

class GroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $groups = [
            ['name' => 'group1'],
            ['name' => 'group2'],
            ['name' => 'group3']
        ];

        $companies = Company::get();

        foreach ($groups as $group) {
            foreach ($companies as $company) {
                Group::firstOrCreate(array_merge($group, ['company_id' => $company->getAttribute('id')]));
            }
        }
    }
}
