<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $order_id
 * @property int $product_id
 * @property int $quantity
 * @property Order $order
 */
class Order_Item extends Model
{
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
        return $this->belongsTo('App\Order');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany('App\Product');
    }
}
