@extends('layouts.main')

@section('title', 'Data Nilai')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">DATA NILAI KELAS</h1>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <!-- Data Nilai Table -->
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-info d-flex justify-content-between align-items-center">
                    <div class="card-title mt-3">
                        <h6 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">LIST DATA NILAI
                            SUDAH DIINPUTKAN`</h6>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Mata Pelajaran yang Belum Diinputkan -->
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header bg-warning d-flex justify-content-between align-items-center">
                    <div class="card-title mt-3">
                        <h6 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">MATA PELAJARAN YANG
                            BELUM DIINPUTKAN</h6>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTableUnsubmitted" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>MATA PELAJARAN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($mapelBelumDiinputkan as $mapelItem)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $mapelItem->nama_mapel }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
