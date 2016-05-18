<?php

use Illuminate\Database\Seeder;

// Model
use App\Objects\Company;
use App\Objects\Period;
use App\Objects\Menu;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $period_company_menus = Period::all()->map(function ($period, $key) {
            return Company::all()->map(function ($company, $key) use ($period) {
                return [
                    'company_id' => $company->getAttribute('id'),
                    'period_id' => $period->getAttribute('id'),
                    'name' => $company->getAttribute('name').'的'.$period->getAttribute('name').'菜單',
                    'status' => 'visible', // 'visible for default'
                ];
            });
        });

        foreach ($period_company_menus as $company_menus) {
            foreach ($company_menus as $company_menu) {
                Menu::firstOrCreate($company_menu);
            }
        }
    }
}
