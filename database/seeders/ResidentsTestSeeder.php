<?php

namespace Database\Seeders;

use App\Models\Districts;
use App\Models\Residents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
class ResidentsTestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->faker = Faker::create();
        $district = Districts::where('id',3)->first();
            for ($i=0; $i <32 ; $i++) {
                Residents::create([
                    'district_id'=>$district->id,
                    'firstname' =>$this->faker->firstName(),
                    'middlename'=>$this->faker->lastName(),
                    'lastname'=>$this->faker->lastName(),
                    'birthdate'=>$this->faker->dateTimeBetween('-30 years','now'),
                    'contact'=>$this->faker->randomElement(['09111312341','09998812341','09171231234','09171231234','09612312335','09672312377','09712312333','09133312344','09912312346','09999312347','09314512347','09882312345','09312312341','09698312341','09314747341']),
                    'gender' =>$this->faker->randomElement(['Male','Female']),
                    'status' => 'Living',
                    'is_active' => 'Yes',
                    'image'=>'noimage.jpg'
                ]);
            }

    }
}
