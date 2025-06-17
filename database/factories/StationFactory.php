<?php

namespace Database\Factories;

use App\Models\Stationinfo;
use Illuminate\Database\Eloquent\Factories\Factory;

class StationFactory extends Factory
{
    protected $model = Stationinfo::class;

    public function definition()
    {
        return [
            'name' => $this->faker->unique()->city,
            'code' => strtoupper($this->faker->lexify('???')),
            'total_no_platforms' => $this->faker->numberBetween(1, 20),
        ];
    }
}
