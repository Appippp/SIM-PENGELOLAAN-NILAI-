<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jabatan = Jabatan::all();
        return view('pages.data-jabatan.index', compact('jabatan'));
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
            'nama_jabatan' => 'required',
        ]);

        $jabatan = Jabatan::create([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        return back()->with('success', 'Data jabatan berhasil ditambahkan !');
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
            'nama_jabatan' => 'required',
        ]);

        $jabatan = Jabatan::find($id);
        $jabatan->update([
            'nama_jabatan' => $request->nama_jabatan,
        ]);

        return back()->with('success', 'Data jabatan berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $jabatan = Jabatan::find($id);
        $jabatan->delete();
        return back()->with('success', 'Data jabatan berhasil dihapus !');
    }
}
