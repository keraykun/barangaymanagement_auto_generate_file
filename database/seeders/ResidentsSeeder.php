<?php

namespace Database\Seeders;

use App\Models\Districts;
use App\Models\Residents;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Carbon\Carbon;
use Faker\Factory as Faker;
class ResidentsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $this->faker = Faker::create();
        foreach (Districts::all() as $district) {
            for ($i=0; $i <rand(100,300) ; $i++) {
                $birthdate = $this->faker->randomElement([Carbon::parse('9-8-1967'),Carbon::parse('10-3-1957'),Carbon::parse('2-8-1957'),Carbon::parse('9-11-1963'),Carbon::parse('3-5-1977'),Carbon::parse('4-6-1970'),Carbon::parse('9-8-1999'),Carbon::parse('9-8-2000')]);
                $age = $birthdate->diffInYears(Carbon::now('Asia/Manila'));
                Residents::create([
                    'barangay_id'=>$district->barangay_id,
                    'district_id'=>$district->id,
                    'firstname' =>$this->faker->firstName(),
                    'middlename'=>$this->faker->lastName(),
                    'lastname'=>$this->faker->lastName(),
                    'birthdate'=>$birthdate,
                    'age'=>$age+1,
                    'contact'=>$this->faker->randomElement(['09111312341','09998812341','09171231234','09171231234','09612312335','09672312377','09712312333','09133312344','09912312346','09999312347','09314512347','09882312345','09312312341','09698312341','09314747341']),
                    'gender' =>$this->faker->randomElement(['Male','Female']),
                    'status' => 'Living',
                    // 'is_active' => 'Yes',
                    'image'=>'noimage.jpg'
                ]);
            }
        }


        // $official = Officials::whereIn('id',[21])->first();
        // $kapitan = Positions::where('name','Kapitan')->first();
        // $official->positions()->attach($kapitan,['barangay_id'=>3,'unique'=>1]);

        // foreach(Officials::whereBetween('id',[22,30])->get() as $official){
        //     $kagawad = Positions::where('name','Kagawad')->get();
        //     $official->positions()->attach($kagawad,['barangay_id'=>3]);
        // }
    }
}
