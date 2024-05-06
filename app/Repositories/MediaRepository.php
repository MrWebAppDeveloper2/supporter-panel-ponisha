<?php

namespace App\Repositories;

use App\Models\Media;

class MediaRepository
{
    public function paginate(int $perPage = 20)
    {
        return Media::paginate($perPage);
    }
}
