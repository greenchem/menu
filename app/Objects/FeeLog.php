<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;

class FeeLog extends Model
{
    /**
     * The table asociated with the model.
     *
     * @var string
     */
    protected $table = 'fee_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id', 'createion_log_id', 'fee'];

    /**
     * Get fee_log's creation log.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function creation_log()
    {
        return $this->belongsTo(CreationLog::class);
    }

    /**
     * Get fee_log's user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
