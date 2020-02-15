<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property Order $order
 */
class OrderItem extends Model
{

    use SoftDeletes;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'order_items';

    /**
     * @var array
     */
    protected $fillable = ['order_id', 'product_id', 'quantity'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo('App\Order', "order_id");
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo('App\Product', "product_id");
    }
}
