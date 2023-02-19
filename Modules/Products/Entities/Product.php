<?php

namespace Modules\Products\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Products\Database\factories\ProductFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
    'name',
    'description',
    'price',
    'discount',
    'image',
    'category',
    'stock',
    'store_id',
    ];

    protected $casts = [
        'name' => 'string',
        'description' => 'string',
        'price' => 'float',
        'discount' => 'float',
        'stock' => 'integer',
        'image' => 'string',
        'category' => 'string',
        'store_id' => 'integer',
    ];



    protected static function newFactory()
    {
        return ProductFactory::new();
    }

    public function store()
    {
        return $this->belongsTo('Modules\Stores\Entities\Store');
    }


}
