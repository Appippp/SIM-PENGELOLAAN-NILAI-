@extends('layouts.main')

@section('title', 'Pegawai')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">DATA PEGAWAI</h1>
    </div>

    <form action="{{ route('pegawai.store') }}" method="POST" enctype="multipart/form-data">
        <div class="row mb-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header bg-info">
                        <div class="card-title">
                            <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">TAMBAH DATA
                                PEGAWAI
                            </h5>
                        </div>
                    </div>
                    <div class="card-body">
                        @csrf
                        <div class="form-group row">
                            <label for="nip" class="col-md-2 col-form-label">NUPTK</label>
                            <div class="col-md-10">
                                <input type="text" name="nip" class="form-control @error('nip') is-invalid @enderror"
                                    placeholder="MASUKKAN NUPTK" value="{{ old('nip') }}">
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
                                    placeholder="MASUKKAN NAMA LENGKAP" value="{{ old('nama_lengkap') }}">
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
                                    <option value="">--- PILIH JABATAN --- </option>
                                    @foreach ($jabatan as $item)
                                        <option value="{{ $item->id }}">{{ $item->nama_jabatan }}</option>
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
                                    class="text-danger">*</span> </label>
                            <div class="col-md-10">
                                <select name="jk" class="form-control @error('jk') is-invalid @enderror">
                                    <option value="">--- PILIH JENIS KELAMIN --- </option>
                                    <option value="Laki-laki">LAKI-LAKI</option>
                                    <option value="Perempuan">PEREMPUAN</option>
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
                                    placeholder="MASUKKAN TEMPAT LAHIR" value="{{ old('tempat_lahir') }}">
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
                                    value="{{ old('tgl_lahir') }}">
                                @error('tgl_lahir')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="agama" class="col-md-2 col-form-label">AGAMA <span class="text-danger">*</span>
                            </label>
                            <div class="col-md-10">
                                <select name="agama" class="form-control @error('agama') is-invalid @enderror">
                                    <option value="">--- PILIH AGAMA --- </option>
                                    <option value="ISLAM">ISLAM</option>
                                    <option value="KRISTEN-KHATOLIK">KRISTEN KHATOLIK</option>
                                    <option value="KRISTEN-PROTESTAN">KRISTEN PROTESTAN</option>
                                    <option value="BUDDHA">BUDDHA</option>
                                    <option value="HINDU">HINDU</option>
                                    <option value="KONGHUCU">KONGHUCU</option>
                                </select>
                                @error('agama')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="alamat" class="col-md-2 col-form-label">ALAMAT <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <textarea name="alamat" class="form-control @error('alamat') is-invalid @enderror">{{ old('alamat') }}</textarea>
                                @error('alamat')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="no_tlp" class="col-md-2 col-form-label">NO TELEPON <span class="text-danger">*</span></label>
                            <div class="col-md-10">
                                <input type="text" name="no_tlp"
                                    class="form-control @error('no_tlp') is-invalid @enderror"
                                    placeholder="MASUKKAN NO TELEPON" value="{{ old('no_tlp') }}">
                                @error('no_tlp')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="status" class="col-md-2 col-form-label">STATUS <span class="text-danger">*</span> </label>
                            <div class="col-md-10">
                                <select name="status" class="form-control @error('status') is-invalid @enderror">
                                    <option value="">--- PILIH STATUS --- </option>
                                    <option value="1">HONOR DINAS</option>
                                    <option value="0">HONOR YAYASAN</option>
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
                                    class="form-control @error('foto') is-invalid @enderror" accept="image/*">
                                @error('foto')
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

        <div class="row mb-3">
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
                        @csrf
                        <div class="form-group row">
                            <label for="nip" class="col-md-2 col-form-label">USERNAME</label>
                            <div class="col-md-10">
                                <input type="text" name="username"
                                    class="form-control @error('username') is-invalid @enderror"
                                    placeholder="MASUKKAN USERNAME" value="{{ old('username') }}">
                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="nama_lengkap" class="col-md-2 col-form-label">PASSWORD</label>
                            <div class="col-md-10">
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror" placeholder="********"
                                    value="{{ old('password') }}">
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="jabatan_id" class="col-md-2 col-form-label">ROLE</label>
                            <div class="col-md-10">
                                <select name="role" class="form-control @error('role') is-invalid @enderror">
                                    <option value="">--- PILIH HAK AKSES --- </option>
                                    <option value="1"> ADMIN </option>
                                    <option value="2"> GURU </option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">SIMPAN</button>
                        <a href="{{ route('pegawai.index') }}" class="btn btn-secondary">KEMBALI</a>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
