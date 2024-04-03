<?php

namespace App\Models;

use App\Models\Clinic;
use App\Models\Township;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];
    public function townships(): HasMany {
        return $this->hasMany(Township::class);
    }
    public function clinics(): HasMany {
        return $this->hasMany(Clinic::class);
    }
}
