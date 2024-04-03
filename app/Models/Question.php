<?php

namespace App\Models;

use App\Models\Domain;
use App\Models\Subdomain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Question extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'domain_id',
        'subdomain_id',
        'slug',
    ];
    public function domain(): BelongsTo {
        return $this->belongsTo(Domain::class);
    }
    public function subdomain(): BelongsTo {
        return $this->belongsTo(Subdomain::class);
    }
}
