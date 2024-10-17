@extends('layouts.main')

@section('title', 'Data Pegawai')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">DATA PEGAWAI</h1>
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
                        <h6 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">LIST DATA PEGAWAI
                        </h6>
                    </div>
                    <a href="{{ route('pegawai.create') }}" class="btn btn-dark btn-sm"> <i class="fas fa-plus"></i>
                        TAMBAH DATA</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA LENGKAP</th>
                                <th>JABATAN</th>
                                <th>STATUS</th>
                                <th class="text-center" width="25%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pegawai as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td> <span class="badge badge-warning p-2">{{ $item->jabatan->nama_jabatan }}</span>
                                    </td>
                                    <td>
                                        @if ($item->status == 1)
                                            <span class="badge badge-success p-2">HONOR DINAS</span>
                                        @else
                                            <span class="badge badge-info p-2">HONOR YAYASAN</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <a href="{{ route('pegawai.edit', $item->id) }}" class="btn btn-warning btn-sm"> <i
                                                class="fas fa-pencil-alt"></i> </a>
                                        <form id="deleteForm{{ $item->id }}"
                                            action="{{ route('pegawai.destroy', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete('{{ $item->id }}')"><i
                                                    class="fas fa-trash-alt"></i> </button>
                                        </form>
                                        <a href="{{ route('pegawai.show', $item->id) }}" class="btn btn-info btn-sm"><i
                                                class="fas fa-eye"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
