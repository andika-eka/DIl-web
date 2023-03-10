<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PassedTesFormatif implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;    

    public function __construct($subcmpk, $kelas)
    {
        $this->subcmpk = $subcmpk;
        $this->kelas = $kelas;
    }
    public function query()
    {
        return DB::table('siswa')
            ->join('pengambilankelas', 'siswa.id_siswa', '=', 'pengambilankelas.id_siswa')
            ->join('subcpmkpengambilan', 'pengambilankelas.id_pengambilanKelas', '=', 'subcpmkpengambilan.id_pengambilanKelas')
            ->join('tesformatif', 'subcpmkpengambilan.id_subcpmkpengambilan', '=', 'tesformatif.id_subcpmkpengambilan')
            ->select('siswa.identitas_siswa',
                    'siswa.nama_siswa',
                    DB::raw('max(tesformatif.nilai_tesFormatif) as nilai_tesFormatif'), 
                    'tesformatif.pengulangan_tesFormatif', 
                    'tesformatif.waktuMulai_TesFormatif',
                    DB::raw('TIMESTAMPDIFF(MINUTE,tesformatif.waktuMulai_TesFormatif, tesformatif.waktuSelesai_tesFormatif) as waktu_tes'))
            ->groupBy('siswa.id_siswa')
            ->where('pengambilankelas.id_kelas','=', $this->kelas)
            ->where('subcpmkpengambilan.id_subCPMK', '=',  $this->subcmpk)
            ->where('tesformatif.status_TesFormatif', '=',  3)
            ->orderBy('siswa.id_siswa', 'DESC');
    }

    public function headings(): array
    {
        return [
            'nim',
            'nama mahasiswa',
            'nilai tes formatif',
            'tes ke-',
            'tgl tes',
            'waktu tes(menit)',
        ];
    }
}
