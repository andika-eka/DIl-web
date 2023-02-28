<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Kelas;
use Illuminate\Support\Facades\DB;
use App\Models\SubcpmkPengambilan;
use App\Models\PengambilanKelas;
use App\Models\TesFormatif;
use App\Models\Sumatif;

class SiswaManagementController extends Controller
{
    //
    private function checkAccessToKelas($id_kelas)
    {
        $user = Auth::user();
        if ($user->tipe_pengguna != 2) {
            abort(403);
        }
        $pengajar = $user->detail;
        if (!$pengajar->isMengampuKelas($id_kelas)) {
            abort(403);
        }
    }

    public function getEnrolledSiswa($id_kelas)
    {

        try {
            $this->checkAccessToKelas($id_kelas);
            $kelas = Kelas::find($id_kelas);
            $siswa = $kelas->enrolled();
            return response()->json([
                'siswa' =>  $siswa,
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function getApplyingSiswa($id_kelas)
    {

        try {
            $this->checkAccessToKelas($id_kelas);
            $kelas = Kelas::find($id_kelas);
            $siswa = $kelas->applying();
            return response()->json([
                'siswa' =>  $siswa,
                'success' => true,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function approveSiswa($id_kelas, $id_siswa)
    {
        try {
            $this->checkAccessToKelas($id_kelas);
            $kelas = Kelas::find($id_kelas);
            $kelas->approveSiswa($id_siswa);
            return response()->json([
                'success' => true,
                'notif' => ' siswa approved',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function getFormatifResult($id_kelas, $id_subcpmk)
    {
        try {
            $this->checkAccessToKelas($id_kelas);
            $kelas = Kelas::find($id_kelas);
            $siswa = $kelas->FormatifResult($id_subcpmk);
            return response()->json($siswa, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function getlockedSiswa($id_kelas)
    {
        try {
            $this->checkAccessToKelas($id_kelas);
            $kelas = Kelas::find($id_kelas);
            $siswa = $kelas->lockedSiswa();
            return response()->json($siswa, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function unlockSiswa($id_subcpmkpengambilan)
    {
        try {
            $subPengambilan = SubcpmkPengambilan::find($id_subcpmkpengambilan);
            $id_kelas = PengambilanKelas::find($subPengambilan->id_pengambilanKelas)->id_kelas;
            $this->checkAccessToKelas($id_kelas);
            TesFormatif::where('id_subCpmkPengambilan', $id_subcpmkpengambilan)->delete();
            $subPengambilan->status_subcpmkpengambilan = 2;
            return response()->json([
                'success' => true,
                'notif' => ' siswa unlocked',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function getSumatifResult($id_kelas)
    {
        try {
            $this->checkAccessToKelas($id_kelas);
            $sumatif = Kelas::find($id_kelas)->sumatif();
            return response()->json($sumatif, 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }

    public function SumatifDetail($id_sumatif)
    {
        try {
            $sumatif = Sumatif::find($id_sumatif);
            $this->checkAccessToKelas($sumatif->pengambilanKelas->id_kelas);
            return response()->json([
                'tes' => $sumatif,
                'jawaban' => $sumatif->veryDetail(),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => $e->getMessage(),
                'success' => false,
            ], 422);
        }
    }
}
