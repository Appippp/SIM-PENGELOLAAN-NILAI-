<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Nilai;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Auth;

class NilaiController extends Controller
{

    public function tahunAjaran()
    {
        $user = Auth::user();
        $pegawai = $user->pegawai; // Mengambil data guru yang sedang login

        if (is_null($pegawai)) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar sebagai guru.');
        }

        // Ambil mata pelajaran yang diampu oleh guru
        $tahun_ajaran = TahunAjaran::all();

        return view('pages.data-nilai.tahun-ajaran', compact('tahun_ajaran'));
    }

    public function index($tahunAjaranId)
    {
        $user = Auth::user();
        $pegawai = $user->pegawai; // Mengambil data guru yang sedang login

        if (is_null($pegawai)) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar sebagai guru.');
        }

        $tahun_ajaran = TahunAjaran::findOrFail($tahunAjaranId);

        // Ambil nilai berdasarkan tahun ajaran
        $nilai = Nilai::where('tahun_ajaran_id', $tahunAjaranId)->get();

        // Ambil kelas yang relevan dengan tahun ajaran ini
        $kelas = WaliKelas::where('tahun_ajaran_id', $tahunAjaranId)->get();


        return view('pages.data-nilai.index', compact('kelas', 'nilai', 'tahunAjaranId'));
    }



    public function lihat($tahun_ajaran_id, $wali_kelas_id)
    {


        $user = Auth::user();
        $pegawai = $user->pegawai; // Mengambil data guru yang sedang login

        if (is_null($pegawai)) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar sebagai guru.');
        }

        // Fetch the class data
        $kelas = WaliKelas::findOrFail($wali_kelas_id);

        // Fetch the subjects based on the class
        // Ambil mata pelajaran yang diampu oleh guru
        $mapel = $pegawai->mapel->pluck('id')->toArray();

        // Ambil siswa berdasarkan tahun_ajaran_id dan wali_kelas_id
        $siswa = Siswa::where('tahun_ajaran_id', $tahun_ajaran_id)
            ->where('wali_kelas_id', $wali_kelas_id)
            ->get();

        // Ambil nilai siswa berdasarkan ID mata pelajaran yang diampu oleh guru
        $nilai = Nilai::whereIn('mapel_id', $mapel)
            ->whereIn('siswa_id', $siswa->pluck('id'))
            ->get()
            ->keyBy('siswa_id');



        return view('pages.data-nilai.siswa', compact('siswa', 'nilai'));
    }






    public function create($siswa_id)
    {
        $siswa = Siswa::findOrFail($siswa_id);
        $user = Auth::user();
        $pegawai = $user->pegawai; // Mengambil data guru yang sedang login

        if (is_null($pegawai)) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar sebagai guru.');
        }

        // Ambil mata pelajaran yang diampu oleh guru
        $mapel = $pegawai->mapel;

        // Filter mata pelajaran berdasarkan kelas siswa
        $mapelKelas = $mapel->filter(function ($m) use ($siswa) {
            return $m->wali_kelas_id == $siswa->wali_kelas_id;
        });

        if ($mapelKelas->isEmpty()) {
            return redirect()->back()->with('error', 'Anda tidak memiliki mata pelajaran untuk kelas ini.');
        }

        return view('pages.data-nilai.create', [
            'siswa' => $siswa,
            'mapel' => $mapelKelas, // Kirim hanya mata pelajaran yang relevan dengan kelas siswa
            'pegawai' => $pegawai
        ]);
    }


    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'siswa_id' => 'required|exists:tb_siswa,id',
            'mapel_id' => 'required|exists:tb_mapel,id',
            'wali_kelas_id' => 'required|exists:tb_wali_kelas,id',
            'tahun_ajaran_id' => 'required|exists:tb_tahun_ajaran,id',
            'tugas' => 'required|numeric|min:0|max:100',
            'uts' => 'required|numeric|min:0|max:100',
            'uas' => 'required|numeric|min:0|max:100',
        ]);

        $user = Auth::user();
        $pegawai = $user->pegawai; // Mengambil data pegawai yang sedang login

        if (is_null($pegawai)) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar sebagai guru.');
        }

        // Ambil ID mata pelajaran yang diampu oleh pegawai
        $mapelIds = $pegawai->mapel->pluck('id')->toArray();

        // Pastikan mata pelajaran yang dipilih adalah milik guru yang sedang login
        if (!in_array($validated['mapel_id'], $mapelIds)) {
            return redirect()->back()->with('error', 'Anda tidak berhak memberikan nilai untuk mata pelajaran ini.');
        }

        // Cek jika siswa terdaftar di kelas yang dipilih
        $siswa = Siswa::findOrFail($validated['siswa_id']);
        if ($siswa->wali_kelas_id != $validated['wali_kelas_id']) {
            return redirect()->back()->with('error', 'Siswa tidak terdaftar di kelas ini.');
        }

        // Cek apakah nilai sudah ada
        $nilai = Nilai::updateOrCreate(
            [
                'siswa_id' => $validated['siswa_id'],
                'mapel_id' => $validated['mapel_id'],
                'wali_kelas_id' => $validated['wali_kelas_id'],
                'tahun_ajaran_id' => $validated['tahun_ajaran_id'] // Menambahkan tahun_ajaran_id ke kondisi pencarian
            ],
            [
                'tugas' => $validated['tugas'],
                'uts' => $validated['uts'],
                'uas' => $validated['uas'],
                'nilai' => ($validated['tugas'] + $validated['uts'] + $validated['uas']) / 3
            ]
        );

        // Optionally determine the appropriate ID or route if needed
        $kelas_id = $siswa->wali_kelas_id; // Example: Using siswa's wali_kelas_id for redirection
        $tahun_ajaran_id = $validated['tahun_ajaran_id']; // Get tahun_ajaran_id from validated data

        return redirect()->route('tahun.ajaran', ['id' => $kelas_id, 'tahun_ajaran_id' => $tahun_ajaran_id])->with('success', 'Nilai berhasil disimpan.');
    }



    public function lihatNilai($wali_kelas_id, $tahun_ajaran_id)
    {
        $user = Auth::user();
        $pegawai = $user->pegawai;

        // Check if the teacher is allowed to view this class
        $kelasIds = $pegawai->mapel->pluck('wali_kelas_id')->unique()->toArray();
        if (!in_array($wali_kelas_id, $kelasIds)) {
            return redirect()->back()->with('error', 'Anda tidak berhak melihat data nilai untuk kelas ini.');
        }

        // Fetch the class data
        $kelas = WaliKelas::findOrFail($wali_kelas_id);

        // Fetch the subjects based on the class
        $mapel = $pegawai->mapel->where('wali_kelas_id', $wali_kelas_id);

        // Get the list of students in the class for the given year
        $siswa = Siswa::where('wali_kelas_id', $wali_kelas_id)
            ->where('tahun_ajaran_id', $tahun_ajaran_id)
            ->get();

        // Get the grades for the students in the specified class and year
        $nilai = Nilai::where('wali_kelas_id', $wali_kelas_id)
            ->where('tahun_ajaran_id', $tahun_ajaran_id)
            ->whereIn('mapel_id', $mapel->pluck('id'))
            ->with(['siswa', 'mapel'])
            ->get();



        // Get the IDs of students who have grades
        $siswaWithNilaiIds = $nilai->pluck('siswa_id')->unique()->toArray();

        // Filter students who do not have grades
        $siswaBelumMengisi = $siswa->whereNotIn('id', $siswaWithNilaiIds);

        return view('pages.data-nilai.detail', compact('kelas', 'nilai', 'mapel', 'siswaBelumMengisi'));
    }



    public function edit($id)
    {
        $nilai = Nilai::findOrFail($id);
        $user = Auth::user();
        $pegawai = $user->pegawai; // Mengambil data pegawai yang sedang login

        // Pastikan mata pelajaran yang dipilih adalah milik pegawai yang sedang login
        $mapel = $pegawai->mapel->pluck('id')->toArray();
        if (!in_array($nilai->mapel_id, $mapel)) {
            return redirect()->back()->with('error', 'Anda tidak berhak mengedit nilai ini.');
        }

        return view('pages.data-nilai.edit', compact('nilai'));
    }

    public function update(Request $request, $id)
    {
        // Validasi data
        $validated = $request->validate([
            'tugas' => 'required|numeric',
            'uts' => 'required|numeric',
            'uas' => 'required|numeric',
        ]);

        $nilai = Nilai::findOrFail($id);
        $user = Auth::user();
        $pegawai = $user->pegawai; // Mengambil data pegawai yang sedang login

        // Pastikan mata pelajaran yang dipilih adalah milik pegawai yang sedang login
        $mapel = $pegawai->mapel->pluck('id')->toArray();
        if (!in_array($nilai->mapel_id, $mapel)) {
            return redirect()->back()->with('error', 'Anda tidak berhak mengedit nilai ini.');
        }

        // Hitung nilai akhir
        $nilaiAkhir = ($validated['tugas'] + $validated['uts'] + $validated['uas']) / 3;

        // Perbarui data nilai
        $nilai->tugas = $validated['tugas'];
        $nilai->uts = $validated['uts'];
        $nilai->uas = $validated['uas'];
        $nilai->nilai = $nilaiAkhir;
        $nilai->save();

        return redirect()->route('nilai.index', $nilai->kelas_id)->with('success', 'Nilai berhasil diperbarui.');
    }


    public function cetakPDF(Request $request)
    {
        $user = Auth::user();
        $pegawai = $user->pegawai;

        if (is_null($pegawai)) {
            return redirect()->back()->with('error', 'Anda tidak terdaftar sebagai pegawai.');
        }

        $kelas_id = $request->input('wali_kelas_id');
        $mapel_id = $request->input('mapel_id');

        // Validate that the class ID belongs to the teacher
        $kelasIds = $pegawai->mapel->pluck('wali_kelas_id')->unique()->toArray();
        if (!in_array($kelas_id, $kelasIds)) {
            return redirect()->back()->with('error', 'Anda tidak berhak melihat data nilai untuk kelas ini.');
        }

        // Find the class by ID
        $kelas = Kelas::find($kelas_id);

        if (!$kelas) {
            return redirect()->back()->with('error', 'Kelas tidak ditemukan.');
        }

        // Get the subjects for the class
        $mapelIds = $pegawai->mapel->where('wali_kelas_id', $kelas_id)->pluck('id')->toArray();

        // Validate that the selected subject belongs to the class
        if (!in_array($mapel_id, $mapelIds)) {
            return redirect()->back()->with('error', 'Mata pelajaran tidak valid untuk kelas ini.');
        }

        // Get the grades based on class ID and subject ID
        $nilai = Nilai::where('wali_kelas_id', $kelas_id)
            ->where('mapel_id', $mapel_id)
            ->with(['siswa', 'mapel'])
            ->get();

        if ($nilai->isEmpty()) {
            return redirect()->back()->with('error', 'Data nilai tidak ditemukan.');
        }

        // Generate PDF
        try {
            $pdf = Pdf::loadView('pages.data-nilai.cetak-nilai', compact('kelas', 'nilai'));
            return $pdf->download('Data_Nilai_Kelas_' . $kelas->nama_kelas . '_Mapel_' . $nilai->first()->mapel->nama_mapel . '.pdf');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menghasilkan PDF: ' . $e->getMessage());
        }
    }
}
