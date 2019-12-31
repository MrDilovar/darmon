<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'name', 'phone', 'address', 'email', 'comment', 'total', 'status_id',
    ];

    public function products()
    {
        return $this->belongsToMany('App\Product')->withPivot('quantity');
    }

    public function status()
    {
        return $this->belongsTo('App\OrderStatus');
    }
}
