<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'product_id', 'rating', 'comment'];

    public static function boot()
    {
        parent::boot();

        static::saving(function ($review) {
            if ($review->rating < 1 || $review->rating > 5) {
                throw new \Exception("Rating must be between 1 and 5.");
            }
        });
    }
}
