<?php

namespace App\Models;

use App\Models\Question;
use App\Models\Subdomain;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Domain extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function subdomains(): HasMany {
        return $this->hasMany(Subdomain::class);
    }
    public function questions(): HasMany {
        return $this->hasMany(Question::class);
    }
}
