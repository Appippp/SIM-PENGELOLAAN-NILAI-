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

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info d-flex justify-content-between align-items-center">
                    <div class="card-title mt-3">
                        <h6 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">LIST DATA SISWA
                        </h6>
                    </div>
                    <a href="{{ route('siswa.create', ['tahunAjaranId' => $tahunAjaranId, 'kelasId' => $kelasId]) }}" class="btn btn-primary">Tambah Siswa</a>

                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NIS</th>
                                <th>NAMA LENGKAP</th>
                                <th class="text-center" width="25%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($siswa as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nis }}</td>
                                    <td>{{ $item->nama_lengkap }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('siswa.edit', $item->id) }}" class="btn btn-warning btn-sm"> <i
                                                class="fas fa-pencil-alt"></i> </a>
                                        <form id="deleteForm{{ $item->id }}"
                                            action="{{ route('siswa.destroy', $item->id) }}" method="POST"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="confirmDelete('{{ $item->id }}')"><i
                                                    class="fas fa-trash-alt"></i> </button>
                                        </form>
                                        <a href="{{ route('siswa.show', $item->id) }}" class="btn btn-info btn-sm"><i
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
