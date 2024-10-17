@extends('layouts.main')

@section('title', 'Data Nilai')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">DATA NILAI KELAS {{ $kelas->nama_kelas }}</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header bg-info d-flex justify-content-between align-items-center">
                    <div class="card-title mt-3">
                        <h6 class="text-white">PILIH MATA PELAJARAN</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('nilai.cetakPDF', ['kelas_id' => $kelas->id]) }}" method="GET">
                        <input type="hidden" name="wali_kelas_id" value="{{ $kelas->id }}">
                        <div class="form-group">
                            <label for="mapel_id">MATA PELAJARAN</label>
                            <select name="mapel_id" id="mapel_id" class="form-control">
                                @foreach ($mapel as $item)
                                    <option value="{{ $item->id }}">{{ $item->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark btn-sm">
                            <i class="fas fa-print"></i> CETAK PDF
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Nilai Table -->
    <div class="row mb-3">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header bg-info d-flex justify-content-between align-items-center">
                    <div class="card-title mt-3">
                        <h6 class="text-white">LIST DATA NILAI</h6>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA SISWA</th>
                                <th>MATA PELAJARAN</th>
                                <th>TUGAS</th>
                                <th>UTS</th>
                                <th>UAS</th>
                                <th>NILAI AKHIR</th>
                                <th class="text-center" width="15%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($nilai as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->siswa->nama_lengkap }}</td>
                                    <td>{{ $item->mapel->nama_mapel }}</td>
                                    <td>{{ $item->tugas }}</td>
                                    <td>{{ $item->uts }}</td>
                                    <td>{{ $item->uas }}</td>
                                    <td>{{ number_format($item->nilai, 2) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('nilai.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i> EDIT
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Siswa yang Belum Mengisi Nilai -->
    <div class="row">
        <div class="col-md-12">
            <div class="card shadow mb-4">
                <div class="card-header bg-danger d-flex justify-content-between align-items-center">
                    <div class="card-title mt-3">
                        <h6 class="text-white">LIST DATA SISWA YANG BELUM DINPUTKAN</h6>
                    </div>
                </div>
                <div class="card-body">
                    @if ($siswaBelumMengisi->isEmpty())
                        <p>Tidak ada siswa yang belum mengisi nilai.</p>
                    @else
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>NAMA SISWA</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($siswaBelumMengisi as $siswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $siswa->nama_lengkap }}</td>
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
