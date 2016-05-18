<?php

namespace OldSeeder;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PermissionTableSeeder::class);

        $this->call(RoleTableSeeder::class);

        $this->call(CompanyTableSeeder::class);

        $this->call(GroupTableSeeder::class);

        $this->call(UserTableSeeder::class);

        $this->call(PeriodTableSeeder::class);

        $this->call(UserQuotaTableSeeder::class);
    }
}
