<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Assignment extends Model
{
    protected $primaryKey = 'assignment_id';
    protected $fillable = ['ticket_id', 'user_id', 'assigned_at'];
    protected $casts = ['assigned_at' => 'datetime'];

    public function ticket(): BelongsTo {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }

    public function technician(): BelongsTo {
        return $this->belongsTo(User::class, 'user_id');
    }
}