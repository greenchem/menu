<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CreationLog extends Model
{
    use SoftDeletes;

    /**
     * The table asociated with the model.
     *
     * @var string
     */
    protected $table = 'creation_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['timestamp', 'type', 'status'];

    /**
     * Get all of the fee logs that belongs to the creation log.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function fee_logs()
    {
        return $this->hasMany(FeeLog::class);
    }


    // Utils

    public function isAlterable($user)
    {
        return ($this->status == 'unlocked' || $this->status === null);
    }
}
