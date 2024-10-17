@extends('layouts.main')

@section('title', 'Data Tahun Ajaran')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">DATA TAHUN AJARAN</h1>
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
                        <h6 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">LIST DATA TAHUN
                            AJARAN</h6>
                    </div>
                    <button class="btn btn-dark btn-sm" data-toggle="modal" data-target="#addTahunAjaranModal"> <i
                            class="fas fa-plus"></i> TAMBAH DATA</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>TAHUN AJARAN</th>
                                <th>SEMESTER</th>
                                <th class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tahunAjaran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tahun_ajaran }}</td>
                                    <td>{{ $item->semester }}</td>
                                    <td class="text-center">
                                        <button class="btn btn-warning btn-sm" data-toggle="modal"
                                            data-target="#editTahunAjaranModal{{ $item->id }}"> <i
                                                class="fas fa-pencil-alt"></i> </button>
                                        <form id="deleteForm{{ $item->id }}"
                                            action="{{ route('tahun-ajaran.destroy', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete('{{ $item->id }}')"><i
                                                    class="fas fa-trash-alt"></i> </button>
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

    <!-- Modal Tambah Tahun Ajaran -->
    <div class="modal fade" id="addTahunAjaranModal" tabindex="-1" role="dialog"
        aria-labelledby="addTahunAjaranModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addTahunAjaranModalLabel">TAMBAH DATA TAHUN AJARAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('tahun-ajaran.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="tahun_ajaran">TAHUN AJARAN</label>
                            <input type="text" name="tahun_ajaran"
                                class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran" required>
                            @error('tahun_ajaran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="semester">SEMESTER</label>
                            <select type="text" name="semester"
                                class="form-control @error('semester') is-invalid @enderror" id="semester" required>
                                <option value="">--- PILIH SEMESTER --- </option>
                                <option value="GANJIL">GANJIL</option>
                                <option value="GENAP">GENAP</option>
                            </select>
                            @error('semester')
                                <div class="invalid-feedback">{{ $message }}</div>
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

    @foreach ($tahunAjaran as $item)
        <div class="modal fade" id="editTahunAjaranModal{{ $item->id }}" tabindex="-1" role="dialog"
            aria-labelledby="editTahunAjaranModalLabel{{ $item->id }}" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTahunAjaranModalLabel{{ $item->id }}">EDIT DATA TAHUN AJARAN
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form action="{{ route('tahun-ajaran.update', $item->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="tahun_ajaran">TAHUN AJARAN</label>
                                <input type="text" name="tahun_ajaran"
                                    class="form-control @error('tahun_ajaran') is-invalid @enderror" id="tahun_ajaran"
                                    value="{{ $item->tahun_ajaran }}" required>
                                @error('tahun_ajaran')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="semester">SEMESTER</label>
                                <select name="semester" class="form-control @error('semester') is-invalid @enderror"
                                    id="semester" required>
                                    <option value="">--- PILIH SEMESTER ---</option>
                                    <option value="GANJIL" {{ $item->semester == 'GANJIL' ? 'selected' : '' }}>GANJIL
                                    </option>
                                    <option value="GENAP" {{ $item->semester == 'GENAP' ? 'selected' : '' }}>GENAP
                                    </option>
                                </select>
                                @error('semester')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary"> <i class="fas fa-save"></i> Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"> <i
                                    class="fas fa-times"></i> Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    @endforeach

@endsection
