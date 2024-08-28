<?php

namespace Database\Factories;
use App\Models\Barangays;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Districts>
 */
class DistrictsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'barangay_id'=>Barangays::all()->random()->id,
            'name'=>'Purok '.$this->faker->unique()->randomDigit,
            // 'address'=>$this->faker->streetAddress(),
            // 'zone'=>$this->faker->unique()->numberBetween(100,500)
         ];
    }
}
