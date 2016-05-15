<?php

namespace App\Objects;

use Illuminate\Foundation\Auth\User as Authenticatable;

// Plugins env
use Zizaco\Entrust\Traits\EntrustUserTrait;

// Model
use App\Objects\Company;
use App\Objects\Group;
use App\Objects\Role;

class User extends Authenticatable
{
    use EntrustUserTrait;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'password', 'nickname', 'company_id', 'group_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get user's company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Get user's group.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function group()
    {
        return $this->belongsTo(Group::class);
    }


    // Scopes

    /**
     * Get viewable accounts
     *
     * @var Illuminate\Database\Eloquent\Builder $qeury
     * @var App\Object\User $user
     * @return Illuminate\Database\Eloquent\Builder
     */
    public function scopeViewable($query, $user)
    {
        $effectable_roles = Role::getEffectableRoles($user);
        $viewable_ids = [];

        foreach (self::all() as $aim) {
            if (
                // N + 1 query over here!! But I have no time...
                ( Role::isRolesIn($aim->roles, $effectable_roles) ) ||
                ( $aim->getAttribute('id') == $user->getAttribute('id') )
            )
            {
                array_push($viewable_ids, $aim->getAttribute('id'));
            }
        }

        return $query->whereIn('id', $viewable_ids);

    }


    // Utils

    /**
     * Check the specific account is alterable by the user or not (this).
     *
     * @var App\Objects\User $user
     * @return boolean
     */
    public function canAlter($user)
    {
        return Role::isRolesIn($user->roles, Role::getEffectableRoles($this));
    }

    /**
     * Check the account with the provided role is creatable by the user or not.
     *
     * @var App\Objects\Role $role
     * @return boolean
     */
    public function canCreate($role)
    {
        return in_array( $role->getAttribute('name'), Role::getEffectableRoles($this) );
    }
}
