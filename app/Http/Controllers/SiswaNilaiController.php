<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Mapel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Nilai;

class SiswaNilaiController extends Controller
{

    public function index()
    {
        // Ambil pengguna yang sedang login
        $user = Auth::user();

        // Pastikan siswa ada untuk pengguna yang sedang login
        if (!$user->siswa) {
            return redirect()->route('some.error.page')->with('error', 'Data siswa tidak ditemukan.');
        }

        $siswa = $user->siswa;
        $siswaId = $siswa->id;

        // Ambil data kelas untuk siswa yang sedang login
        $kelas = $siswa->wali_kelas; // Pastikan Anda memiliki relasi yang benar

        // Ambil mata pelajaran yang sesuai dengan kelas siswa
        $mapel = Mapel::whereIn('wali_kelas_id', $kelas->pluck('id'))->get();

        // Ambil semua nilai siswa berdasarkan ID dan mapel
        $nilai = Nilai::where('siswa_id', $siswaId)
            ->whereIn('mapel_id', $mapel->pluck('id'))
            ->with('mapel')
            ->get()
            ->keyBy('mapel_id');

        // Cek mata pelajaran yang belum diinputkan nilainya
        $mapelBelumDiinputkan = $mapel->filter(function ($mapelItem) use ($nilai) {
            return !$nilai->has($mapelItem->id);
        });

        // Kirim data nilai, mapel, kelas, dan mapelBelumDiinputkan ke view
        return view('pages.nilai.index', compact('nilai', 'mapel', 'kelas', 'mapelBelumDiinputkan'));
    }
}
