<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The table asociated with the model.
     *
     * @var string
     */
    protected $table = 'companies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name'];
}
