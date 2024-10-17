<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Nilai Kelas {{ $kelas->nama_kelas }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .info-section {
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
        }

        .info-left,
        .info-right {
            width: 48%;
        }

        .info-left div,
        .info-right div {
            margin-bottom: 10px;
        }

        .info-section .label {
            font-weight: bold;
        }

        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        .data-table th,
        .data-table td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }

        .data-table th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Data Nilai Kelas {{ $kelas->nama_kelas }}</h1>
    </div>

    <!-- Info Section -->
    <div class="info-section">
        <!-- Left Side -->
        <div class="info-left">
            <div><span class="label">Nama Guru:</span> {{ $nilai->first()->mapel->pegawai->nama_lengkap }}</div>
            <div><span class="label">Mata Pelajaran:</span> {{ $nilai->first()->mapel->nama_mapel }}</div>
        </div>
        <!-- Right Side -->
        <div class="info-right">
            <div><span class="label">Tahun Ajaran:</span> {{ $nilai->first()->mapel->tahunAjaran->tahun_ajaran }}</div>
            <div><span class="label">Semester:</span> {{ $nilai->first()->mapel->tahunAjaran->semester }}</div>
        </div>
    </div>

    <!-- Data Table -->
    <table class="data-table">
        <thead>
            <tr>
                <th>NO</th>
                <th>NAMA SISWA</th>
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
                    <td>{{ $item->tugas }}</td>
                    <td>{{ $item->uts }}</td>
                    <td>{{ $item->uas }}</td>
                    <td>{{ number_format($item->nilai, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
