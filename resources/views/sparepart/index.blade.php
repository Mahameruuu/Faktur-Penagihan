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
            <li class="breadcrumb-item active" aria-current="page">Manajemen Sparepart</li>
          </ol>
        </nav>
      </div>

      <div class="mt-5 d-flex justify-content-between">
        <a href="{{ route('sparepart.create') }}" class="btn btn-success mb-3">
          Tambah Sparepart
        </a>

        <!-- Form Pilih Bulan -->
        <form action="{{ route('sparepart.rekap-kuitansi') }}" method="GET" class="d-flex">
          <input type="month" class="form-control me-2" id="bulan" name="bulan" required>
          <button type="submit" class="btn btn-info">Download Rekap Kuitansi</button>
        </form>
      </div>

      <!-- Tabel Sparepart -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Data Sparepart</h5>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Partlist</th>
                <th>Jenis Mesin</th>
                <th>Tipe Mesin</th>
                <th>Nama Sparepart</th>
                <th>Jumlah Stok</th>
                <th>Sparepart Keluar</th>
                <th>Sparepart Masuk</th>
                <th>Sisa Stok</th>
                <th>Harga per Pcs</th>
                <th>Bulan</th>
                <th>Status</th> <!-- Kolom Status -->
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($spareparts as $sparepart)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $sparepart->no_partlist }}</td>
                  <td>{{ $sparepart->jenis_mesin }}</td>
                  <td>{{ $sparepart->tipe_mesin }}</td>
                  <td>{{ $sparepart->nama_sparepart }}</td>
                  <td>{{ $sparepart->jumlah_stok }}</td>
                  <td>{{ $sparepart->sparepart_keluar }}</td>
                  <td>{{ $sparepart->sparepart_masuk }}</td>
                  <td>{{ $sparepart->sisa_stok }}</td>
                  <td>Rp {{ number_format($sparepart->harga_per_pcs, 0, ',', '.') }}</td>
                  <td>{{ $sparepart->bulan_transaksi }}</td>
                  <td>
                    @if ($sparepart->status_verifikasi == 'pending')
                      <span class="badge bg-warning">Menunggu Verifikasi</span>
                    @elseif ($sparepart->status_verifikasi == 'verified')
                      <span class="badge bg-success">Terverifikasi</span>
                    @else
                      <span class="badge bg-danger">Ditolak</span>
                    @endif
                  </td>
                  <td>
                    <a href="{{ route('sparepart.edit', $sparepart->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <!-- Form Hapus Langsung -->
                    <form action="{{ route('sparepart.destroy', $sparepart->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>

      <!-- Footer -->
      <div class="py-6 px-6 text-center">
        <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank"
            class="pe-1 text-primary text-decoration-underline">AdminMart.com</a></p>
      </div>
    </div>
  </div>
</div>
@endsection
