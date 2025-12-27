<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogHistory extends Model
{
    protected $fillable = ['user_id', 'activity', 'login_at', 'logout_at'];
    protected $casts = [
        'login_at' => 'datetime',
        'logout_at' => 'datetime'
    ];

    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
}