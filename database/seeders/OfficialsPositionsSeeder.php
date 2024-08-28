<?php

namespace Database\Seeders;
use App\Models\Officials;
use App\Models\Positions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OfficialsPositionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $official = Officials::whereIn('id',[1])->first();
        $kapitan = Positions::where('name','Kapitan')->first();
        $official->positions()->attach($kapitan,['barangay_id'=>1,'unique'=>1]);

        $official = Officials::whereIn('id',[2])->first();
        $treasurer = Positions::where('name','Treasurer')->first();
        $official->positions()->attach($treasurer,['barangay_id'=>1,'unique'=>1]);

        $official = Officials::whereIn('id',[3])->first();
        $secretary = Positions::where('name','Secretary')->first();
        $official->positions()->attach($secretary,['barangay_id'=>1,'unique'=>1]);

        foreach(Officials::whereBetween('id',[4,10])->get() as $official){
            $kagawad = Positions::where('name','Kagawad')->get();
            $official->positions()->attach($kagawad,['barangay_id'=>1]);
        }

        $official = Officials::whereIn('id',[11])->first();
        $kapitan = Positions::where('name','Kapitan')->first();
        $official->positions()->attach($kapitan,['barangay_id'=>2,'unique'=>1]);

        $official = Officials::whereIn('id',[12])->first();
        $treasurer = Positions::where('name','Treasurer')->first();
        $official->positions()->attach($treasurer,['barangay_id'=>2,'unique'=>1]);

        $official = Officials::whereIn('id',[13])->first();
        $secretary = Positions::where('name','Secretary')->first();
        $official->positions()->attach($secretary,['barangay_id'=>2,'unique'=>1]);

        foreach(Officials::whereBetween('id',[14,20])->get() as $official){
            $kagawad = Positions::where('name','Kagawad')->get();
            $official->positions()->attach($kagawad,['barangay_id'=>2]);
        }

        $official = Officials::whereIn('id',[21])->first();
        $kapitan = Positions::where('name','Kapitan')->first();
        $official->positions()->attach($kapitan,['barangay_id'=>3,'unique'=>1]);

        $official = Officials::whereIn('id',[22])->first();
        $treasurer = Positions::where('name','Treasurer')->first();
        $official->positions()->attach($treasurer,['barangay_id'=>3,'unique'=>1]);

        $official = Officials::whereIn('id',[23])->first();
        $secretary = Positions::where('name','Secretary')->first();
        $official->positions()->attach($secretary,['barangay_id'=>3,'unique'=>1]);

        foreach(Officials::whereBetween('id',[24,30])->get() as $official){
            $kagawad = Positions::where('name','Kagawad')->get();
            $official->positions()->attach($kagawad,['barangay_id'=>3]);
        }


    }
}
