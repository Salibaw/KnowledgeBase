<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class LogHistory extends Model
{
    protected $fillable = ['user_id', 'activity', 'description', 'ip_address'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public static function write($activity, $description = null) {
        self::create([
            'user_id' => Auth::id(),
            'activity' => $activity,
            'description' => $description,
            'ip_address' => Request::ip(),
        ]);
    }
}