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

      <!-- Tabel Sparepart -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Data Sparepart untuk Verifikasi</h5>
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                </div>
            @endif
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nomor Partlist</th>
                <th>Nama Sparepart</th>
                <th>Jumlah Masuk</th>
                <th>Jumlah Keluar</th>
                <th>Aksi</th>
                <th>Status</th>
              </tr>
            </thead>
            <tbody>
              @foreach($spareparts as $index => $sparepart)
                <tr>
                  <td>{{ $index + 1 }}</td>
                  <td>{{ $sparepart->no_partlist }}</td>
                  <td>{{ $sparepart->nama_sparepart }}</td>
                  <td>{{ $sparepart->sparepart_masuk }}</td>
                  <td>{{ $sparepart->sparepart_keluar }}</td>
                  <td>
                    <form action="{{ route('supervisor.verify', $sparepart->id) }}" method="POST" style="display:inline;">
                      @csrf
                      <button type="submit" class="btn btn-success btn-sm">Verifikasi</button>
                    </form>
                    <form action="{{ route('supervisor.reject', $sparepart->id) }}" method="POST" style="display:inline;">
                      @csrf
                      <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                    </form>
                  </td>
                  <td>
                    <span class="badge bg-info">{{ ucfirst($sparepart->status_verifikasi) }}</span>
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

<script>
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.style.transition = "opacity 0.5s ease";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        });
    }, 3000);
</script>