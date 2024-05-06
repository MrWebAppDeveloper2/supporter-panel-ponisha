<?php

namespace App\Repositories;

use App\Models\Bug;

class BugRepository
{
    public function paginate(int $perPage = 20)
    {
        return Bug::paginate($perPage);
    }
}
