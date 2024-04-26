<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Bug extends Model
{
    use HasFactory;

    /**
     * The bug reporter.
     *
     * @return MorphTo
     */
    public function creator():MorphTo
    {
        return $this->morphTo();
    }
}
