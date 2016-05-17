<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;

class UserQuota extends Model
{
    /**
     * The table asociated with the model.
     *
     * @var string
     */
    protected $table = 'user_quotas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'period_id', 'quota'];

    /**
     * Get user_qouta's user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get user_qouta's period.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function period()
    {
        return $this->belongsTo(Period::class);
    }
}
