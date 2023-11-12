<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'name_product',
        'the_tich',
        'gia',
        'so_luong',
        'image',
        'nong_do',
        'nsx',
        'mo_ta'
    ];
}
