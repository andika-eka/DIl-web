<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PengambilanKelas;
use App\Models\SubcpmkPengambilan;
use App\Models\TesFormatif;

class FinishTheKelasCheat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cheat:finish_the_kelas {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->argument('id');
        $pengambilanKelas = PengambilanKelas::find($id);
        $matkulsub = $pengambilanKelas->kelas->matakuliah->subCpmk;
        SubcpmkPengambilan::where('id_pengambilanKelas', $id)->delete();

        foreach ($matkulsub as $subcpmk){
            $subPengambilan = new SubcpmkPengambilan;
            $subPengambilan->id_pengambilanKelas = $id;
            $subPengambilan->id_subCPMK = $subcpmk->id_subCpmk;
            $subPengambilan->waktuMulai_Pengambilan =  date("Y-m-d H:i:s");
            $subPengambilan->waktuSelesai_Pengambilan = date("Y-m-d H:i:s");
            $subPengambilan->status_subcpmkpengambilan = 2;
            $subPengambilan->save();

            $tesFormatif = new TesFormatif;
            $tesFormatif->id_subCpmkPengambilan = $subPengambilan->id_subcpmkpengambilan;
            $tesFormatif->pengulangan_tesFormatif = 1;
            $tesFormatif->waktuMulai_TesFormatif =date("Y-m-d H:i:s");
            $tesFormatif->waktuSelesai_tesFormatif =date("Y-m-d H:i:s");
            $tesFormatif->nilai_tesFormatif =75;
            $tesFormatif->status_TesFormatif =3;
            $tesFormatif->save();
        }
        $pengambilanKelas->status_pengambilanKelas = 3;
        $pengambilanKelas->save();
        return 0;
    }
}
