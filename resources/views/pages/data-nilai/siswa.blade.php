@extends('layouts.main')

@section('title', 'Data Siswa')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">DATA SISWA</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
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
                        <h6 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">LIST DATA SISWA</h6>
                    </div>

                </div>
                <div class="card-body">
                    @if ($siswa->isEmpty())
                        <p>Tidak ada data siswa untuk kelas ini.</p>
                    @else
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NIS</th>
                                    <th>Nama Siswa</th>
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
                                            <a href="{{ route('nilai.create', $item->id) }}" class="btn btn-primary btn-sm">
                                                <i class="fas fa-edit"></i> BERI NILAI
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
