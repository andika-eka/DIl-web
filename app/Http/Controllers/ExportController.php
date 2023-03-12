<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\PassedTesFormatif;
use Maatwebsite\Excel\Excel;
use Illuminate\Support\Facades\Auth;
class ExportController extends Controller
{
    //
    private $excel;

    private function checkAccessToKelas($id_kelas){
        $user = Auth::user();
        if($user->tipe_pengguna != 2){
            abort(403);
        }
        $pengajar =$user->detail;
        if (!$pengajar->isMengampuKelas($id_kelas)){
            abort(403);
        }
        
    }
    public function passedTesFormatif(Excel $excel, $subcpmk, $kelas)
    {
        $this->checkAccessToKelas($kelas);
        return $excel->download(new PassedTesFormatif($subcpmk, $kelas), $subcpmk.$kelas.'pass.xlsx');
    }
}
