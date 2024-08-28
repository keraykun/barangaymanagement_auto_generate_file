<?php

namespace Database\Seeders;
use App\Models\Officials;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Faker\Factory as Faker;
class PoblacionSouthOfficialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->faker = Faker::create();
        Officials::create([
            'barangay_id'=>'3',
            'firstname' =>$this->faker->firstName(),
            'middlename'=>$this->faker->lastName(),
            'lastname'=>$this->faker->lastName(),
            'birthdate'=>Carbon::parse('9-8-1957'),
            'contact' => '09196394011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
           'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'3',
            'firstname' =>$this->faker->firstName(),
            'middlename'=>$this->faker->lastName(),
            'lastname'=>$this->faker->lastName(),
            'birthdate'=>Carbon::parse('9-8-1966'),
            'contact' => '0914564011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
           'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'3',
            'firstname' =>$this->faker->firstName(),
            'middlename'=>$this->faker->lastName(),
            'lastname'=>$this->faker->lastName(),
            'birthdate'=>Carbon::parse('9-8-1988'),
            'contact' => '09396391234',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
           'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'3',
            'firstname' =>$this->faker->firstName(),
            'middlename'=>$this->faker->lastName(),
            'lastname'=>$this->faker->lastName(),
            'birthdate'=>Carbon::parse('9-8-1987'),
            'contact' => '09196666011',
            'gender' => 'Female',
            'status' => 'Living',
            'is_active' => 'Yes',
           'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'3',
            'firstname' =>$this->faker->firstName(),
            'middlename'=>$this->faker->lastName(),
            'lastname'=>$this->faker->lastName(),
            'birthdate'=>Carbon::parse('9-8-1957'),
            'contact' => '09196394011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
           'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'3',
            'firstname' =>$this->faker->firstName(),
            'middlename'=>$this->faker->lastName(),
            'lastname'=>$this->faker->lastName(),
            'birthdate'=>Carbon::parse('9-8-1987'),
            'contact' => '09196888011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
           'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'3',
            'firstname' =>$this->faker->firstName(),
            'middlename'=>$this->faker->lastName(),
            'lastname'=>$this->faker->lastName(),
            'birthdate'=>Carbon::parse('9-8-1967'),
            'contact' => '09196394011',
            'gender' => 'Female',
            'status' => 'Living',
            'is_active' => 'Yes',
           'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'3',
            'firstname' =>$this->faker->firstName(),
            'middlename'=>$this->faker->lastName(),
            'lastname'=>$this->faker->lastName(),
            'birthdate'=>Carbon::parse('9-8-1977'),
            'contact' => '09196394011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
           'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'3',
            'firstname' =>$this->faker->firstName(),
            'middlename'=>$this->faker->lastName(),
            'lastname'=>$this->faker->lastName(),
            'birthdate'=>Carbon::parse('9-8-1979'),
            'contact' => '0913444011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
           'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'3',
            'firstname' =>$this->faker->firstName(),
            'middlename'=>$this->faker->lastName(),
            'lastname'=>$this->faker->lastName(),
            'birthdate'=>Carbon::parse('9-8-1967'),
            'contact' => '09336394011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
           'image'=>'noimage.jpg'
        ]);
    }
}
