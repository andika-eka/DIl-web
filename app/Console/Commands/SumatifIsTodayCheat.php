<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SumatifIsTodayCheat extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cheat:sumatif_is_today';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'make all sumatifs available today';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $affected = DB::table('setting_kelas')
        ->update(['tgl_sumatif' => date("Y-m-d H:i:s")]);
        return 0;
    }
}
