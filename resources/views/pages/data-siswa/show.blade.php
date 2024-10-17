@extends('layouts.main')

@section('title', 'Profil Siswa')

@section('content')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800 fw-bold">PROFIL SISWA</h1>
    </div>

    <div class="row mb-5">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="card-title">
                        <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">FOTO SISWA</h5>
                    </div>
                </div>
                <div class="card-body text-center">
                    @if ($siswa->foto)
                        <img src="{{ asset('storage/foto-siswa/' . $siswa->foto) }}" alt="Foto Siswa"
                            class="img-fluid rounded">
                    @else
                        <img src="{{ asset('image/defaultsmp.png') }}" alt="Foto Siswa" class="img-fluid rounded">
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-info">
                    <div class="card-title">
                        <h5 style="font-family: Verdana, Geneva, Tahoma, sans-serif" class="text-white">DETAIL SISWA</h5>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <tr>
                            <th>NIS</th>
                            <td>{{ $siswa->nis }}</td>
                        </tr>
                        <tr>
                            <th>Nama Lengkap</th>
                            <td>{{ $siswa->nama_lengkap }}</td>
                        </tr>
                        <tr>
                            <th>Jenis Kelamin</th>
                            <td>{{ $siswa->jk }}</td>
                        </tr>
                        <tr>
                            <th>Tempat Lahir</th>
                            <td>{{ $siswa->tempat_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Tanggal Lahir</th>
                            <td>{{ $siswa->tgl_lahir }}</td>
                        </tr>
                        <tr>
                            <th>Agama</th>
                            <td>{{ $siswa->agama }}</td>
                        </tr>
                        <tr>
                            <th>Alamat</th>
                            <td>{{ $siswa->alamat }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon</th>
                            <td>{{ $siswa->no_tlp }}</td>
                        </tr>
                        <tr>
                            <th>No Telepon Orang Tua</th>
                            <td>{{ $siswa->no_tlp_ortu }}</td>
                        </tr>
                        <tr>
                            <th>Status</th>
                            <td>{{ $siswa->status == 1 ? 'Aktif' : 'Tidak Aktif' }}</td>
                        </tr>
                        <tr>
                            <th>Kelas</th>
                            <td>{{ $siswa->wali_kelas->kelas->nama_kelas }}</td>
                        </tr>
                        <tr>
                            <th>Tahun Ajaran</th>
                            <td>{{ $siswa->tahunAjaran->tahun_ajaran }} - {{ $siswa->tahunAjaran->semester }}</td>
                        </tr>
                    </table>
                </div>
                <div class="card-footer">
                    <a href="{{ route('siswa.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i>
                        Kembali</a>
                    <a href="{{ route('siswa.edit', $siswa->id) }}" class="btn btn-primary"><i class="fas fa-edit"></i>
                        Edit</a>
                </div>
            </div>
        </div>
    </div>

@endsection
