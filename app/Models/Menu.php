<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menus";
    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    public function seller(){
        return $this->belongsTo(Seller::class);
    }

    public function review(){
        return $this->hasMany(MenuReview::class);
    }

    public function menu_category(){
        return $this->hasMany(MenuCategory::class);
    }

    public function menu_week_detail(){
        return $this->hasMany(MenuWeekDetail::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
    }

    public function order_detail(){
        return $this->hasMany(OrderDetail::class);
    }
}
