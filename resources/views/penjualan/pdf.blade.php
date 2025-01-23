<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Penjualan PDF</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .table {
            width: 100%;
            border-collapse: collapse;
        }
        .table th, .table td {
            padding: 8px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <h1>Detail Penjualan</h1>

    <table class="table">
        <tr>
            <th>Nama Pelanggan</th>
            <td>{{ $penjualan->customer_name }}</td>
        </tr>
        <tr>
            <th>Alamat Penagihan</th>
            <td>{{ $penjualan->billing_address }}</td>
        </tr>
        <tr>
            <th>No Transaksi</th>
            <td>{{ $penjualan->transaction_number }}</td>
        </tr>
        <tr>
            <th>Tanggal Transaksi</th>
            <td>{{ $penjualan->transaction_date }}</td>
        </tr>
        <tr>
            <th>Tanggal Kadaluarsa</th>
            <td>{{ $penjualan->due_date }}</td>
        </tr>
        <tr>
            <th>Sub Total</th>
            <td>{{ $penjualan->sub_total }}</td>
        </tr>
        <tr>
            <th>Sisa Saldo</th>
            <td>{{ $penjualan->remaining_balance }}</td>
        </tr>
    </table>
</body>
</html>
