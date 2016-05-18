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
	User::firstOrCreate(['username' => 'Admin1', 'password' => bcrypt('test'), 'nickname' => '高慈汎','company_id' =>'2','group_id' =>'1', 'position' => 'Admin']);
        User::firstOrCreate(['username' => 'AccountsManager1', 'password' => bcrypt('test'), 'nickname' => '楊豐彰','company_id' =>'2','group_id' =>'2', 'position' => 'RD']);
	User::firstOrCreate(['username' => 'Accountant1', 'password' => bcrypt('test'), 'nickname' => '侯尊仁','company_id' =>'2','group_id' =>'3', 'position' => 'Accountant']);
	User::firstOrCreate(['username' => 'MenuManager1', 'password' => bcrypt('test'), 'nickname' => '林鴻鵬','company_id' =>'2','group_id' =>'4', 'position' => 'MenuManager']);
	User::firstOrCreate(['username' => 'User1', 'password' => bcrypt('test'), 'nickname' => '冉成雲','company_id' =>'2','group_id' =>'5', 'position' => 'User']);
	User::firstOrCreate(['username' => 'User2', 'password' => bcrypt('test'), 'nickname' => '林瓊玲','company_id' =>'2','group_id' =>'6', 'position' => 'User']);
	User::firstOrCreate(['username' => 'Admin2', 'password' => bcrypt('test'), 'nickname' => '鄭年惠','company_id' =>'1','group_id' =>'7', 'position' => 'Admin']);
	User::firstOrCreate(['username' => 'AccountsManager2', 'password' => bcrypt('test'), 'nickname' => '李錦泰','company_id' =>'1','group_id' =>'8', 'position' => 'RD']);
	User::firstOrCreate(['username' => 'Accountant2', 'password' => bcrypt('test'), 'nickname' => '賴筱楓','company_id' =>'1','group_id' =>'9', 'position' => 'Accountant']);
	User::firstOrCreate(['username' => 'MenuManager2', 'password' => bcrypt('test'), 'nickname' => '費晏云','company_id' =>'1','group_id' =>'10', 'position' => 'MenuManager']);
	User::firstOrCreate(['username' => 'User3', 'password' => bcrypt('test'), 'nickname' => '謝宏政','company_id' =>'1','group_id' =>'11', 'position' => 'User']);
	User::firstOrCreate(['username' => 'User4', 'password' => bcrypt('test'), 'nickname' => '林明志','company_id' =>'1','group_id' =>'12', 'position' => 'User']);
	User::firstOrCreate(['username' => 'User5', 'password' => bcrypt('test'), 'nickname' => '鄭世傑','company_id' =>'1','group_id' =>'13', 'position' => 'User']);
	User::firstOrCreate(['username' => 'User6', 'password' => bcrypt('test'), 'nickname' => '張弼亮','company_id' =>'1','group_id' =>'14', 'position' => 'User']);

    }
}
