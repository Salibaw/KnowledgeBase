<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Ticket extends Model
{
    protected $primaryKey = 'ticket_id';
    protected $fillable = ['user_id', 'category_id', 'title', 'description', 'status', 'priority'];

    public function user(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function assignment(): HasOne {
        return $this->hasOne(Assignment::class, 'ticket_id');
    }

    public function solution(): HasOne {
        return $this->hasOne(Solution::class, 'ticket_id');
    }
}