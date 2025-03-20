<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $primaryKey = 'category_id'; // Define the primary key explicitly
    public $incrementing = true; // Ensure it auto-increments
    protected $keyType = 'int'; // Define it as an integer

    protected $fillable = [
        'name',
        'description',
        'parent_id'
    ];

    /**
     * Relationship: A Category has many Products
     */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'category_id');
    }
}
