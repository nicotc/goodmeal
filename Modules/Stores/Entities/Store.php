<?php

namespace Modules\Stores\Entities;

use Illuminate\Database\Eloquent\Model;
use Modules\Stores\Database\factories\StoreFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Store extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'header',
        'address',
        'latitude',
        'longitude',
        'withdrawal_schedule',
        'ratings',
    ];


    protected $casts  = [
        'name' => 'string',
        'logo' => 'string',
        'header' => 'string',
        'address' => 'string',
        'latitude' => 'double',
        'longitude' => 'double',
        'withdrawal_schedule' => 'string',
        'ratings' => 'integer',
    ];

    protected static function newFactory()
    {
        return StoreFactory::new();
    }


    public function products()
    {
        return $this->hasMany('Modules\Products\Entities\Product')->where('stock', '>', 0);
    }


}
