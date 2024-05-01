<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Chat extends Pivot
{
    use HasFactory;

    /**
     * Chat members may be tow user or group of users
     *
     * @return BelongsToMany
     */
    public function members():BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function messages():HasMany
    {
        return $this->hasMany(Message::class);
    }
}
