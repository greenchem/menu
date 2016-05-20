<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

// Model
use App\Objects\User;
use App\Objects\FeeLog;
use App\Objects\Period;

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

    public static function genAccountingFormData($timestamp, $period_id = null)
    {
        $content = [[
            '員工代號',
            '員工姓名',
            '生效日期',
            '項目類別',
            '加減項',
            '項目名稱',
            '金額',
            '專案代號',
            '事由',
            '備註'
        ]];

        // gen user meal dorm attendance weekend_attendance parking log
        $types = [
            'meal' => ['伙食費', '-'],
            'dorm' => ['宿舍租金', '-'],
            'attendance' => ['值班津貼', '+'],
            'weekend_attendance' => ['週末值班津貼', '+'],
            'parking' => ['停車費', '-'],
        ];
        foreach ($types as $type_name => $type_data) {
            // get fee logs
            $fee_logs = FeeLog::whereHas('creation_log', function ($query) use ($type_name, $timestamp) {
                    $query->where('type', $type_name)->where('timestamp', $timestamp);
            })->get()->map(function ($fee_log, $key) use ($type_data) {
                // gen new log
                return [
                    null, // $fee_log->user->code
                    $fee_log->user->nickname,
                    $fee_log->creation_log->timestamp.'01',
                    '其他',
                    $type_data[1],
                    $type_data[0],
                    $fee_log->fee,
                    null,
                    null,
                    null
                ];
            })->toArray();

            $content = array_merge($content, $fee_logs);
        }

        // gen user booking log, if period_id exist
        if (Period::find($period_id) != null) {
            $content = array_merge($content, User::all()->map(function ($user, $key) use ($period_id) {
                $period_quota = $user->user_quotas()->where('period_id', $period_id)->first();
                $period_sum = $user->booking_logs()->where('period_id', $period_id)->sum('price');
                $period_diff = ($period_quota->quota) - $period_sum;

                return [
                    null, // $user->code
                    $user->nickname,
                    $period_quota->created_at->toDateString(),
                    '其他',
                    '-',
                    '購物扣款',
                    ($period_diff < 0 ? $period_diff : 0),
                    null,
                    null,
                    null
                ];
            })->toArray());
        }

        return $content;
    }
}
