<?php

namespace Database\Seeders;

use App\Models\Barangays;
use App\Models\Payments;
use App\Models\Residents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      for ($i=1; $i <=300 ; $i++) {
        Payments::create([
            'barangay_id'=>Barangays::all()->random()->id,
            'name'=>fake()->randomElement(['Indigency Certificate','Barangay Clearance','Marriage Certificate']),
            'price'=>fake()->numberBetween(200,1000),
            'month'=>fake()->dateTimeBetween('-9 months', 'now'),
            'user_id'=>Residents::all()->random()->id,
           ]);
      }
    }
}
