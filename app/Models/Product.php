<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image',
        'category_id',
    ];

    // in her i need to build my relation
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
    // public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }
}
