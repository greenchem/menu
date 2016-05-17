<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Model
use App\Objects\Menu;
use App\Objcets\BookingLog;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The table asociated with the model.
     *
     * @var string
     */
    protected $table = 'products';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['menu_id', 'name', 'unit_type', 'inventory', 'order_qty', 'description'];

    /**
     * Get the products's menu.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        $this->belongsTo(Menu::class);
    }

    /**
     * Get all of the booking records that belongs to the product.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function booking_logs()
    {
        return $this->hasMany(BookingLog::class);
    }
}
