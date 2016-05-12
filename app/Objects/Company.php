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

    /**
     * Get all of the user that belongs to the company.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class);
    }

    /**
     * Get company by name.
     *
     * @param string name
     * @return App\Objects\Company
     */
    public static function getCompany($name) {
        return self::where('name', '=', $name)->first();
    }
}
