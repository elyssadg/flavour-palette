<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function menu(){
        return $this->hasMany(Menu::class);
    }

    public function order_detail() {
        return $this->hasMany(OrderDetail::class);
    }
}
