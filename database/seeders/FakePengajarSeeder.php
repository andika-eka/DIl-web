<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\User;
use App\Models\Pengajar;

class FakePengajarSeeder extends Seeder
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
        for ($i=0; $i < 40; $i++) 
        {
            $user = new User;
            $user->name = $faker->name();
            $user->email =$faker->email();;
            $user->email_verified_at = now();
            $user->password = bcrypt('test');
            $user->tipe_pengguna = 2 ;
            $user->status_pengguna = 1;
            $user->save();
            
            $pengajar  = new Pengajar;
            
            $pengajar->id_pengajar = $user->id;
            $pengajar->email_pengajar = $user->email;
            $pengajar->identitas_pengajar    = $faker->asciify('********************');
            $pengajar->nama_pengajar         = $user->name;
            $pengajar->jenisKelamin_Pengajar = $faker->numberBetween(1,2);
            $pengajar->tanggalLahir_Pengajar = $faker->date();
            $pengajar->account_active        = true;
            $pengajar->save();
            
        }
    }
}
