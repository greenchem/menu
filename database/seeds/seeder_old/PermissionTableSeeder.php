<?php

namespace OldSeeder;

use Illuminate\Database\Seeder;

// Models
use App\Objects\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            // Admin
            ['name' => 'manAccounts(Full)'     , 'display_name' => '帳號管理(最高權限)'       , 'description' => ''],

            // AccountsManager
            ['name' => 'manAccounts'           , 'display_name' => '帳號管理(以下)'           , 'description' => ''],
            ['name' => 'unlockReportForm'      , 'display_name' => '報表解鎖'                 , 'description' => ''],
            ['name' => 'manCompanies'          , 'display_name' => '公司管理'                 , 'description' => ''],
            ['name' => 'manGroups'             , 'display_name' => '部門管理'                 , 'description' => ''],

            // Accountant
            ['name' => 'createReportForm'      , 'display_name' => '建立報表'                 , 'description' => ''],
            ['name' => 'manUserQuota'          , 'display_name' => '購物餘額管理'             , 'description' => ''],
            ['name' => 'manPeriods'            , 'display_name' => '期號管理'                 , 'description' => ''],
            ['name' => 'manTradeLogs'          , 'display_name' => '管理購物紀錄(刪除)'       , 'description' => ''],
            ['name' => 'exportStatement(Full)' , 'display_name' => '匯出對帳單'               , 'description' => ''],

            // Menu Manager
            ['name' => 'manMenus'              , 'display_name' => '菜單管理'                 , 'description' => ''],
            ['name' => 'exportOrderForm'       , 'display_name' => '匯出備貨單(根據公司單位)' , 'description' => ''],
            ['name' => 'exportStatement'       , 'display_name' => '匯出對帳單(根據公司單位)' , 'description' => ''],

            // User
            ['name' => 'shopping'              , 'display_name' => '購物'                     , 'description' => ''],
            ['name' => 'viewTradeLogs(Self)'   , 'display_name' => '察看購物紀錄'             , 'description' => '']
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate($permission);
        }
    }
}
