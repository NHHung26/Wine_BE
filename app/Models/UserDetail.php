<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    use HasFactory;

    protected $table = 'user_detail'; // Tên của bảng trong cơ sở dữ liệu

    protected $primaryKey = 'user_id'; // Khóa chính của bảng

    public $incrementing = false; // Tắt tăng tự động cho khóa chính

    protected $fillable = [
        'user_id',
        'phone',
        'address',
        'email'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
