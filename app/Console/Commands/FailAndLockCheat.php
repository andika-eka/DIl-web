<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\SubcpmkPengambilan;
use App\Models\TesFormatif;

class FailAndLockCheat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cheat:subcpmk_fail_and_lock {id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make a subcpmk pengambilan failed all formatif tes and lock the siswa';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $id = $this->argument('id');
        $subPengambilan = SubcpmkPengambilan::find($id);
        $subPengambilan->status_subcpmkpengambilan =3;
        $subPengambilan->save();
        TesFormatif::where('id_subCpmkPengambilan', $id)->delete();
        for ($i = 1; $i < 4; $i++) {
            TesFormatif::create([
                'id_subCpmkPengambilan'=>  $subPengambilan->id_subcpmkpengambilan,
                'pengulangan_tesFormatif'=> $i,
                'waktuMulai_TesFormatif'=> date("Y-m-d H:i:s"),
                'waktuSelesai_tesFormatif'=> date('Y-m-d H:i:s',strtotime(date("Y-m-d H:i:s").'+'.rand(10,30).' minutes')),
                'nilai_tesFormatif'=> rand(10,50),
                'status_TesFormatif'=> 2,
            ]);
        }


        return Command::SUCCESS;
    }
}
