@extends('layouts.main')

@section('title', 'Data Wali Kelas')

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
                        <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">LIST DATA TAHUN
                            AJARAN
                        </h5>
                    </div>
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
                            @foreach ($tahun_ajaran as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->tahun_ajaran }}. {{ $item->semester }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('wali-kelas.show', $item->id) }}" class="btn btn-warning btn-sm"> <i class="fas fa-eye"></i>
                                            Show</a>
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
