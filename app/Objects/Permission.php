<?php

namespace App\Objects;

use Zizaco\Entrust\EntrustPermission;

class Permission extends EntrustPermission
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'permissions';

    /**
     * The attributes that are mess assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'display_name', 'description'];

    /**
     * Get permission by name.
     *
     * @param Array of string
     * @return Array of App\Objects\Permission
     */
    public static function getPermissions($names) {
        return self::whereIn('name', $names)->get();
    }
}
