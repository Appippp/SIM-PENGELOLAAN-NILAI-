@extends('layouts.main')

@section('title', 'Data Kelas')

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
                    <div class="card-title mt-3">
                        <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">LIST DATA KELAS
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
                                <th>NAMA KELAS</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_kelas }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editJabatanModal{{ $item->id }}"> <i
                                                class="fas fa-pencil-alt"></i> <span
                                                style="font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif"></span>
                                        </button>
                                        <form id="deleteForm{{ $item->id }}"
                                            action="{{ route('kelas.destroy', $item->id) }}" method="POST"
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
                    <h5 class="modal-title" id="addDepartmentModalLabel">TAMBAH DATA KELAS</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('kelas.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="nama_kelas">NAMA KELAS </label>
                            <input type="text" name="nama_kelas"
                                class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas" required>
                            @error('nama_kelas')
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


    @foreach ($kelas as $item)
        <div class="modal fade" id="editJabatanModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="addDepartmentModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDepartmentModalLabel">EDIT DATA KELAS</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('kelas.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="departmentName">NAMA KELAS</label>
                                <input type="text" name="nama_kelas"
                                    class="form-control @error('nama_kelas') is-invalid @enderror" id="nama_kelas"
                                    value="{{ $item->nama_kelas }}" required>
                                @error('nama_kelas')
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
