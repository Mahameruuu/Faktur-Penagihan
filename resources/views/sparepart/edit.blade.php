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
            <li class="breadcrumb-item active" aria-current="page">Edit Sparepart</li>
          </ol>
        </nav>
      </div>

      <!-- Form Edit Sparepart -->
      <form action="{{ route('sparepart.update', $sparepart->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Jenis Mesin -->
        <div class="mb-3">
            <label for="jenisMesin" class="form-label">Jenis Mesin</label>
            <input type="text" class="form-control" id="jenisMesin" name="jenis_mesin" value="{{ old('jenis_mesin', $sparepart->jenis_mesin) }}">
        </div>

        <!-- Tipe Mesin -->
        <div class="mb-3">
            <label for="tipeMesin" class="form-label">Tipe Mesin</label>
            <input type="text" class="form-control" id="tipeMesin" name="tipe_mesin" value="{{ old('tipe_mesin', $sparepart->tipe_mesin) }}">
        </div>

        <!-- Nama Sparepart -->
        <div class="mb-3">
            <label for="namaSparepart" class="form-label">Nama Sparepart</label>
            <input type="text" class="form-control" id="namaSparepart" name="nama_sparepart" value="{{ old('nama_sparepart', $sparepart->nama_sparepart) }}">
        </div>

        <!-- Jumlah Stok -->
        <div class="mb-3">
            <label for="jumlahStok" class="form-label">Jumlah Stok</label>
            <input type="number" class="form-control" id="jumlahStok" name="jumlah_stok" value="{{ old('jumlah_stok', $sparepart->jumlah_stok) }}">
        </div>

        <!-- Sparepart Keluar -->
        <div class="mb-3">
            <label for="sparepartKeluar" class="form-label">Sparepart Keluar</label>
            <input type="number" class="form-control" id="sparepartKeluar" name="sparepart_keluar" value="{{ old('sparepart_keluar', $sparepart->sparepart_keluar) }}">
        </div>

        <!-- Sparepart Masuk -->
        <div class="mb-3">
            <label for="sparepartMasuk" class="form-label">Sparepart Masuk</label>
            <input type="number" class="form-control" id="sparepartMasuk" name="sparepart_masuk" value="{{ old('sparepart_masuk', $sparepart->sparepart_masuk) }}">
        </div>

        <!-- Sisa Stok -->
        <div class="mb-3">
            <label for="sisaStok" class="form-label">Sisa Stok</label>
            <input type="number" class="form-control" id="sisaStok" name="sisa_stok" value="{{ old('sisa_stok', $sparepart->sisa_stok) }}">
        </div>

        <!-- Harga per PCS -->
        <div class="mb-3">
            <label for="hargaPerPcs" class="form-label">Harga per PCS</label>
            <input type="number" step="0.01" class="form-control" id="hargaPerPcs" name="harga_per_pcs" value="{{ old('harga_per_pcs', $sparepart->harga_per_pcs) }}">
        </div>

        <button type="submit" class="btn btn-primary">Update Sparepart</button>
        <a href="{{ route('sparepart.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection
