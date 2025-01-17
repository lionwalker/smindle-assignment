<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'order_id',
        'name',
        'type',
        'price'
    ];

    /**
    * Get the order that owns the basket item.
    */
    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
