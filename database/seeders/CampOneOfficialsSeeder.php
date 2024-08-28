<?php

namespace Database\Seeders;
use App\Models\Officials;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
class CampOneOfficialsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Officials::create([
            'barangay_id'=>'1',
            'firstname' => 'Jose ',
            'middlename'=>'Dela Cruz',
            'lastname'=>'Devenencia',
            'birthdate'=>Carbon::parse('9-8-1957'),
            'contact' => '09196394011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
            'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'1',
            'firstname' => 'Raven ',
            'middlename'=>'Louie',
            'lastname'=>'Manaois',
            'birthdate'=>Carbon::parse('9-8-1966'),
            'contact' => '0914564011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
            'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'1',
            'firstname' => 'Glivert',
            'middlename'=>'Alfonso',
            'lastname'=>'Kamlas',
            'birthdate'=>Carbon::parse('9-8-1988'),
            'contact' => '09396391234',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
            'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'1',
            'firstname' => 'Maria',
            'middlename'=>'Sta Maria',
            'lastname'=>'So',
            'birthdate'=>Carbon::parse('9-8-1987'),
            'contact' => '09196666011',
            'gender' => 'Female',
            'status' => 'Living',
            'is_active' => 'Yes',
            'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'1',
            'firstname' => 'Manlo',
            'middlename'=>'Grado',
            'lastname'=>'Kamanlas',
            'birthdate'=>Carbon::parse('9-8-1957'),
            'contact' => '09196394011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
            'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'1',
            'firstname' => 'Jojo',
            'middlename'=>'Binay',
            'lastname'=>'Devenencia',
            'birthdate'=>Carbon::parse('9-8-1987'),
            'contact' => '09196888011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
            'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'1',
            'firstname' => 'Terressa',
            'middlename'=>'Dela Cruz',
            'lastname'=>'Lamlay',
            'birthdate'=>Carbon::parse('9-8-1967'),
            'contact' => '09196394011',
            'gender' => 'Female',
            'status' => 'Living',
            'is_active' => 'Yes',
            'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'1',
            'firstname' => 'Kevin Lo',
            'middlename'=>'Sao',
            'lastname'=>'Mamantika',
            'birthdate'=>Carbon::parse('9-8-1977'),
            'contact' => '09196394011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
            'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'1',
            'firstname' => 'Paul',
            'middlename'=>'Cruz',
            'lastname'=>'Logan',
            'birthdate'=>Carbon::parse('9-8-1979'),
            'contact' => '0913444011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
            'image'=>'noimage.jpg'
        ]);

        Officials::create([
            'barangay_id'=>'1',
            'firstname' => 'Jesus',
            'middlename'=>'Toe',
            'lastname'=>'Ganman',
            'birthdate'=>Carbon::parse('9-8-1967'),
            'contact' => '09336394011',
            'gender' => 'Male',
            'status' => 'Living',
            'is_active' => 'Yes',
            'image'=>'noimage.jpg'
        ]);
    }
}
