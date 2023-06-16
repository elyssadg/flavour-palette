<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    public function order_header(){
        return $this->belongsTo(OrderHeader::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
