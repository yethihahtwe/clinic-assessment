<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PossibleResponses extends Model
{
    use HasFactory;

    protected $fillable = [
        'question_id',
        'response',
        'score',
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
