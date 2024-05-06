<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Bug extends Model
{
    use HasFactory;

    /**
     * The bug reporter.
     *
     * @return BelongsTo
     */
    public function creator():BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
