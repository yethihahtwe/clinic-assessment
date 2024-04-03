<?php

namespace App\Models;

use App\Models\User;
use App\Models\Clinic;
use App\Models\Assessor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Assessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'clinic_id',
        'assessor_id',
        'date',
        'choices',
    ];
    protected $casts = ['choices' => 'json'];

    public function assessor(): BelongsTo {
        return $this->belongsTo(Assessor::class);
    }
    public function clinic(): BelongsTo {
        return $this->belongsTo(Clinic::class);
    }
    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
