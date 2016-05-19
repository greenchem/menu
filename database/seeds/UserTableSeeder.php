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
		//top admin
		User::firstOrCreate(['username' => 'admin', 'password' => bcrypt('test'), 'nickname' => '最高權限者','company_id' =>'2','group_id' =>'1', 'position' => 'Admin'])->roles()->save(Role::where('id', '1')->first());

		//normal data
		
		User::firstOrCreate(['username' => 'test1', 'password' => bcrypt('test'), 'nickname' => '高慈汎','company_id' =>'2','group_id' =>'1', 'position' => '8'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test2', 'password' => bcrypt('test'), 'nickname' => '楊豐彰','company_id' =>'2','group_id' =>'2', 'position' => '2'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test3', 'password' => bcrypt('test'), 'nickname' => '謝順成','company_id' =>'2','group_id' =>'2', 'position' => '6'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test4', 'password' => bcrypt('test'), 'nickname' => '陳永瑜','company_id' =>'2','group_id' =>'2', 'position' => '7'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test5', 'password' => bcrypt('test'), 'nickname' => '陳韻喬','company_id' =>'2','group_id' =>'2', 'position' => '7'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test6', 'password' => bcrypt('test'), 'nickname' => '阮韶維','company_id' =>'2','group_id' =>'2', 'position' => '9'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test7', 'password' => bcrypt('test'), 'nickname' => '王瑞仁','company_id' =>'2','group_id' =>'2', 'position' => '12'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test8', 'password' => bcrypt('test'), 'nickname' => '侯尊仁','company_id' =>'2','group_id' =>'3', 'position' => '4'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test9', 'password' => bcrypt('test'), 'nickname' => '蔡秀涵','company_id' =>'2','group_id' =>'3', 'position' => '5'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test10', 'password' => bcrypt('test'), 'nickname' => '魏麗芳','company_id' =>'2','group_id' =>'3', 'position' => '6'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test11', 'password' => bcrypt('test'), 'nickname' => '蕭維貞','company_id' =>'2','group_id' =>'3', 'position' => '8'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test12', 'password' => bcrypt('test'), 'nickname' => '洪嘉惠','company_id' =>'2','group_id' =>'3', 'position' => '9'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test13', 'password' => bcrypt('test'), 'nickname' => '葉珊彣','company_id' =>'2','group_id' =>'3', 'position' => '12'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test14', 'password' => bcrypt('test'), 'nickname' => '陳淑英','company_id' =>'2','group_id' =>'3', 'position' => '12'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test15', 'password' => bcrypt('test'), 'nickname' => '沈建村','company_id' =>'2','group_id' =>'3', 'position' => '7'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test16', 'password' => bcrypt('test'), 'nickname' => '張惠晴','company_id' =>'2','group_id' =>'3', 'position' => '10'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test17', 'password' => bcrypt('test'), 'nickname' => '黃靜芝','company_id' =>'2','group_id' =>'3', 'position' => '10'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test18', 'password' => bcrypt('test'), 'nickname' => '林鴻鵬','company_id' =>'2','group_id' =>'4', 'position' => '3'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test19', 'password' => bcrypt('test'), 'nickname' => '賴依辰','company_id' =>'2','group_id' =>'4', 'position' => '6'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test20', 'password' => bcrypt('test'), 'nickname' => '李慧珍','company_id' =>'2','group_id' =>'4', 'position' => '12'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test21', 'password' => bcrypt('test'), 'nickname' => '林照鈞','company_id' =>'2','group_id' =>'4', 'position' => '5'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test22', 'password' => bcrypt('test'), 'nickname' => '江嘉翔','company_id' =>'2','group_id' =>'4', 'position' => '8'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test23', 'password' => bcrypt('test'), 'nickname' => '邱筠茜','company_id' =>'2','group_id' =>'4', 'position' => '10'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test24', 'password' => bcrypt('test'), 'nickname' => '李啟華','company_id' =>'2','group_id' =>'4', 'position' => '12'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test25', 'password' => bcrypt('test'), 'nickname' => '黃于真','company_id' =>'2','group_id' =>'4', 'position' => '7'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test26', 'password' => bcrypt('test'), 'nickname' => '江美姿','company_id' =>'2','group_id' =>'4', 'position' => '8'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test27', 'password' => bcrypt('test'), 'nickname' => '吳秀蓮','company_id' =>'2','group_id' =>'4', 'position' => '12'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test28', 'password' => bcrypt('test'), 'nickname' => '冉成雲','company_id' =>'2','group_id' =>'5', 'position' => '5'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test29', 'password' => bcrypt('test'), 'nickname' => '林世珍','company_id' =>'2','group_id' =>'5', 'position' => '8'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test30', 'password' => bcrypt('test'), 'nickname' => '蔡昆利','company_id' =>'2','group_id' =>'5', 'position' => '7'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test31', 'password' => bcrypt('test'), 'nickname' => '蕭良章','company_id' =>'2','group_id' =>'5', 'position' => '8'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test32', 'password' => bcrypt('test'), 'nickname' => '周咸成','company_id' =>'2','group_id' =>'5', 'position' => '8'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test33', 'password' => bcrypt('test'), 'nickname' => '林瓊玲','company_id' =>'2','group_id' =>'6', 'position' => '5'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test34', 'password' => bcrypt('test'), 'nickname' => '王信傑','company_id' =>'2','group_id' =>'6', 'position' => '5(駐地4等)'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test35', 'password' => bcrypt('test'), 'nickname' => '郭家閤','company_id' =>'2','group_id' =>'6', 'position' => '12'])->roles()->save(Role::where('name', 'User')->first());

		User::firstOrCreate(['username' => 'test36', 'password' => bcrypt('test'), 'nickname' => '鄭年惠','company_id' =>'1','group_id' =>'7', 'position' => '3'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test37', 'password' => bcrypt('test'), 'nickname' => '高裕翔','company_id' =>'1','group_id' =>'7', 'position' => '6'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test38', 'password' => bcrypt('test'), 'nickname' => '許福得','company_id' =>'1','group_id' =>'7', 'position' => '7'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test39', 'password' => bcrypt('test'), 'nickname' => '蕭妙穗','company_id' =>'1','group_id' =>'7', 'position' => '10'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test40', 'password' => bcrypt('test'), 'nickname' => '鄭夙娟','company_id' =>'1','group_id' =>'7', 'position' => '10'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test41', 'password' => bcrypt('test'), 'nickname' => '李錦泰','company_id' =>'1','group_id' =>'8', 'position' => '3'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test42', 'password' => bcrypt('test'), 'nickname' => '鄧雅云','company_id' =>'1','group_id' =>'8', 'position' => '11'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test43', 'password' => bcrypt('test'), 'nickname' => '李琇晴','company_id' =>'1','group_id' =>'8', 'position' => '5'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test44', 'password' => bcrypt('test'), 'nickname' => '賴永輝','company_id' =>'1','group_id' =>'8', 'position' => '6'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test45', 'password' => bcrypt('test'), 'nickname' => '莊婷云','company_id' =>'1','group_id' =>'8', 'position' => '9'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test46', 'password' => bcrypt('test'), 'nickname' => '賴筱楓','company_id' =>'1','group_id' =>'9', 'position' => '12'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test47', 'password' => bcrypt('test'), 'nickname' => '費晏云','company_id' =>'1','group_id' =>'10', 'position' => '3'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test48', 'password' => bcrypt('test'), 'nickname' => '沈雅欣','company_id' =>'1','group_id' =>'10', 'position' => '6'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test49', 'password' => bcrypt('test'), 'nickname' => '王靖維','company_id' =>'1','group_id' =>'10', 'position' => '12'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test50', 'password' => bcrypt('test'), 'nickname' => '徐建榮','company_id' =>'1','group_id' =>'10', 'position' => '5'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test51', 'password' => bcrypt('test'), 'nickname' => '李慶隆','company_id' =>'1','group_id' =>'10', 'position' => '6'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test52', 'password' => bcrypt('test'), 'nickname' => '謝宏政','company_id' =>'1','group_id' =>'11', 'position' => '5'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test53', 'password' => bcrypt('test'), 'nickname' => '陳冠男','company_id' =>'1','group_id' =>'11', 'position' => '5'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test54', 'password' => bcrypt('test'), 'nickname' => '徐華駿','company_id' =>'1','group_id' =>'11', 'position' => '5'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test55', 'password' => bcrypt('test'), 'nickname' => '周文仁','company_id' =>'1','group_id' =>'11', 'position' => '9'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test56', 'password' => bcrypt('test'), 'nickname' => '蕭富后','company_id' =>'1','group_id' =>'11', 'position' => '10'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test57', 'password' => bcrypt('test'), 'nickname' => '蔡峻瑋','company_id' =>'1','group_id' =>'11', 'position' => '12'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test58', 'password' => bcrypt('test'), 'nickname' => '林明志','company_id' =>'1','group_id' =>'12', 'position' => '7'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test59', 'password' => bcrypt('test'), 'nickname' => '江慶皇','company_id' =>'1','group_id' =>'12', 'position' => '7'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test60', 'password' => bcrypt('test'), 'nickname' => '王志吉','company_id' =>'1','group_id' =>'12', 'position' => '10'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test61', 'password' => bcrypt('test'), 'nickname' => '黃姵禎','company_id' =>'1','group_id' =>'12', 'position' => '10'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test62', 'password' => bcrypt('test'), 'nickname' => '陳雅惠','company_id' =>'1','group_id' =>'12', 'position' => '10'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test63', 'password' => bcrypt('test'), 'nickname' => '詹侑玲','company_id' =>'1','group_id' =>'12', 'position' => '11'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test64', 'password' => bcrypt('test'), 'nickname' => '鄭世傑','company_id' =>'1','group_id' =>'13', 'position' => '5'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test65', 'password' => bcrypt('test'), 'nickname' => '蔡泳島','company_id' =>'1','group_id' =>'13', 'position' => '6'])->roles()->save(Role::where('name', 'User')->first());
		User::firstOrCreate(['username' => 'test66', 'password' => bcrypt('test'), 'nickname' => '張弼亮','company_id' =>'1','group_id' =>'14', 'position' => '3'])->roles()->save(Role::where('name', 'User')->first());

    }
}
