<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Kelas;
use App\Models\Mapel;
use App\Models\Pegawai;
use App\Models\TahunAjaran;
use App\Models\WaliKelas;
use Illuminate\Http\Request;

class MapelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mapel = Mapel::with('pegawai', 'wali_kelas')->get();
        return view('pages.data-mapel.index', compact('mapel'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pegawai = Pegawai::all();
        $kelas = WaliKelas::all();
        $tahun_ajar = TahunAjaran::all();
        return view('pages.data-mapel.create', compact('pegawai', 'kelas', 'tahun_ajar',));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'pegawai_id' => 'required|exists:tb_pegawai,id',
            'tahun_ajaran_id' => 'required|exists:tb_tahun_ajaran,id',
            'wali_kelas_id' => 'required|exists:tb_wali_kelas,id',
            'kkm' => 'required|integer|min:0',
        ]);

        // Simpan data mata pelajaran
        $mapel = new Mapel();
        $mapel->nama_mapel = $request->nama_mapel;
        $mapel->pegawai_id = $request->pegawai_id;
        $mapel->tahun_ajaran_id = $request->tahun_ajaran_id;
        $mapel->wali_kelas_id = $request->wali_kelas_id;
        $mapel->kkm = $request->kkm;
        $mapel->save();

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mapel = Mapel::findOrFail($id);
        $pegawai = Pegawai::all(); // Menggunakan model Guru untuk pegawai
        $kelas = Mapel::all();
        $tahun_ajar = TahunAjaran::all();
        return view('pages.data-mapel.edit', compact('mapel', 'pegawai', 'kelas', 'tahun_ajar'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'nama_mapel' => 'required|string|max:255',
            'pegawai_id' => 'required|exists:tb_pegawai,id',
            'tahun_ajaran_id' => 'required|exists:tb_tahun_ajaran,id',
            'wali_kelas_id' => 'required|exists:tb_wali_kelas,id',
            'kkm' => 'required|integer|min:0',
        ]);

        // Temukan mata pelajaran yang akan diupdate
        $mapel = Mapel::findOrFail($id);
        $mapel->nama_mapel = $request->nama_mapel;
        $mapel->pegawai_id = $request->pegawai_id;
        $mapel->tahun_ajaran_id = $request->tahun_ajaran_id;
        $mapel->wali_kelas_id = $request->wali_kelas_id;
        $mapel->kkm = $request->kkm;
        $mapel->save();

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Temukan mata pelajaran yang akan dihapus
        $mapel = Mapel::findOrFail($id);
        $mapel->delete();

        return redirect()->route('mapel.index')->with('success', 'Data mata pelajaran berhasil dihapus.');
    }
}
