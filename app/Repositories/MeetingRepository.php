<?php

namespace App\Repositories;

use App\Models\Meeting;
use Illuminate\Database\Eloquent\Collection;

class MeetingRepository
{
    public function delete(Meeting $meeting):bool
    {
        return $meeting->delete();
    }

    public function create(array $data):Meeting|false
    {
        return Meeting::create($data);
    }

    public function all(array $columns = ['*']):Collection
    {
        return Meeting::all($columns);
    }
}
