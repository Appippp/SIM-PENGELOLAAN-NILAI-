@extends('layouts.main')

@section('title', 'Data Jabatan')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">DATA JABATAN</h1>
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
                    <div class="card-title mt-3">
                        <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">LIST DATA JABATAN
                        </h5>
                    </div>
                    <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#addJabatanModal"> <i
                            class="fas fa-plus"></i> TAMBAH DATA
                    </button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA JABATAN</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($jabatan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_jabatan }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editJabatanModal{{ $item->id }}"> <i
                                                class="fas fa-pencil-alt"></i> <span
                                                style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"></span>
                                        </button>
                                        <form id="deleteForm{{ $item->id }}"
                                            action="{{ route('jabatan.destroy', $item->id) }}" method="POST"
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

    <!-- Modal Tambah Jabatan -->
    <div class="modal fade" id="addJabatanModal" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addDepartmentModalLabel">TAMBAH DATA JABATAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('jabatan.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_jabatan">NAMA JABATAN </label>
                            <input type="text" name="nama_jabatan"
                                class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan" required>
                            @error('nama_jabatan')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Simpan</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i class="fas fa-times"></i>
                            Tutup</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    @foreach ($jabatan as $item)
        <div class="modal fade" id="editJabatanModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDepartmentModalLabel">EDIT DATA JABATAN</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('jabatan.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="departmentName">NAMA JABATAN</label>
                                <input type="text" name="nama_jabatan"
                                    class="form-control @error('nama_jabatan') is-invalid @enderror" id="nama_jabatan"
                                    value="{{ $item->nama_jabatan }}" required>
                                @error('nama_jabatan')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i
                                    class="fas fa-times"></i>
                                Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
