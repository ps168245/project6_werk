<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryProduct extends Model
{
    use HasFactory;

    protected $table = 'category_product';

    public $timestamps = false;

    protected $fillable = ['product_id', 'category_id'];

    public function categories() // many-to-many relationship with Category
    {
        return $this->belongsToMany(Category::class);
    }

    public function products() // many-to-many relationship with Product
    {
        return $this->belongsToMany(Product::class);
    }
}
