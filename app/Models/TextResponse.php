<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class TextResponse extends Model
{
    use HasFactory;
    protected $fillable = [
        'question_id',
        'response_label',
        'is_numeric',
    ];

    protected $casts = [
        'is_numeric' => 'boolean',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
