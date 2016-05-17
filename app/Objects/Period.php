<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Period extends Model
{
    use SoftDeletes;

    /**
     * The table asociated with the model.
     *
     * @var string
     */
    protected $table = 'periods';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'status'];

    /**
     * Get all of the menus that belongs to the period.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    /**
     * Get all of the user_quotas that belongs to the period.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function user_quotas()
    {
        return $this->hasMany(UserQuota::class);
    }
}
