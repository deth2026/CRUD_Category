<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    public $timestamps =true;
    protected $table = 'products';
    protected $fillable = [
        'name',
        'image',
        'price',
        'stock',
        'is_active',
        'category_id',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

     public function category(){
        return $this ->belongsTo(Category::class);
    }

}
