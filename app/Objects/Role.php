<?php

namespace App\Objects;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
   /**
    * The table associated with the model.
    *
    * @var string
    */
    protected $table = 'roles';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];

    /**
     * Get effectabale Roles
     *
     * @var App\Objects\User $user
     * @return array of Role name
     */
    public static function getEffectableRoles(\App\Objects\User $user)
    {
        if ( $user->hasRole('Admin') ) {
            return ['Admin', 'AccountsManager', 'Accountant', 'MenuManager', 'User'];
        } else if ($user->hasRole('AccountsManager')) {
            return ['Accountant', 'MenuManager', 'User'];
        } else {
            return [];
        }
    }

    /**
     * Check is the roles is the subset of provide array
     *
     * @var Array of App\Objects\Role
     * @return boolean
     */
    public static function isRolesIn($roles, $aim_roles_name)
    {
        foreach ($roles as $role) {
            if ( !in_array($role->getAttribute('name'), $aim_roles_name) ) {
                return false;
            }
        }

        return true;
    }
}
