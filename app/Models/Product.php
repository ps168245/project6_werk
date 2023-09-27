<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'image', 'price', 'stock', 'EAN', 'product_number', 'dag_aanbieding', 'week_aanbieding', 'SKU', 'height_cm', 'width_cm', 'depth_cm', 'weight_gr', 'suppliers_price', 'percentage_aanbieding', 'description', 'last_edited_by'];

    public function categories() //meer op meer
    {
        return $this->belongsToMany(Category::class);
    }

    public function prices()
    {
        return $this->hasMany(Price::class);
    }

    public function lastEditedBy()
    {
        return $this->belongsTo(User::class, 'last_edited_by');
    }
}
