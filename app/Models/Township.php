<?php

namespace App\Models;

use App\Models\State;
use App\Models\Clinic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Township extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state_id',
    ];
    public function clinics(): HasMany {
        return $this->hasMany(Clinic::class);
    }
    public function state(): BelongsTo {
        return $this->belongsTo(State::class);
    }
}
