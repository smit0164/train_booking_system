<?php

namespace Database\Seeders;

use App\Models\Stationinfo;
use Illuminate\Database\Seeder;

class StationinfoSeeder extends Seeder
{
    public function run()
    {
        Stationinfo::factory(20)->create();
    }
}
