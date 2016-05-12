<?php

use Illuminate\Database\Seeder;

// Model
use App\Objects\User;
use App\Objects\Company;
use App\Objects\Group;
use App\Objects\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $testUsers = [
            ['username' => 'Admin', 'password'          => bcrypt('test'), 'nickname' => 'test1'],
            ['username' => 'AccountsManager', 'password' => bcrypt('test'), 'nickname' => 'test2'],
            ['username' => 'Accountant', 'password'     => bcrypt('test'), 'nickname' => 'test3'],
            ['username' => 'MenuManager', 'password'    => bcrypt('test'), 'nickname' => 'test4'],
            ['username' => 'User', 'password'           => bcrypt('test'), 'nickname' => 'test5'],
        ];

        foreach ($testUsers as $testUser) {
            $company_id = Company::all()->random()->getAttribute('id');
            $group_id = Group::where('company_id', '=', $company_id)->get()->random()->getAttribute('id');

            User::firstOrCreate( array_merge($testUser, [
                'company_id' => $company_id, 'group_id' => $group_id
            ]))
            ->roles()->save( Role::where('name', $testUser['username'])->first() );
        }
    }
}
