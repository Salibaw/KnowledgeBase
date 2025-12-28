<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LogHistory extends Model
{
    // Paksa model menggunakan nama tabel ini
    protected $table = 'log_histories';
    
    protected $fillable = ['user_id', 'activity', 'description', 'ip_address'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}