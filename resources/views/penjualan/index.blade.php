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
            <li class="breadcrumb-item active" aria-current="page">Penjualan</li>
          </ol>
        </nav>
      </div>

      <div class="mt-5">
        <a href="{{ route('penjualan.create') }}" class="btn btn-success mb-3">
          Tambah Penjualan
        </a>
      </div>

      <!-- Filter berdasarkan tanggal -->
      <form action="{{ route('penjualan.index') }}" method="GET" class="mb-4">
        <div class="row">
          <div class="col-md-3">
            <label for="start_date" class="form-label">Tanggal Mulai</label>
            <input type="date" class="form-control" name="start_date" id="start_date" value="{{ request('start_date') }}">
          </div>
          <div class="col-md-3">
            <label for="end_date" class="form-label">Tanggal Akhir</label>
            <input type="date" class="form-control" name="end_date" id="end_date" value="{{ request('end_date') }}">
          </div>
          <div class="col-md-2">
            <label>&nbsp;</label><br>
            <button type="submit" class="btn btn-primary mt-2">Filter</button>
          </div>
        </div>
      </form>

      <!-- Tabel Penjualan -->
      <div class="card">
        <div class="card-body">
          <h5 class="card-title fw-semibold mb-4">Data Penjualan</h5>
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Alamat Penagihan</th>
                <th>No Transaksi</th>
                <th>Tanggal Transaksi</th>
                <th>Tanggal Kadaluarsa</th> 
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              @foreach($penjualans as $penjualan)
                <tr>
                  <td>{{ $loop->iteration }}</td>
                  <td>{{ $penjualan->customer_name }}</td>
                  <td>{{ $penjualan->billing_address }}</td>
                  <td>{{ $penjualan->transaction_number }}</td>
                  <td>{{ $penjualan->transaction_date }}</td>
                  <td>{{ $penjualan->due_date }}</td> 
                  <td>
                    <a href="{{ route('penjualan.edit', $penjualan->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('penjualan.destroy', $penjualan->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                    <a href="{{ route('penjualan.downloadPDF', $penjualan->id) }}" class="btn btn-info btn-sm">Unduh PDF</a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
      
      <!-- Modal Konfirmasi Hapus -->
      <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Apakah Anda yakin ingin menghapus data penjualan ini?
            </div>
            <div class="modal-footer">
              <form id="deleteForm" action="" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm btn-delete">Hapus</button>
              </form>
              <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
            </div>
          </div>
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

<script>
  // Tangani klik tombol hapus
  const deleteButtons = document.querySelectorAll('.btn-danger');
  
  deleteButtons.forEach(button => {
    button.addEventListener('click', function(event) {
      event.preventDefault(); // Menghindari pengiriman form langsung

      // Ambil form yang terkait dengan tombol ini
      const form = this.closest('form');

      // Atur action URL form menjadi URL form hapus yang sesuai
      const deleteForm = document.getElementById('deleteForm');
      deleteForm.action = form.action;

      // Tampilkan modal
      $('#deleteModal').modal('show');
    });
  });
</script>


@endsection
