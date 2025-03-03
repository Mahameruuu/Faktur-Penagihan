<!DOCTYPE html>
<html>
<head>
    <title>Rekap Penjualan</title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            font-size: 12px;
            margin: 20px;
        }
        h2 {
            text-align: center;
        }
        table { 
            width: 100%; 
            border-collapse: collapse; 
            margin-top: 20px; 
            table-layout: fixed; /* Menghindari tabel melebar */
        }
        th, td { 
            border: 1px solid black; 
            padding: 8px; 
            text-align: left; 
            word-wrap: break-word; /* Mencegah teks panjang keluar */
        }
        th { 
            background-color: #f2f2f2; 
            text-align: center;
        }
        td {
            vertical-align: top;
        }
        .text-right {
            text-align: right;
        }
        .page-break {
            page-break-before: always;
        }
    </style>
</head>
<body>
    <h2>Rekap Penjualan Bulan {{ \Carbon\Carbon::createFromFormat('Y-m', $bulan)->translatedFormat('F Y') }}</h2>

    @if ($penjualans->isEmpty())
        <p style="text-align: center;">Tidak ada transaksi penjualan untuk bulan ini.</p>
    @else
        <table>
            <thead>
                <tr>
                    <th style="width: 5%;">No.</th>
                    <th style="width: 12%;">Tanggal Transaksi</th>
                    <th style="width: 15%;">Nama Customer</th>
                    <th style="width: 20%;">Alamat Customer</th>
                    <th style="width: 10%;">Nomor Kuitansi</th>
                    <th style="width: 10%;">Nama Bank</th>
                    <th style="width: 10%;" class="text-right">Uraian</th>
                    <th style="width: 10%;" class="text-right">Sisa Saldo (Rp)</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($penjualans as $index => $penjualan)
                <tr>
                    <td style="text-align: center;">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($penjualan->transaction_date)->format('d-m-Y') }}</td>
                    <td>{{ $penjualan->customer_name }}</td>
                    <td>{{ $penjualan->billing_address }}</td>
                    <td>{{ $penjualan->transaction_number }}</td>
                    <td>{{ $penjualan->bank_name }}</td>
                    <td class="text-right">{{ number_format($penjualan->sub_total, 2, ',', '.') }}</td>
                    <td class="text-right">{{ number_format($penjualan->remaining_balance, 2, ',', '.') }}</td>
                </tr>
                @if (($index + 1) % 20 == 0)
                    <tr class="page-break"></tr> <!-- Pecah halaman setiap 20 baris -->
                @endif
                @endforeach
            </tbody>
        </table>
    @endif
</body>
</html>
