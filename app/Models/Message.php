<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Message extends Model
{
    use HasFactory;

    public $guarded = ['id'];

    /**
     * The message sender
     *
     * @return MorphTo
     */
    public function senderable(): MorphTo
    {
        return $this->morphTo();
    }

    /**
     * The entity which message is belongs to
     *
     * @return MorphTo
     */
    public function messageable(): MorphTo
    {
        return $this->morphTo();
    }
}
