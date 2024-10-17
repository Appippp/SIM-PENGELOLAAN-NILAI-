<?php

namespace App\Http\Controllers;

use App\Models\TahunAjaran;
use Illuminate\Http\Request;

class TahunAjaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahunAjaran = TahunAjaran::all();
        return view ('pages.data-tahun-ajaran.index', compact('tahunAjaran'));
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
            'tahun_ajaran' => 'required',
            'semester' => 'required',
        ]);


        TahunAjaran::create([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
        ]);

        return back()->with('success', 'Data tahun ajaran berhasil ditambahkan !');
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tahun_ajaran' => 'required',
            'semester' => 'required',
        ]);

        $tahun_ajar = TahunAjaran::find($id);

        $tahun_ajar->update([
            'tahun_ajaran' => $request->tahun_ajaran,
            'semester' => $request->semester,
        ]);

        return back()->with('success', 'Data tahun ajaran berhasil di ubah !');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $tahun_ajar = TahunAjaran::find($id);
        $tahun_ajar->delete();

        return back()->with('success', 'Data tahun ajaran berhasil di hapus !');
    }
}
