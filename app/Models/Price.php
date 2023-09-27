<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    protected $table = 'prices';

    protected $fillable = [
        'price',
    ];

    /**
     * Get the product associated with the price.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
