<?php

namespace App\Models;

use App\Models\Clinic;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Organization extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'abbr',
    ];
    public function users(): HasMany {
        return $this->hasMany(User::class);
    }
    public function clinics(): HasMany {
        return $this->hasMany(Clinic::class);
    }
}
