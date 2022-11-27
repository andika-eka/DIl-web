<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Soalpilihanganda;
use App\Models\Pilihanjawaban;

class JawabanSeeder extends Seeder
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
        $soals = Soalpilihanganda::all()->sortBy("id_soalPilihanGanda");
        //the is werid dupliction error that keep happenning
        //because the id doesnt start from 1
        //so this atleast fix it

        foreach ($soals as $soal)
        {
            $key = rand(1,4);
            for($j=0; $j<4; $j++)
            {
                $jawaban = new Pilihanjawaban();
                $jawaban->id_soalPilihanGanda = $soal->id_soalPilihanGanda;
                $jawaban->noUrut_pilihan = $j;
                $jawaban->teks_pilihan = $faker->bs();
                if ($key == $j){
                    $jawaban->status_pilihan = 1;
                }
                else{
                    $jawaban->status_pilihan = 0;
                }

                $probabilty = rand(1,3);
                if ($probabilty == 1){
                    $soal->pathFileGambar_soal = "D:\\PHP\\DIL\\public\\files\\soal\\1669480466.jpg";
                }
                $jawaban->save();
            }
            
        }
    }
}
