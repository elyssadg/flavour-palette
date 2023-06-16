<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function cart() {
        return $this->hasMany(Cart::class);
    }

    public function order_header() {
        return $this->hasMany(Cart::class);
    }

    public function wishlist() {
        return $this->hasMany(Wishlist::class);
    }

    public function review() {
        return $this->hasMany(MenuReview::class);
    }
}
