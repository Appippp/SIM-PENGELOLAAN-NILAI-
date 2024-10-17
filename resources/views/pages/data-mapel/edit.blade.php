@extends('layouts.main')

@section('title', 'Edit Mata Pelajaran')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">EDIT DATA MATA PELAJARAN</h1>
    </div>

    <div class="row mb-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="card-title">
                        <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">FORM EDIT DATA MATA
                            PELAJARAN
                        </h5>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('mapel.update', $mapel->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="form-group row">
                            <label for="nama_mapel" class="col-md-2 col-form-label">MATA PELAJARAN</label>
                            <div class="col-md-10">
                                <input type="text" name="nama_mapel"
                                    class="form-control @error('nama_mapel') is-invalid @enderror"
                                    placeholder="MASUKKAN NAMA MATA PELAJARAN"
                                    value="{{ old('nama_mapel', $mapel->nama_mapel) }}">
                                @error('nama_mapel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="guru_id" class="col-md-2 col-form-label">GURU</label>
                            <div class="col-md-10">
                                <select name="pegawai_id"
                                    class="form-control select2 @error('pegawai_id') is-invalid @enderror">
                                    <option value="">--- PILIH GURU ---</option>
                                    @foreach ($pegawai as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $mapel->pegawai_id ? 'selected' : '' }}>
                                            {{ $item->nip }} - {{ $item->nama_lengkap }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pegawai_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="tahun_ajaran_id" class="col-md-2 col-form-label">TAHUN AJARAN</label>
                            <div class="col-md-10">
                                <select name="tahun_ajaran_id"
                                    class="form-control @error('tahun_ajaran_id') is-invalid @enderror">
                                    <option value="">--- PILIH TAHUN AJARAN ---</option>
                                    @foreach ($tahun_ajar as $tahunAjaran)
                                        <option value="{{ $tahunAjaran->id }}"
                                            {{ $tahunAjaran->id == $mapel->tahun_ajaran_id ? 'selected' : '' }}>
                                            {{ $tahunAjaran->tahun_ajaran }} - {{ $tahunAjaran->semester }}
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
                            <label for="wali_kelas_id" class="col-md-2 col-form-label">KELAS</label>
                            <div class="col-md-10">
                                <select name="wali_kelas_id"
                                    class="form-control select2 @error('wali_kelas_id') is-invalid @enderror">
                                    <option value="">--- PILIH KELAS ---</option>
                                    @foreach ($kelas as $item)
                                        <option value="{{ $item->id }}"
                                            {{ $item->id == $mapel->wali_kelas_id ? 'selected' : '' }}>
                                            {{ $item->kelas->nama_kelas }}
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
                            <label for="kkm" class="col-md-2 col-form-label">KKM</label>
                            <div class="col-md-10">
                                <input type="number" name="kkm" class="form-control @error('kkm') is-invalid @enderror"
                                    placeholder="MASUKKAN KKM" value="{{ old('kkm', $mapel->kkm) }}">
                                @error('kkm')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <a href="{{ route('mapel.index') }}" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left"></i> Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
    </script>

@endsection
