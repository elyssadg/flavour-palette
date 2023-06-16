<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    public function menu(){
        return $this->belongsTo(Menu::class, 'menu_id');
    }

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }
}
