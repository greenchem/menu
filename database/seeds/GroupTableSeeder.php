<?php

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
       	Group::firstOrCreate(['name'=>'董事長室','company_id' =>'2']);
	Group::firstOrCreate(['name'=>'總經理室','company_id' =>'2']);
	Group::firstOrCreate(['name'=>'財管本部','company_id' =>'2']);
	Group::firstOrCreate(['name'=>'營業本部','company_id' =>'2']);
	Group::firstOrCreate(['name'=>'生產處','company_id' =>'2']);
	Group::firstOrCreate(['name'=>'嘉旭','company_id' =>'2']);
	Group::firstOrCreate(['name'=>'總經理室','company_id' =>'1']);
	Group::firstOrCreate(['name'=>'生科行銷企劃處','company_id' =>'1']);
	Group::firstOrCreate(['name'=>'B2B/B2C','company_id' =>'1']);
	Group::firstOrCreate(['name'=>'生科B2C','company_id' =>'1']);
	Group::firstOrCreate(['name'=>'良農','company_id' =>'1']);
	Group::firstOrCreate(['name'=>'優好','company_id' =>'1']);
	Group::firstOrCreate(['name'=>'旭泰','company_id' =>'1']);
	Group::firstOrCreate(['name'=>'建稜','company_id' =>'1']);     
	
    }
}
