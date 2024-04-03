<?php

namespace App\Models;

use App\Models\Domain;
use App\Models\Question;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subdomain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'domain_id',
    ];
    public function questions(): HasMany {
        return $this->hasMany(Question::class);
    }
    public function domain(): BelongsTo {
        return $this->belongsTo(Domain::class);
    }
}
