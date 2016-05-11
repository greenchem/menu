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
}
