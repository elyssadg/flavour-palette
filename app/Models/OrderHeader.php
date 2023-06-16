<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHeader extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function order_detail(){
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}
