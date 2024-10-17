<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Kelas;
use App\Models\Siswa;
use App\Models\TahunAjaran;
use App\Models\WaliKelas;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tahun_ajaran = TahunAjaran::all();
        return view('pages.data-siswa.index', compact('tahun_ajaran'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($tahunAjaranId, $kelasId)
    {
        // Pastikan tahun ajaran dan wali kelas ada
        $tahunAjaran = TahunAjaran::findOrFail($tahunAjaranId);
        $kelas = WaliKelas::findOrFail($kelasId);
    
        // Tampilkan form dengan tahun ajaran dan kelas yang sudah terisi otomatis
        return view('pages.data-siswa.create', compact('tahunAjaranId', 'kelasId'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|string|max:100|unique:tb_siswa',
            'nama_lengkap' => 'required|string|max:100',
            'jk' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_tlp' => 'required|string',
            'no_tlp_ortu' => 'required|string',
            'status' => 'required|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'wali_kelas_id' => 'required|exists:tb_wali_kelas,id',
            'tahun_ajaran_id' => 'required|exists:tb_tahun_ajaran,id',
            'username' => 'required|string|max:100|unique:users,username',
            'password' => 'required|string|min:8',
        ], [
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'File terlalu besar',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah ada'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto-siswa', $filename);
            $data['foto'] = $filename;
        }

        // Create the student (siswa) record
        $siswa = Siswa::create($data);

        // Create the user record
        $user = User::create([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 0,
        ]);

        $siswa->user_id = $user->id;
        $siswa->save();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil ditambahkan');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $siswa = Siswa::findOrFail($id);
        return view('pages.data-siswa.show', compact('siswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::with('user')->findOrFail($id);
        // Load data kelas dan tahun ajaran seperti sebelumnya
        $kelas = Walikelas::all();
        $tahun_ajaran = TahunAjaran::all();


        return view('pages.data-siswa.edit', compact('siswa', 'kelas', 'tahun_ajaran'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Ambil data siswa dan user yang akan diupdate
        $siswa = Siswa::findOrFail($id);
        $user = User::findOrFail($siswa->user_id);

        // Validasi input
        $request->validate([
            'nis' => 'required|string|max:100|unique:tb_siswa,nis,' . $id,
            'nama_lengkap' => 'required|string|max:100',
            'jk' => 'required|in:Laki-laki,Perempuan',
            'tempat_lahir' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'agama' => 'required|string|max:50',
            'alamat' => 'required|string',
            'no_tlp' => 'required|string',
            'no_tlp_ortu' => 'required|string',
            'status' => 'required|boolean',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'wali_kelas_id' => 'required|exists:tb_wali_kelas,id',
            'tahun_ajaran_id' => 'required|exists:tb_tahun_ajaran,id',
            'username' => [
                'required',
                'string',
                'max:100',
                Rule::unique('users', 'username')->ignore($user->id),
            ],
            'password' => 'nullable|string|min:8',
        ], [
            'foto.image' => 'File harus berupa gambar',
            'foto.max' => 'File terlalu besar',
            'required' => ':attribute harus diisi',
            'unique' => ':attribute sudah ada',
        ]);

        // Update data siswa
        $data = $request->except('foto', 'password', 'username'); // Exclude 'foto', 'password', and 'username' for now

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($siswa->foto && Storage::exists('public/foto-siswa/' . $siswa->foto)) {
                Storage::delete('public/foto-siswa/' . $siswa->foto);
            }

            // Simpan foto baru
            $file = $request->file('foto');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto-siswa', $filename);
            $data['foto'] = $filename;
        } else {
            $data['foto'] = $siswa->foto; // If no new photo, keep the old one
        }

        $siswa->update($data);

        // Update data user hanya jika username diubah atau password diisi
        $userData = [];
        if ($request->username !== $user->username) {
            $userData['username'] = $request->username;
        }

        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        if (!empty($userData)) {
            $user->update($userData);
        }

        // Redirect ke halaman index dengan pesan sukses
        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::findOrFail($id);

        // Hapus foto jika ada
        if ($siswa->foto) {
            Storage::delete($siswa->foto);
        }

        $siswa->delete();

        return redirect()->route('siswa.index')->with('success', 'Data siswa berhasil dihapus');
    }

    public function showKelas($tahunAjaranId)
    {
        // Validasi jika tahun ajaran ada
        $tahunAjaran = TahunAjaran::findOrFail($tahunAjaranId);
    
        // Ambil siswa berdasarkan tahun ajaran
        $siswa = Siswa::where('tahun_ajaran_id', $tahunAjaranId)->get();
    
        // Ambil data wali kelas berdasarkan tahun ajaran
        $kelas = WaliKelas::where('tahun_ajaran_id', $tahunAjaranId)->get();
    
        // Kirim data ke view
        return view('pages.data-siswa.kelas', compact('siswa', 'kelas', 'tahunAjaranId'));
    }
    
    public function showSiswa($tahunAjaranId, $kelasId)
    {
        // Validasi jika tahun ajaran dan kelas ada
        $tahunAjaran = TahunAjaran::findOrFail($tahunAjaranId);
        $kelas = WaliKelas::findOrFail($kelasId);
    
       
        // Ambil siswa berdasarkan tahun ajaran dan kelas
        $siswa = Siswa::where('tahun_ajaran_id', $tahunAjaranId)
            ->where('wali_kelas_id', $kelasId)
            ->get();
    
        // Kirim data ke view
        return view('pages.data-siswa.siswa', compact('siswa', 'kelas', 'tahunAjaranId', 'kelasId'));
    }
}
