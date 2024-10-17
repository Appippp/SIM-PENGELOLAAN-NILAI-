<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Mapel;
use App\Models\Siswa;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function showPegawai()
    {
        return view('pages.dashboard.pegawai');
    }

    public function showAdmin()
    {
        $siswa = Siswa::count();
        $guru = Pegawai::count();
        $mapel = Mapel::count();

        // Ambil data siswa per kelas
        $siswaPerKelas = Siswa::select('wali_kelas_id', DB::raw('count(*) as total'))
            ->groupBy('wali_kelas_id')
            ->get();

        // Format data untuk chart
        $kelas = $siswaPerKelas->pluck('wali_kelas.kelas_id')->toArray(); // Anda perlu menyesuaikan dengan kolom yang sesuai ('wali_kelas.nama_kelas'); // Anda perlu menyesuaikan dengan nama kolom yang sesuai
        $jumlahSiswa = $siswaPerKelas->pluck('total');

        // Ambil data jumlah pegawai berdasarkan status (0 atau 1)
        $statusCounts = Pegawai::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        // Jika status 0 adalah 'Honor Yayasan' dan status 1 adalah 'Honor Dinas'
        $statuses = ['Honor Yayasan', 'Honor Dinas'];
        $jumlahPegawai = [
            $statusCounts->get(0, 0), // jumlah pegawai dengan status 0
            $statusCounts->get(1, 0)  // jumlah pegawai dengan status 1
        ];

        return view('pages.dashboard.admin', compact('siswa', 'guru', 'mapel', 'kelas', 'jumlahSiswa', 'statuses', 'jumlahPegawai'));
    }
}
