<!DOCTYPE html>
<html>
<head>
    <title>Rekap Kuitansi</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Rekap Kuitansi Bulan {{ date('F Y', strtotime($bulan)) }}</h2>
    <table>
        <thead>
            <tr>
                <th>Jenis Mesin</th>
                <th>Tipe Mesin</th>
                <th>Nama Sparepart</th>
                <th>Jumlah Stok</th>
                <th>Sparepart Keluar</th>
                <th>Sparepart Masuk</th>
                <th>Sisa Stok</th>
                <th>Harga per PCS</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($spareparts as $sparepart)
            <tr>
                <td>{{ $sparepart->jenis_mesin }}</td>
                <td>{{ $sparepart->tipe_mesin }}</td>
                <td>{{ $sparepart->nama_sparepart }}</td>
                <td>{{ $sparepart->jumlah_stok }}</td>
                <td>{{ $sparepart->sparepart_keluar }}</td>
                <td>{{ $sparepart->sparepart_masuk }}</td>
                <td>{{ $sparepart->sisa_stok }}</td>
                <td>{{ number_format($sparepart->harga_per_pcs, 2, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
