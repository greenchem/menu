<?php

use Illuminate\Database\Seeder;

// Model
use App\Objects\Period;

class PeriodTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $periods = [
            ['name' => 'period1', 'status' => 'visible'],
            ['name' => 'period2', 'status' => 'invisible'],
        ];

        foreach ($periods as $period) {
            Period::firstOrCreate($period);
        }
    }
}
