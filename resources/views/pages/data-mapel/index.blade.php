@extends('layouts.main')

@section('title', 'Data Mapel')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">DATA MATA PELAJARAN</h1>
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
                        <h6 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">LIST DATA MATA
                            PELAJARAN</h6>
                    </div>
                    <a href="{{ route('mapel.create') }}" class="btn btn-dark btn-sm"> <i class="fas fa-plus"></i> TAMBAH
                        DATA</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>MATA PELAJARAN</th>
                                <th>GURU</th>
                                <th>TAHUN AJARAN</th>
                                <th>KELAS</th>
                                <th>KKM</th>
                                <th class="text-center" width="25%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mapel as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nama_mapel }}</td>
                                    <td><span
                                            class="badge badge-success p-2">{{ $item->pegawai->nama_lengkap . ' - ' . $item->pegawai->jabatan->nama_jabatan }}</span>
                                    </td>
                                    <td><span
                                            class="badge badge-info p-2">{{ $item->tahunAjaran->tahun_ajaran . ' - ' . $item->tahunAjaran->semester }}</span>
                                    </td>
                                    <td>{{ $item->wali_kelas->kelas->nama_kelas }}</td>
                                    <td>{{ $item->kkm }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('mapel.edit', $item->id) }}" class="btn btn-warning btn-sm"> <i
                                                class="fas fa-pencil-alt"></i> </a>
                                        <form id="deleteForm{{ $item->id }}"
                                            action="{{ route('mapel.destroy', $item->id) }}" method="POST"
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



@endsection
