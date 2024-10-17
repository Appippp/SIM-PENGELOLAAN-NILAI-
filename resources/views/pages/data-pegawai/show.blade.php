@extends('layouts.main')

@section('title', 'Profil Pegawai')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">PROFIL PEGAWAI</h1>
    </div>

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="card-title">
                        <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">FOTO PEGAWAI</h5>
                    </div>
                </div>
                <div class="card-body text-center">
                    @if ($pegawai->foto)
                        <img src="{{ asset('storage/foto-pegawai/' . $pegawai->foto) }}" alt="Foto Pegawai"
                            class="img-fluid rounded">
                    @else
                        <img src="{{ asset('image/default.png') }}" alt="Foto Pegawai" class="img-fluid rounded">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="card-title">
                        <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">DETAIL PEGAWAI</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>NUPTK</th>
                            <td>{{ $pegawai->nip }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $pegawai->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Jabatan</th>
                            <td>{{ $pegawai->jabatan->nama_jabatan }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $pegawai->jk }}</td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td>{{ $pegawai->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $pegawai->tgl_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>{{ $pegawai->agama }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $pegawai->alamat }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td>{{ $pegawai->no_tlp }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $pegawai->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('pegawai.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                        Kembali</a>
                    <a href="{{ route('pegawai.edit', $pegawai->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i>
                        Edit</a>
                </div>
            </div>
        </div>
    </div>

@endsection
