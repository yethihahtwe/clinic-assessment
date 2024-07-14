<?php

namespace App\Models;

use App\Models\Domain;
use App\Models\Subdomain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'domain_id',
        'subdomain_id',
        'response_type_id',
    ];
    public function domain(): BelongsTo {
        return $this->belongsTo(Domain::class);
    }
    public function subdomain(): BelongsTo {
        return $this->belongsTo(Subdomain::class);
    }

    public function responseType(): BelongsTo {
        return $this->belongsTo(ResponseType::class);
    }

    public function possibleResponses(): HasMany {
        return $this->hasMany(PossibleResponses::class);
    }

    public function textResponses(): HasMany {
        return $this->hasMany(TextResponse::class);
    }

    protected $casts = [
        'is_multiselect' => 'boolean',
    ];
}
