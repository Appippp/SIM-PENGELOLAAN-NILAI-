@extends('layouts.main')

@section('title', 'Beri Nilai')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">BERI NILAI</h1>
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
            <div class="card shadow mb-4">
                <div class="card-header bg-info d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-white">FORM PENILAIAN</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('nilai.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="siswa_id" value="{{ $siswa->id }}">
                        <input type="hidden" name="wali_kelas_id" value="{{ $siswa->wali_kelas_id }}">
                        <input type="hidden" name="tahun_ajaran_id" value="{{ $siswa->tahun_ajaran_id }}">

                        <div class="form-group">
                            <label for="mapel">NAMA MATA PELAJARAN</label>
                            <select id="mapel" name="mapel_id" class="form-control" required>
                                <option value="">--- PILIH MAPEL ---</option>
                                @foreach ($mapel as $m)
                                    <option value="{{ $m->id }}">{{ $m->nama_mapel }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="guru">NAMA GURU</label>
                            <input type="text" id="guru" class="form-control" value="{{ $pegawai->nama_lengkap }}"
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="tugas">TUGAS</label>
                            <input type="number" name="tugas" id="tugas" class="form-control" min="1"
                                max="100" step="0.1" required>
                        </div>

                        <div class="form-group">
                            <label for="uts">UTS</label>
                            <input type="number" name="uts" id="uts" class="form-control" min="1"
                                max="100" step="0.1" required>
                        </div>

                        <div class="form-group">
                            <label for="uas">UAS</label>
                            <input type="number" name="uas" id="uas" class="form-control" min="1"
                                max="100" step="0.1" required>
                        </div>

                        <button type="submit" class="btn btn-success btn-block">Simpan Nilai</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
