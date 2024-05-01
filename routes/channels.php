<?php

use App\Models\User;
use App\Models\Workgroup;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('admin', function (User $user){
   return $user->type == \App\Enums\User\UserType::ADMIN->value;
});

Broadcast::channel('workgroup.{workgroup_id}', function (User $user, int $workgroup_id){
    return in_array($workgroup_id, $user->workgroups->pluck('id')->toArray());
});
