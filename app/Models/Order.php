<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'address'
    ];

    /**
    * Get the basket for the order.
    */
    public function basket(): HasMany
    {
        return $this->hasMany(Basket::class);
    }
}
