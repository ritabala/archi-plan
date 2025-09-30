<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Firm extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'slug',
        'address',
        'phone',
        'email',
        'website',
        'logo',
        'timezone',
        'locale',
    ];

    /**
     * Get the users for the firm.
     */
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
