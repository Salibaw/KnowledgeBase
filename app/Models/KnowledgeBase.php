<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KnowledgeBase extends Model
{
    protected $table = 'knowledge_base';
    protected $primaryKey = 'kb_id';
    protected $fillable = ['problem_title', 'solution', 'cleaned_text', 'vector_weights', 'keyword', 'is_verified'];

    // Casting sangat penting untuk menyimpan data vektor numerik sebagai array JSON
    protected $casts = [
        'vector_weights' => 'array',
        'is_verified' => 'boolean'
    ];
}