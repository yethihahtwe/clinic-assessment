<?php

namespace App\Models;

use App\Models\User;
use App\Models\Assessment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assessor extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'position',
        'user_id',
    ];
    public function assessments(): HasMany {
        return $this->hasMany(Assessment::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
