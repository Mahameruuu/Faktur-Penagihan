    @extends('layouts.Main')

    @section('content')
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div class="body-wrapper">
        <div class="container-fluid">
            <form action="{{route('penjualan.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- Nama Pelanggan -->
    <div class="mb-3">
        <label for="customerName" class="form-label">Nama Pelanggan</label>
        <select class="form-select" id="customerName" name="customer_name"> <!-- Tambahkan 'name' -->
            <option selected>Pilih Pelanggan</option>
            <option value="Pelanggan 1">Pelanggan 1</option>
            <option value="Pelanggan 2">Pelanggan 2</option>
            <option value="Pelanggan 3">Pelanggan 3</option>
        </select>
    </div>

    <!-- Email -->
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp"> <!-- Tambahkan 'name' -->
        <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
    </div>

    <!-- Alamat Penagihan -->
    <div class="mb-3">
        <label for="billingAddress" class="form-label">Alamat Penagihan</label>
        <input type="text" class="form-control" id="billingAddress" name="billing_address" placeholder="Masukkan Alamat Penagihan"> <!-- Tambahkan 'name' -->
    </div>

    <!-- Tanggal Transaksi -->
    <div class="mb-3">
        <label for="transactionDate" class="form-label">Tanggal Transaksi</label>
        <input type="date" class="form-control" id="transactionDate" name="transaction_date"> <!-- Tambahkan 'name' -->
    </div>

    <!-- Tanggal Jatuh Tempo -->
    <div class="mb-3">
        <label for="dueDate" class="form-label">Tanggal Jatuh Tempo</label>
        <input type="date" class="form-control" id="dueDate" name="due_date"> <!-- Tambahkan 'name' -->
    </div>

    <!-- No Transaksi -->
    <div class="mb-3">
        <label for="transactionNumber" class="form-label">No Transaksi</label>
        <input type="text" class="form-control" id="transactionNumber" name="transaction_number" placeholder="Masukkan No Transaksi"> <!-- Tambahkan 'name' -->
    </div>

    <!-- No Referensi Pelanggan -->
    <div class="mb-3">
        <label for="customerReferenceNumber" class="form-label">No Referensi Pelanggan</label>
        <input type="text" class="form-control" id="customerReferenceNumber" name="customer_reference_number" placeholder="Masukkan No Referensi Pelanggan"> <!-- Tambahkan 'name' -->
    </div>

    <!-- Tag -->
    <div class="mb-3">
        <label for="tag" class="form-label">Tag</label>
        <input type="text" class="form-control" id="tag" name="tag" placeholder="Masukkan Tag"> <!-- Tambahkan 'name' -->
    </div>

    <!-- Syarat Pembayaran -->
    <div class="mb-3">
        <label for="paymentTerms" class="form-label">Syarat Pembayaran</label>
        <select class="form-select" id="paymentTerms" name="payment_terms"> <!-- Tambahkan 'name' -->
            <option selected>Pilih Syarat Pembayaran</option>
            <option value="1">Syarat 1</option>
            <option value="2">Syarat 2</option>
            <option value="3">Syarat 3</option>
        </select>
    </div>

    <!-- Gudang -->
    <div class="mb-3">
        <label for="warehouse" class="form-label">Gudang</label>
        <select class="form-select" id="warehouse" name="warehouse"> <!-- Tambahkan 'name' -->
            <option selected>Pilih Gudang</option>
            <option value="1">Gudang 1</option>
            <option value="2">Gudang 2</option>
            <option value="3">Gudang 3</option>
        </select>
    </div>

    <!-- Produk -->
    <div class="mb-3">
        <label for="product" class="form-label">Produk</label>
        <select class="form-select" id="product" name="product"> <!-- Tambahkan 'name' -->
            <option selected>Pilih Produk</option>
            <option value="1">Produk 1</option>
            <option value="2">Produk 2</option>
            <option value="3">Produk 3</option>
        </select>
    </div>

    <!-- Pesan -->
    <div class="mb-3">
        <label for="message" class="form-label">Pesan</label>
        <textarea class="form-control" id="message" name="message" rows="3" placeholder="Masukkan pesan"></textarea> <!-- Tambahkan 'name' -->
    </div>

    <!-- Memo -->
    <div class="mb-3">
        <label for="memo" class="form-label">Memo</label>
        <textarea class="form-control" id="memo" name="memo" rows="3" placeholder="Masukkan memo"></textarea> <!-- Tambahkan 'name' -->
    </div>

    <!-- Lampiran -->
    <div class="mb-3">
        <label for="attachment" class="form-label">Lampiran</label>
        <input type="file" class="form-control" id="attachment" name="attachment"> <!-- Tambahkan 'name' -->
    </div>

    <!-- Sub Total -->
    <div class="mb-3">
        <label for="subTotal" class="form-label">Sub Total (Diskon Per Baris)</label>
        <input type="number" class="form-control" id="subTotal" name="sub_total" placeholder="Masukkan Sub Total"> <!-- Tambahkan 'name' -->
    </div>

    <!-- Pemotongan -->
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="deductions" name="deductions"> <!-- Tambahkan 'name' -->
        <label class="form-check-label" for="deductions">Pemotongan</label>
    </div>

    <!-- Uang Muka -->
    <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" id="downPayment" name="down_payment"> <!-- Tambahkan 'name' -->
        <label class="form-check-label" for="downPayment">Uang Muka</label>
    </div>

    <!-- Total Sisa Tagihan -->
    <div class="mb-3">
        <label for="remainingBalance" class="form-label">Total Sisa Tagihan</label>
        <input type="number" class="form-control" id="remainingBalance" name="remaining_balance" placeholder="Masukkan Total Sisa Tagihan"> <!-- Tambahkan 'name' -->
    </div>


                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div class="py-6 px-6 text-center">
            <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a></p>
            </div>
        </div>
        </div>
    </div>
    @endsection