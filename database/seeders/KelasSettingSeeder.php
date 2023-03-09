<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\SettingKelas;



class KelasSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kelas = Kelas::all();
        foreach($kelas as $k){
            $setting = new SettingKelas;
            $setting->id_settting_kelas = $k->id_kelas;
            $setting->save();
        }

    }
}
