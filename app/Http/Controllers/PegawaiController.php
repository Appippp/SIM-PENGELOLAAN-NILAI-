<?php

namespace App\Http\Controllers;

use App\Models\Pegawai;
use App\Models\User;
use App\Models\Jabatan;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pegawai = Pegawai::with('jabatan')->get(); // Mengambil pegawai dengan relasi jabatan
        return view('pages.data-pegawai.index', compact('pegawai'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jabatan = Jabatan::all();
        return view('pages.data-pegawai.create', compact('jabatan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'jabatan_id' => 'required|exists:tb_jabatan,id',
            'nip' => 'nullable|string|max:11',
            'nama_lengkap' => 'required|string',
            'jk' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tgl_lahir' => 'required|date',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'no_tlp' => 'required|string',
            'status' => 'required|boolean',
            'foto' => 'nullable|image|max:2048',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:8',
            'role' => 'required|in:1,2', // 1 untuk ADMIN, 2 untuk GURU
        ], [
            'jabatan_id.exists' => 'Jabatan tidak tersedia',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'File terlalu besar',
            'required' => ':attribute harus diisi',
            'nip.max' => 'NUPTK hanya bisa 11 karakter',
        ]);

        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $newImage = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto-pegawai', $newImage);
        } else {
            $newImage = '';
        }

        // Simpan data ke tabel users untuk hak akses
        $user = User::create([
            'username' => $request->username, // Asumsi email dihasilkan otomatis
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Simpan data ke tabel tb_guru
        $pegawai = Pegawai::create([
            'user_id' => $user->id,
            'jabatan_id' => $request->jabatan_id,
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            'status' => $request->status,
            'foto' => $newImage,
        ]);

        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $pegawai = Pegawai::with('jabatan')->findOrFail($id);
        return view('pages.data-pegawai.show', compact('pegawai'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $pegawai = Pegawai::findOrFail($id);
        $jabatan = Jabatan::all();
        return view('pages.data-pegawai.edit', compact('pegawai', 'jabatan'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Ambil data pegawai dan user yang akan diupdate
        $pegawai = Pegawai::findOrFail($id);
        $user = User::findOrFail($pegawai->user_id);


        $request->validate([
            'jabatan_id' => 'required|exists:tb_jabatan,id',
            'nip' => 'nullable|string',
            'nama_lengkap' => 'required|string',
            'jk' => 'required|string',
            'tempat_lahir' => 'required|string',
            'tgl_lahir' => 'required|date',
            'agama' => 'required|string',
            'alamat' => 'required|string',
            'no_tlp' => 'required|string',
            'status' => 'required|boolean',
            'foto' => 'nullable|image|max:2048',
            'username' => [
                'required',
                'string',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8',
            'role' => 'required|in:1,2', // 1 untuk ADMIN, 2 untuk GURU
        ], [
            'jabatan_id.exists' => 'Jabatan tidak tersedia',
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'File terlalu besar',
            'required' => ':attribute harus diisi',
        ]);




        // Cek apakah ada file foto yang diupload
        if ($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $newImage = time() . '_' . $foto->getClientOriginalName();
            $foto->storeAs('public/foto-pegawai', $newImage);

            // Hapus foto lama jika ada
            if ($pegawai->foto && file_exists(storage_path('app/public/foto-pegawai/' . $pegawai->foto))) {
                unlink(storage_path('app/public/foto-pegawai/' . $pegawai->foto));
            }
        } else {
            $newImage = $pegawai->foto;
        }

        // Update data di tabel users
        $user->update([
            'username' => $request->username,
            'role' => $request->role,
        ]);

        // Update password jika ada input baru
        if ($request->filled('password')) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        // Update data di tabel tb_guru
        $pegawai->update([
            'jabatan_id' => $request->jabatan_id,
            'nip' => $request->nip,
            'nama_lengkap' => $request->nama_lengkap,
            'jk' => $request->jk,
            'tempat_lahir' => $request->tempat_lahir,
            'tgl_lahir' => $request->tgl_lahir,
            'agama' => $request->agama,
            'alamat' => $request->alamat,
            'no_tlp' => $request->no_tlp,
            'status' => $request->status,
            'foto' => $newImage,
        ]);

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('pegawai.index')->with('success', 'Data pegawai berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $pegawai = Pegawai::findOrFail($id);

        // Hapus foto jika ada
        if ($pegawai->foto && file_exists(storage_path('app/public/foto-pegawai/' . $pegawai->foto))) {
            unlink(storage_path('app/public/foto-pegawai/' . $pegawai->foto));
        }

        // Hapus data pegawai dan user terkait
        $pegawai->delete();
        $pegawai->user()->delete();

        return back()->with('success', 'Data pegawai berhasil dihapus!');
    }
}
