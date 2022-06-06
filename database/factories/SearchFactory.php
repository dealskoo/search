<?php

namespace Database\Factories\Dealskoo\Search\Models;

use Dealskoo\Country\Models\Country;
use Dealskoo\Search\Models\Search;
use Illuminate\Database\Eloquent\Factories\Factory;

class SearchFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Search::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'country_id' => Country::factory()
        ];
    }
}
