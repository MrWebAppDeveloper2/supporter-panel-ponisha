<?php

namespace Database\Seeders;

use App\Models\Workgroup;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class WorkgroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Workgroup::factory()->count(15)->create();
    }
}
