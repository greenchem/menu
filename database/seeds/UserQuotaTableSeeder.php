<?php

use Illuminate\Database\Seeder;

// Model
use App\Objects\User;
use App\Objects\Period;
use App\Objects\UserQuota;

class UserQuotaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_period_quotas = Period::all()->map(function ($period, $key) {
            return User::all()->map(function ($user, $key) use ($period) {
                return [
                    'user_id' => $user->getAttribute('id'),
                    'period_id' => $period->getAttribute('id'),
                    'quota' => mt_rand(1000, 10000),
                ];
            });
        });

        foreach ($user_period_quotas as $user_quotas) {
            foreach ($user_quotas as $user_quota) {
                UserQuota::firstOrCreate($user_quota);
            }
        }
    }
}
