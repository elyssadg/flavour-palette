<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuWeekDetail extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'id' => 'string'
    ];

    public function week() {
        return $this->belongsTo(MenuWeekHeader::class());
    }

    public function menu() {
        return $this->belongsTo(Menu::class());
    }
}
