<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'menu_id',
        'order_id',
        'status'
    ];

    protected $primaryKey = ['menu_id', 'order_id', 'arrival_date'];

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    public function order_header(){
        return $this->belongsTo(OrderHeader::class, 'order_id');
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function seller(){
        return $this->belongsTo(Seller::class);
    }
}
