<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuReview extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
