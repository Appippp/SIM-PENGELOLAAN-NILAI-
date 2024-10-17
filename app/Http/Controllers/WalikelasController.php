<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use App\Models\Pegawai;
use App\Models\WaliKelas;
use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class WalikelasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_ajaran = TahunAjaran::all();
        return view('pages.wali-kelas.index', compact('tahun_ajaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pegawai_id' => 'required',
            'kelas_id' => 'required',
            'tahun_ajaran_id' => 'required',
        ]);

        WaliKelas::create([
            'pegawai_id' => $request->pegawai_id,
            'kelas_id' => $request->kelas_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
        ]);

        return redirect()->back()->with('success', 'Data Wali Kelas berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    // Menampilkan detail kelas berdasarkan tahun ajaran yang dipilih
    public function show($id)
    {
        $tahun_ajaran_id = $id;
        $wali_kelas = WaliKelas::where('tahun_ajaran_id', $id)->get();
        $pegawai = Pegawai::all();
        $kelas = Kelas::all();

        return view('pages.wali-kelas.detail', compact('wali_kelas', 'pegawai', 'kelas', 'tahun_ajaran_id'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama_kelas' => 'required',
        ]);

        $wali_kelas = WaliKelas::find($id);
        $wali_kelas->update([
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->back()->with('success', 'Data Wali Kelas berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $wali_kelas = WaliKelas::find($id);
        $wali_kelas->delete();

        return redirect()->back()->with('success', 'Data Wali Kelas berhasil dihapus!');
    }
}
