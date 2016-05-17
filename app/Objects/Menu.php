<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Model
use App\Objects\Company;
use App\Objects\Period;
use App\Objects\Product;

class Menu extends Model
{
    use SoftDeletes;

    /**
     * The table asociated with the model.
     *
     * @var string
     */
    protected $table = 'menus';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['company_id', 'period_id', 'name', 'status'];

    /**
     * Get the menu's company
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function company()
    {
        $this->belongsTo(Company::class);
    }

    /**
     * Get the menu's period
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function period()
    {
        $this->belongsTo(Period::class);
    }

    /**
     * Get all of the products that belongs to the menu.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
