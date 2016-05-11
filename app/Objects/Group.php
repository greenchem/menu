<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The table asociated with the model.
     *
     * @var string
     */
    protected $table = 'groups';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'company_id'];
}
