<?php

namespace App\Repositories;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Collection;

class MeetingRepository
{
    public function all(array $columns = ['*']):Collection
    {
        return Meeting::all($columns);
    }
}
