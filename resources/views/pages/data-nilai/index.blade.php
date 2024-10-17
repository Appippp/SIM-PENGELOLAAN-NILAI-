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
                        <h6 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">LIST DATA KELAS</h6>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>KELAS</th>
                                <th class="text-center" width="25%">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($kelas as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->kelas->nama_kelas }}</td>

                                    <td class="text-center">
                                        <a href="{{ route('nilai.lihat', ['tahunAjaranId' => $tahunAjaranId, 'wali_kelas_id' => $item->id]) }}"
                                            class="btn btn-info btn-sm">
                                            <i class="fas fa-edit"></i> PILIH KELAS
                                        </a>


                                        <a class="btn btn-success btn-sm"
                                            href="{{ route('lihat.nilai', ['wali_kelas_id' => $item->id, 'tahun_ajaran_id' => $item->id]) }}">
                                            LIHAT NILAI
                                            </ac>
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
