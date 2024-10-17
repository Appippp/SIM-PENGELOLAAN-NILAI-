@extends('layouts.main')

@section('title', 'Edit Data Siswa')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">EDIT DATA SISWA</h1>
    </div>

    <form action="{{ route('siswa.update', $siswa->id) }}" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="card-title">
                            <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">EDIT DATA SISWA
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="nis" class="col-md-2 col-form-label">NIS <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="nis" class="form-control @error('nis') is-invalid @enderror"
                                    placeholder="MASUKKAN NIS" value="{{ old('nis', $siswa->nis) }}">
                                @error('nis')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_lengkap" class="col-md-2 col-form-label">NAMA LENGKAP <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="nama_lengkap"
                                    class="form-control @error('nama_lengkap') is-invalid @enderror"
                                    placeholder="MASUKKAN NAMA LENGKAP"
                                    value="{{ old('nama_lengkap', $siswa->nama_lengkap) }}">
                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jk" class="col-md-2 col-form-label">JENIS KELAMIN <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <select name="jk" class="form-control @error('jk') is-invalid @enderror">
                                    <option value="">--- PILIH JENIS KELAMIN ---</option>
                                    <option value="Laki-laki" {{ old('jk', $siswa->jk) == 'Laki-laki' ? 'selected' : '' }}>
                                        Laki-laki</option>
                                    <option value="Perempuan" {{ old('jk', $siswa->jk) == 'Perempuan' ? 'selected' : '' }}>
                                        Perempuan</option>
                                </select>
                                @error('jk')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tempat_lahir" class="col-md-2 col-form-label">TEMPAT LAHIR <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="tempat_lahir"
                                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                                    placeholder="MASUKKAN TEMPAT LAHIR"
                                    value="{{ old('tempat_lahir', $siswa->tempat_lahir) }}">
                                @error('tempat_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tgl_lahir" class="col-md-2 col-form-label">TANGGAL LAHIR <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="date" name="tgl_lahir"
                                    class="form-control @error('tgl_lahir') is-invalid @enderror"
                                    value="{{ old('tgl_lahir', $siswa->tgl_lahir) }}">
                                @error('tgl_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="agama" class="col-md-2 col-form-label">AGAMA <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="agama"
                                    class="form-control @error('agama') is-invalid @enderror" placeholder="MASUKKAN AGAMA"
                                    value="{{ old('agama', $siswa->agama) }}">
                                @error('agama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-md-2 col-form-label">ALAMAT <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $siswa->alamat) }}</textarea>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_tlp" class="col-md-2 col-form-label">NO TELEPON <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="no_tlp"
                                    class="form-control @error('no_tlp') is-invalid @enderror"
                                    placeholder="MASUKKAN NO TELEPON" value="{{ old('no_tlp', $siswa->no_tlp) }}">
                                @error('no_tlp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_tlp_ortu" class="col-md-2 col-form-label">NO TELEPON ORTU <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="no_tlp_ortu"
                                    class="form-control @error('no_tlp_ortu') is-invalid @enderror"
                                    placeholder="MASUKKAN NO TELEPON ORTU"
                                    value="{{ old('no_tlp_ortu', $siswa->no_tlp_ortu) }}">
                                @error('no_tlp_ortu')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-2 col-form-label">STATUS <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="">--- PILIH STATUS ---</option>
                                    <option value="1" {{ old('status', $siswa->status) == '1' ? 'selected' : '' }}>
                                        Aktif</option>
                                    <option value="0" {{ old('status', $siswa->status) == '0' ? 'selected' : '' }}>
                                        Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="wali_kelas_id" class="col-md-2 col-form-label">WALI KELAS <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <select class="form-control @error('wali_kelas_id') is-invalid @enderror"
                                    id="wali_kelas_id" name="wali_kelas_id">
                                    <option value="">--- PILIH WALI KELAS ---</option>
                                    @foreach ($kelas as $kelasItem)
                                        <option value="{{ $kelasItem->id }}"
                                            {{ old('wali_kelas_id', $siswa->wali_kelas_id) == $kelasItem->id ? 'selected' : '' }}>
                                            {{ $kelasItem->kelas->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('wali_kelas_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tahun_ajaran_id" class="col-md-2 col-form-label">TAHUN AJARAN <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <select class="form-control @error('tahun_ajaran_id') is-invalid @enderror"
                                    id="tahun_ajaran_id" name="tahun_ajaran_id">
                                    <option value="">--- PILIH TAHUN AJARAN ---</option>
                                    @foreach ($tahun_ajaran as $tahunAjaran)
                                        <option value="{{ $tahunAjaran->id }}"
                                            {{ old('tahun_ajaran_id', $siswa->tahun_ajaran_id) == $tahunAjaran->id ? 'selected' : '' }}>
                                            {{ $tahunAjaran->tahun_ajaran }}.{{ $tahunAjaran->semester }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tahun_ajaran_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row">
                            <label for="foto" class="col-md-2 col-form-label">FOTO</label>
                            <div class="col-md-10">
                                <input type="file" name="foto"
                                    class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @if ($siswa->foto)
                                    <img src="{{ asset('storage/' . $siswa->foto) }}" alt="Foto Siswa" width="100"
                                        class="mt-2">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="row mb-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="card-title">
                            <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white"> HAK
                                AKSES
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="username" class="col-md-2 col-form-label">Username <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" id="username" name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    placeholder="Masukkan Username"
                                    value="{{ old('username', $siswa->user->username ?? '') }}" readonly>
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-2 col-form-label">Password <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="password" id="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    placeholder="Masukkan Password">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                <small class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah
                                    password</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        <a href="{{ route('siswa.index') }}" class="btn btn-secondary">KEMBALI</a>
                    </div>
                </div>
            </div>
        </div>

    </form>

@endsection
