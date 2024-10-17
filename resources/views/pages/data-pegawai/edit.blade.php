@extends('layouts.main')

@section('title', 'Edit Pegawai')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">EDIT DATA PEGAWAI</h1>
    </div>

    <form action="{{ route('pegawai.update', $pegawai->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="card-title">
                            <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">EDIT DATA
                                PEGAWAI</h5>
                        </div>
                    </div>
                    <div class="card-body">

                        <div class="form-group row">
                            <label for="nip" class="col-md-2 col-form-label">NUPTK</label>
                            <div class="col-md-10">
                                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                                    placeholder="MASUKKAN NUPTK" value="{{ old('nip', $pegawai->nip) }}">
                                @error('nip')
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
                                    value="{{ old('nama_lengkap', $pegawai->nama_lengkap) }}">
                                @error('nama_lengkap')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan_id" class="col-md-2 col-form-label">JABATAN <span
                                    class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <select name="jabatan_id" class="form-control @error('jabatan_id') is-invalid @enderror">
                                    <option value="">--- PILIH JABATAN ---</option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $pegawai->jabatan_id == $item->id ? 'selected' : '' }}>
                                            {{ $item->nama_jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('jabatan_id')
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
                                    <option value="Laki-laki" {{ $pegawai->jk == 'Laki-laki' ? 'selected' : '' }}>LAKI-LAKI
                                    </option>
                                    <option value="Perempuan" {{ $pegawai->jk == 'Perempuan' ? 'selected' : '' }}>PEREMPUAN
                                    </option>
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
                                    value="{{ old('tempat_lahir', $pegawai->tempat_lahir) }}">
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
                                    value="{{ old('tgl_lahir', $pegawai->tgl_lahir) }}">
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
                                <select name="agama" class="form-control @error('agama') is-invalid @enderror">
                                    <option value="">--- PILIH AGAMA ---</option>
                                    <option value="ISLAM" {{ $pegawai->agama == 'ISLAM' ? 'selected' : '' }}>ISLAM
                                    </option>
                                    <option value="KRISTEN-KHATOLIK"
                                        {{ $pegawai->agama == 'KRISTEN-KHATOLIK' ? 'selected' : '' }}>KRISTEN KHATOLIK
                                    </option>
                                    <option value="KRISTEN-PROTESTAN"
                                        {{ $pegawai->agama == 'KRISTEN-PROTESTAN' ? 'selected' : '' }}>KRISTEN PROTESTAN
                                    </option>
                                    <option value="BUDDHA" {{ $pegawai->agama == 'BUDDHA' ? 'selected' : '' }}>BUDDHA
                                    </option>
                                    <option value="HINDU" {{ $pegawai->agama == 'HINDU' ? 'selected' : '' }}>HINDU
                                    </option>
                                    <option value="KONGHUCU" {{ $pegawai->agama == 'KONGHUCU' ? 'selected' : '' }}>KONGHUCU
                                    </option>
                                </select>
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
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat', $pegawai->alamat) }}</textarea>
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
                                    placeholder="MASUKKAN NO TELEPON" value="{{ old('no_tlp', $pegawai->no_tlp) }}">
                                @error('no_tlp')
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
                                    <option value="1" {{ $pegawai->status == '1' ? 'selected' : '' }}>HONOR DINAS
                                    </option>
                                    <option value="0" {{ $pegawai->status == '0' ? 'selected' : '' }}>HONOR YAYASAN
                                    </option>
                                </select>
                                @error('status')
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
                                    class="form-control @error('foto') is-invalid @enderror">
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                                @if ($pegawai->foto)
                                    <div class="mt-2">
                                        <img src="{{ asset('storage/' . $pegawai->foto) }}" alt="Foto Pegawai"
                                            class="img-thumbnail" width="150px">
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-info">
                                    <div class="card-title">
                                        <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">
                                            HAK AKSES</h5>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group row">
                                        <label for="username" class="col-md-2 col-form-label">USERNAME</label>
                                        <div class="col-md-10">
                                            <input type="text" name="username"
                                                class="form-control @error('username') is-invalid @enderror"
                                                placeholder="MASUKKAN USERNAME"
                                                value="{{ old('username', $pegawai->user->username) }}" readonly>
                                            @error('username')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="password" class="col-md-2 col-form-label">PASSWORD</label>
                                        <div class="col-md-10">
                                            <input type="password" name="password"
                                                class="form-control @error('password') is-invalid @enderror"
                                                placeholder="MASUKKAN PASSWORD">
                                            @error('password')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <small' class="form-text text-muted">Biarkan kosong jika tidak ingin mengubah
                                                password</small>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="role" class="col-md-2 col-form-label">ROLE</label>
                                        <div class="col-md-10">
                                            <select name="role"
                                                class="form-control @error('role') is-invalid @enderror">
                                                <option value="">--- PILIH ROLE --- </option>
                                                <option value="1" {{ $pegawai->user->role == 1 ? 'selected' : '' }}>
                                                    ADMIN
                                                </option>
                                                <option value="2" {{ $pegawai->user->role == 2 ? 'selected' : '' }}>
                                                    GURU</option>
                                            </select>
                                            @error('role')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">BATAL</a>
                    </div>
                </div>
            </div>
        </div>
    </form>

@endsection
