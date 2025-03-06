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
      <form action="{{ route('sparepart.update', $sparepart->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nomor Partlist</label>
            <input type="text" class="form-control" name="no_partlist" value="{{ old('no_partlist', $sparepart->no_partlist) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jenis Mesin</label>
            <input type="text" class="form-control" name="jenis_mesin" value="{{ old('jenis_mesin', $sparepart->jenis_mesin) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipe Mesin</label>
            <input type="text" class="form-control" name="tipe_mesin" value="{{ old('tipe_mesin', $sparepart->tipe_mesin) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nama Sparepart</label>
            <input type="text" class="form-control" name="nama_sparepart" value="{{ old('nama_sparepart', $sparepart->nama_sparepart) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Jumlah Stok</label>
            <input type="number" class="form-control" name="jumlah_stok" value="{{ old('jumlah_stok', $sparepart->jumlah_stok) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sparepart Keluar</label>
            <input type="number" class="form-control" name="sparepart_keluar" value="{{ old('sparepart_keluar', $sparepart->sparepart_keluar) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sparepart Masuk</label>
            <input type="number" class="form-control" name="sparepart_masuk" value="{{ old('sparepart_masuk', $sparepart->sparepart_masuk) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Sisa Stok (Otomatis)</label>
            <input type="number" class="form-control" name="sisa_stok" value="{{ $sparepart->jumlah_stok + $sparepart->sparepart_masuk - $sparepart->sparepart_keluar }}" readonly>
        </div>

        <div class="mb-3">
            <label class="form-label">Harga per PCS</label>
            <input type="number" class="form-control" name="harga_per_pcs" value="{{ old('harga_per_pcs', $sparepart->harga_per_pcs) }}" step="0.01" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Bulan Transaksi</label>
            <input type="month" class="form-control" name="bulan_transaksi" value="{{ old('bulan_transaksi', $sparepart->bulan_transaksi) }}" required>
        </div>

        <!-- Menyimpan status_verifikasi agar tetap dikirim ke server -->
        <input type="hidden" name="status_verifikasi" value="{{ $sparepart->status_verifikasi }}">

        <div class="mb-3">
            <label class="form-label">Status Verifikasi</label>
            <select class="form-control" disabled>
                <option value="pending" {{ $sparepart->status_verifikasi == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="approved" {{ $sparepart->status_verifikasi == 'approved' ? 'selected' : '' }}>Approved</option>
                <option value="rejected" {{ $sparepart->status_verifikasi == 'rejected' ? 'selected' : '' }}>Rejected</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Sparepart</button>
        <a href="{{ route('sparepart.index') }}" class="btn btn-secondary">Batal</a>
      </form>
    </div>
  </div>
</div>
@endsection
