<?php

namespace App\Objects;

use Illuminate\Database\Eloquent\Model;

// Model
use App\Objects\Company;
use App\Objects\User;
use App\Objects\UserQuota;

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
        return $this->belongsTo(Product::class);
    }


    // Utils

    /**
     * Generate Stocking Form data with provided menu_id.
     *
     *  @var int menu_id
     */
    public static function genStockingFormData($menu_id)
    {
        $companies = Company::all();

        $products = Product::where('menu_id', $menu_id)->get();

        $content = $products->map(function ($product, $key) use ($companies){
            $sum = 0;
            $new_product = [];

            $new_product[0] = $product->name;
            $new_product[1] = $product->price;

            foreach ($companies as $company) {
                $company_order_qty = BookingLog::whereHas('user', function ($user) use ($company) {
                    $user->where('company_id', '=', $company->id);
                })
                ->where('product_id', $product->id)
                ->sum('number');
                $sum += $company_order_qty;

                array_push($new_product, $company_order_qty);
            }

            array_push($new_product, $sum, $sum * $product->price);
            return $new_product;
        });

        $content = $content->toArray();

        array_unshift($content, array_merge([
            '產品名稱',
            '價格',
        ],  $companies->pluck('name')->toArray(), [
            '數量總計',
            '金額總計'
        ]));

        return $content;
    }

    /**
     * Generate Accounting Form with provided period_id & company_id.
     *
     * @var int period_id
     * @var int company_id
     * @return array of booking_list
     */
    public static function genAccountingFormData($period_id, $company_id)
    {
        $companies = Company::with(['menus'])->get();

        $users = User::where('company_id', $company_id)->get();

        $content = $users->map(function ($user, $key) use ($period_id, $companies) {
            $sum = 0;
            $new_user = [];

            $new_user[0] = $user->nickname;
            $new_user[1] = $user->user_quotas()->where('period_id', $period_id)->first()->quota;

            foreach ($companies as $company) {
                $payment = BookingLog::where('user_id', $user->id)
                    ->whereIn('menu_id', $company->menus->pluck('id'))
                    ->sum('price');

                $sum += $payment;
                array_push($new_user, $payment);
            }

            $diff = $sum - $new_user[1];
            array_push($new_user, $sum, $diff, ($diff > 0 ? $diff : 0));

            return $new_user;
        });

        $content = $content->toArray();

        array_unshift($content, array_merge([
            '姓名',
            '兌換券金額'
        ],  $companies->pluck('name')->toArray(), [
            '總金額',
            '差額',
            '員工扣款薪資'
        ]));

        return $content;
    }
}
