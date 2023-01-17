<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Soalpilihanganda;
use App\Models\Indikator;

class SoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();
        $indikators = Indikator::all();
        foreach ($indikators as $indikator)
        {
            for($j=0; $j<rand(1,6); $j++)
            {
                $soal = new Soalpilihanganda();
                $soal->id_indikator = $indikator->id_indikator;
                $soal->soal = $faker->realText($maxNbChars = 200, $indexSize = 2);
                $probabilty = rand(1,3);
                if ($probabilty == 1){
                    $soal->pathFileGambar_soal = "D:\\PHP\\DIL\\public\\files\\soal\\1669480466.jpg";
                }
                $soal->save();
            }
            
        }

    }
}
