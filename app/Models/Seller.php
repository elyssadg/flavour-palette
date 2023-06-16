<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seller extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function menu(){
        return $this->hasMany(Menu::class);
    }

    public function order_header(){
        return $this->hasMany(OrderHeader::class);
    }
}
