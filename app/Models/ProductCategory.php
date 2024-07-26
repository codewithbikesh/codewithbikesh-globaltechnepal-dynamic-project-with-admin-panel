<?php

namespace App\Models;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $table = "products";
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
    ];

    public function setNameAttribute($value){
        $this->attributes['name'] = strtoupper($value);
        $this->attributes['slug'] = Str::slug($value);
    }
}
