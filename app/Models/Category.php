<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
    ];
    // i need to call the relation here
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
}
