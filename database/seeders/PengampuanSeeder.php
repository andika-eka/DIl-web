<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kelas;
use App\Models\Pengajar;
use App\Models\Pengampuan;

class PengampuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $kelases = Kelas::all();
        foreach ($kelases as $kelas)
        {
            $pengajars = Pengajar::inRandomOrder()->limit(rand(1,4))->get();
            foreach ($pengajars as $pengajar)
            {
                $pengampuan = new Pengampuan();
                $pengampuan->id_pengajar = $pengajar->id_pengajar;
                $pengampuan->id_kelas = $kelas->id_kelas;
                $pengampuan->status_pengampuan = 1;
                $pengampuan->save();
            }
        }
    }
}
