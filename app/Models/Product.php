<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table='products';
    protected $fillable=[
        'cate_id',
        'name',
        'slug',
        'description',
        'original_price',
        'selling_price',
        'image',
        'qty',
        'status',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class,'cate_id','id');
    }
    public function producttype()
    {
        return $this->hasOne(ProductType::class,'prod_id','id');
    }
    public function productimage()
    {
        return $this->hasMany(ProductImage::class,'prod_id','id');
    }
    public function banner()
    {
        return $this->hasOne(Banner::class,'prod_id','id');
    }
}

