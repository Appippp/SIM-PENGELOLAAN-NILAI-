@extends('layouts.main')

@section('title', 'Edit Nilai')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">EDIT NILAI</h1>
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
                        <h6 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">FORM EDIT NILAI</h6>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('nilai.update', $nilai->id) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="siswa">NAMA SISWA</label>
                            <input type="text" id="siswa" class="form-control" value="{{ $nilai->siswa->nama_lengkap }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="mapel">MATA PELAJARAN</label>
                            <input type="text" id="mapel" class="form-control" value="{{ $nilai->mapel->nama_mapel }}" readonly>
                        </div>

                        <div class="form-group">
                            <label for="tugas">TUGAS</label>
                            <input type="number" name="tugas" id="tugas" class="form-control" min="0" max="100" step="0.1" value="{{ $nilai->tugas }}" required>
                        </div>

                        <div class="form-group">
                            <label for="uts">UTS</label>
                            <input type="number" name="uts" id="uts" class="form-control" min="0" max="100" step="0.1" value="{{ $nilai->uts }}" required>
                        </div>

                        <div class="form-group">
                            <label for="uas">UAS</label>
                            <input type="number" name="uas" id="uas" class="form-control" min="0" max="100" step="0.1" value="{{ $nilai->uas }}" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Update Nilai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
