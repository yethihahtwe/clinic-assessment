<?php

namespace App\Models;

use App\Models\State;
use App\Models\Township;
use App\Models\Assessment;
use App\Models\Organization;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Clinic extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'state_id',
        'township_id',
        'organization_id',
    ];
    public function assessments(): HasMany {
        return $this->hasMany(Assessment::class);
    }
    public function township(): BelongsTo {
        return $this->belongsTo(Township::class);
    }
    public function state(): BelongsTo {
        return $this->belongsTo(State::class);
    }
    public function organization(): BelongsTo {
        return $this->belongsTo(Organization::class);
    }
}
