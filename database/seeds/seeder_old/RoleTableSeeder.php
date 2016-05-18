<?php

use Illuminate\Database\Seeder;

// Models
use App\Objects\Permission;
use App\Objects\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'Admin'           => ['name' => 'Admin', 'display_name' => '系統管理員'],
            'AccountsManager' => ['name' => 'AccountsManager', 'display_name' => '帳號管理者'],
            'Accountant'      => ['name' => 'Accountant', 'display_name' => '總務人員(津貼/期號管理)'],
            'MenuManager'     => ['name' => 'MenuManager', 'display_name' => '菜單管理者'],
            'User'            => ['name' => 'User', 'display_name' => '一般使用者']
        ];

        $Admin = Role::firstOrCreate($roles['Admin']);
        $Admin->attachPermissions( Permission::getPermissions(['manAccounts(Full)']) );

        $AccountsManager = Role::firstOrCreate($roles['AccountsManager']);
        $AccountsManager->attachPermissions(Permission::getPermissions([
            'manAccounts',
            'unlockReportForm',
            'manCompanies',
            'manGroups'
        ]));

        $Accountant = Role::firstOrCreate($roles['Accountant']);
        $Accountant->attachPermissions(Permission::getPermissions([
            'createReportForm',
            'manUserQuota',
            'manPeriods',
            'manTradeLogs',
            'exportStatement(Full)'
        ]));

        $MenuManager = Role::firstOrCreate($roles['MenuManager']);
        $MenuManager->attachPermissions(Permission::getPermissions([
            'manMenus',
            'exportOrderForm',
            'exportStatement'
        ]));

        $User = Role::firstOrCreate($roles['User']);
        $User->attachPermissions(Permission::getPermissions([
            'shopping',
            'viewTradeLogs(Self)'
        ]));
    }
}
