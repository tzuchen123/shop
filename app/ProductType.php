<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public $timestamps = false;
    protected $table = 'product_types';
    protected $fillable = ['typename'];

    public function products()
    {
        return $this->hasMany('App\Product', "type_id");
    }
}
