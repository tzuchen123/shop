<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property string $image
 * @property int $type_id
 * @property int $price
 * @property string $status
 * @property string $created_at
 */
class Product extends Model
{
    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */

    public $timestamps = false;
    /**
     * @var array
     */
    protected $table = 'products';
    protected $fillable = ['name', 'image', 'type_id', 'price', 'status', 'created_at'];
    
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function product_images()
    {
        //別的表的欄位
        return $this->hasMany('App\ProductImage', "product_id");
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function product_type()
    {   
      //自己的表的欄位
        return $this->belongsTo('App\ProductType', "type_id");
    }
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function order_items()
    {
        //子表有一個foreignkey，兩邊都填同一個fk，
        return $this->hasMany('App\OrderItem', "product_id");
    }
}
