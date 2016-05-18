<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;

class BookingLog extends Model
{
    /**
     * The table asociated with the model.
     *
     * @var string
     */
    protected $table = 'booking_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'period_id', 'menu_id', 'product_id', 'number', 'price', 'status'];

    /**
     * Get the booking record's user
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get the booking record's period
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    /**
     * Get the booking record's menu
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    /**
     * Get the booking record's product
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belognsTo(Product::class);
    }
}
