<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table='orders';
    protected $fillable=[
        'user_id',
        'fname',
        'lname',
        'email',
        'phone',
        'address',
        'province_id',
        'district_id',
        'ward_id',
        'total_price',
        'tracking_no',
        
    ];
    public function orderitems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
