@extends('layouts.main')

@section('title', 'Data Detail Kelas')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">DATA KELAS</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info d-flex justify-content-between align-items-center">
                    <h5 class="text-white mt-3" style="font-family: Verdana, Geneva, Tahoma, sans-serif">LIST DATA DETAIL
                        KELAS</h5>
                    <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#addKelasModal">
                        <i class="fas fa-plus"></i> TAMBAH DATA
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>WALI KELAS</th>
                                <th>KELAS</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($wali_kelas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->pegawai->nama_lengkap }} - {{ $item->pegawai->jabatan->nama_jabatan }}
                                    </td>
                                    <td>{{ $item->kelas->nama_kelas }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editKelasModal{{ $item->id }}">
                                            <i class="fas fa-pencil-alt"></i>
                                        </button>
                                        <form id="deleteForm{{ $item->id }}"
                                            action="{{ route('wali-kelas.destroy', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete('{{ $item->id }}')">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Tambah Kelas -->
    <div class="modal fade" id="addKelasModal" tabindex="-1" role="dialog" aria-labelledby="addKelasModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addKelasModalLabel">TAMBAH DATA KELAS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('wali-kelas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group row">
                            <label for="pegawai_id" class="col-md-2 col-form-label">GURU</label>
                            <div class="col-md-10">
                                <select name="pegawai_id"
                                    class="form-control select2 @error('pegawai_id') is-invalid @enderror">
                                    <option value="">--- PILIH GURU ---</option>
                                    @foreach ($pegawai as $guru)
                                        <option value="{{ $guru->id }}"
                                            {{ old('pegawai_id') == $guru->id ? 'selected' : '' }}>
                                            {{ $guru->nama_lengkap }} - {{ $guru->jabatan->nama_jabatan }}
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
                            <label for="kelas_id" class="col-md-2 col-form-label">KELAS</label>
                            <div class="col-md-10">
                                <select name="kelas_id"
                                    class="form-control select2 @error('kelas_id') is-invalid @enderror">
                                    <option value="">--- PILIH KELAS ---</option>
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}"
                                            {{ old('kelas_id') == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <input type="hidden" name="tahun_ajaran_id" value="{{ $tahun_ajaran_id }}">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fas fa-times"></i>
                            Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit Kelas -->
    @foreach ($wali_kelas as $item)
        <div class="modal fade" id="editKelasModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editKelasModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editKelasModalLabel{{ $item->id }}">EDIT DATA KELAS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('wali-kelas.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="pegawai_id">WALI KELAS</label>
                                <select name="pegawai_id"
                                    class="form-control select2 @error('pegawai_id') is-invalid @enderror">
                                    @foreach ($pegawai as $guru)
                                        <option value="{{ $guru->id }}"
                                            {{ $item->pegawai_id == $guru->id ? 'selected' : '' }}>
                                            {{ $guru->nama_lengkap }} - {{ $guru->jabatan->nama_jabatan }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('pegawai_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="kelas_id">KELAS</label>
                                <select name="kelas_id"
                                    class="form-control select2 @error('kelas_id') is-invalid @enderror">
                                    @foreach ($kelas as $k)
                                        <option value="{{ $k->id }}"
                                            {{ $item->kelas_id == $k->id ? 'selected' : '' }}>
                                            {{ $k->nama_kelas }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('kelas_id')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <input type="hidden" name="tahun_ajaran_id" value="{{ $item->tahun_ajaran_id }}">
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                    class="fas fa-times"></i> Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
