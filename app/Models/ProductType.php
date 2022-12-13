<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;
    protected $table='product_types';
    protected $fillable=[
        'prod_id',
        'hot',
        'best_selling',
        'new'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class,'prod_id','id');
    }
}
