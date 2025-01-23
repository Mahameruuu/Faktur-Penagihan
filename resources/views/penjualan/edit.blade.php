@extends('layouts.Main')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
  data-sidebar-position="fixed" data-header-position="fixed">
  <div class="body-wrapper">
    <div class="container-fluid">
      <div class="mb-4">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.index') }}" class="text-primary">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Penjualan</li>
          </ol>
        </nav>
      </div>

      <!-- Form Edit Penjualan -->
      <form action="{{ route('penjualan.update', $penjualan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Nama Pelanggan -->
        <div class="mb-3">
            <label for="customerName" class="form-label">Nama Pelanggan</label>
            <select class="form-select" id="customerName" name="customer_name">
                <option selected>{{ old('customer_name', $penjualan->customer_name) }}</option>
                <option value="Pelanggan 1">Pelanggan 1</option>
                <option value="Pelanggan 2">Pelanggan 2</option>
                <option value="Pelanggan 3">Pelanggan 3</option>
            </select>
        </div>

        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $penjualan->email) }}">
        </div>

        <!-- Alamat Penagihan -->
        <div class="mb-3">
            <label for="billingAddress" class="form-label">Alamat Penagihan</label>
            <input type="text" class="form-control" id="billingAddress" name="billing_address" value="{{ old('billing_address', $penjualan->billing_address) }}">
        </div>

        <!-- Tanggal Transaksi -->
        <div class="mb-3">
            <label for="transactionDate" class="form-label">Tanggal Transaksi</label>
            <input type="date" class="form-control" id="transactionDate" name="transaction_date" value="{{ old('transaction_date', $penjualan->transaction_date) }}">
        </div>

        <!-- Tanggal Jatuh Tempo -->
        <div class="mb-3">
            <label for="dueDate" class="form-label">Tanggal Jatuh Tempo</label>
            <input type="date" class="form-control" id="dueDate" name="due_date" value="{{ old('due_date', $penjualan->due_date) }}">
        </div>

        <!-- No Transaksi -->
        <div class="mb-3">
            <label for="transactionNumber" class="form-label">No Transaksi</label>
            <input type="text" class="form-control" id="transactionNumber" name="transaction_number" value="{{ old('transaction_number', $penjualan->transaction_number) }}">
        </div>

        <!-- Produk -->
        <div class="mb-3">
            <label for="product" class="form-label">Produk</label>
            <select class="form-select" id="product" name="product">
                <option selected>{{ old('product', $penjualan->product) }}</option>
                <option value="1">Produk 1</option>
                <option value="2">Produk 2</option>
                <option value="3">Produk 3</option>
            </select>
        </div>

        <!-- Tag -->
        <div class="mb-3">
            <label for="tag" class="form-label">Tag</label>
            <input type="text" class="form-control" id="tag" name="tag" value="{{ old('tag', $penjualan->tag) }}">
        </div>

        <!-- Sub Total -->
        <div class="mb-3">
            <label for="subTotal" class="form-label">Sub Total (Diskon Per Baris)</label>
            <input type="number" class="form-control" id="subTotal" name="sub_total" value="{{ old('sub_total', $penjualan->sub_total) }}">
        </div>

        <!-- Pemotongan -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="deductions" name="deductions" {{ old('deductions', $penjualan->deductions) ? 'checked' : '' }}>
            <label class="form-check-label" for="deductions">Pemotongan</label>
        </div>

        <!-- Uang Muka -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="downPayment" name="down_payment" {{ old('down_payment', $penjualan->down_payment) ? 'checked' : '' }}>
            <label class="form-check-label" for="downPayment">Uang Muka</label>
        </div>

        <!-- Total Sisa Tagihan -->
        <div class="mb-3">
            <label for="remainingBalance" class="form-label">Total Sisa Tagihan</label>
            <input type="number" class="form-control" id="remainingBalance" name="remaining_balance" value="{{ old('remaining_balance', $penjualan->remaining_balance) }}">
        </div>

        <!-- Lampiran -->
        <div class="mb-3">
            <label for="attachment" class="form-label">Lampiran</label>
            <input type="file" class="form-control" id="attachment" name="attachment">
        </div>

        <button type="submit" class="btn btn-primary">Update Penjualan</button>
        <a href="{{ route('penjualan.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection
