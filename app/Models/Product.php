<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    protected $table = 'products';
    protected $primaryKey = 'product_id'; // Set the correct primary key


    protected $fillable = [
        'product_code',
        'name',
        'description',
        'category_id'
    ];

    /**
     * Relationship: A Product belongs to a Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    // Product.php (Model)
public function variants()
{
    return $this->hasMany(ProductVariant::class, 'product_id');
}

}
