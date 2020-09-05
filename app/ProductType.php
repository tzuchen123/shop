<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
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

    public function scopeActive($query)
    {
        // $activrType = ProductType::Active()->get();
        return $query->where('id', 1);
    }

    // public function boot()
    // {
    //     //每個查詢都會被加上active的限制

    //     parent::boot();

    //     static::addGlobalScope('active',function(Builder $builder){
    //         $builder->where('active',true);
    //     });

    // }

    public function setTypeNameAttribute($value) // Mutator 存進資料庫前作用
    {
        $this->attributes['typename'] = strtoupper($value);
    }


    public function getTypeNameAttribute($value) // Accessor 從資料庫取出後作用
    {
        return $this->attributes['typename'] = strtolower($value);
    }
}
