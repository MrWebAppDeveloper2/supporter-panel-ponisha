<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class Message extends Pivot
{
    use HasFactory;

    protected $table = 'messages';

    public function chat():BelongsTo
    {
        return $this->belongsTo(Chat::class);
    }
}
