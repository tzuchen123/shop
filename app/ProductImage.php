<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $product_id
 * @property string $image
 * @property string $created_at
 */
class ProductImage extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'product_images';

    /**
     * Indicates if the IDs are auto-incrementing.
     * 
     * @var bool
     */
  
    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'image', 'created_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */

    public function product()
    {
        //自己的表的欄位
        return $this->belongsTo('App\Product', "product_id");
    }
}
