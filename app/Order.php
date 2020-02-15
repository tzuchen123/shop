<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $id
 * @property int $user_id
 * @property string $status
 * @property string $created_at
 * @property OrderItem[] $orderItems
 */
class Order extends Model
{

    use SoftDeletes;
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    // public $incrementing = false; 有這行會沒有id

    /**
     * @var array
     */
    protected $fillable = [
        'order_no', 'receive_name', 'receive_phone',
        'receive_mobile', 'receive_address', 'receive_email', 'receipt', 'time_to_send',
        'total_price', 'remark',"user_id",
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany('App\OrderItem', "order_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function User()
    {
        return $this->belongsTo('App\User', "user_id");
    }
}
