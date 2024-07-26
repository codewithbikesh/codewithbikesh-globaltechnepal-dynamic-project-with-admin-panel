<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetails extends Model
{
    use HasFactory;
 
    protected $table = "product_details";
    protected $fillable = [
        'name',
        'description',
        'cat_id',
        'image',
        'is_active',
    ];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'cat_id');
    }
    
}
