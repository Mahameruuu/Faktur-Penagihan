@extends('layouts.Main')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="body-wrapper">
        <div class="container-fluid">
            <form action="{{ route('sparepart.store') }}" method="POST">
                @csrf
                
                <!-- Nomor Partlist -->
                <div class="mb-3">
                    <label for="nomorPartlist" class="form-label">Nomor Partlist</label>
                    <input type="text" class="form-control" id="nomorPartlist" name="no_partlist" placeholder="Masukkan Nomor Partlist" value="{{ old('no_partlist') }}" required>
                </div>

                <!-- Jenis Mesin -->
                <div class="mb-3">
                    <label for="jenisMesin" class="form-label">Jenis Mesin</label>
                    <input type="text" class="form-control" id="jenisMesin" name="jenis_mesin" placeholder="Masukkan Jenis Mesin" value="{{ old('jenis_mesin') }}" required>
                </div>

                <!-- Tipe Mesin -->
                <div class="mb-3">
                    <label for="tipeMesin" class="form-label">Tipe Mesin</label>
                    <input type="text" class="form-control" id="tipeMesin" name="tipe_mesin" placeholder="Masukkan Tipe Mesin" value="{{ old('tipe_mesin') }}" required>
                </div>

                <!-- Nama Sparepart -->
                <div class="mb-3">
                    <label for="namaSparepart" class="form-label">Nama Sparepart</label>
                    <input type="text" class="form-control" id="namaSparepart" name="nama_sparepart" placeholder="Masukkan Nama Sparepart" value="{{ old('nama_sparepart') }}" required>
                </div>

                <!-- Jumlah Stok -->
                <div class="mb-3">
                    <label for="jumlahStok" class="form-label">Jumlah Stok</label>
                    <input type="number" class="form-control" id="jumlahStok" name="jumlah_stok" placeholder="Masukkan Jumlah Stok" value="{{ old('jumlah_stok') }}" required>
                </div>

                <!-- Sparepart Keluar -->
                <div class="mb-3">
                    <label for="sparepartKeluar" class="form-label">Sparepart Keluar</label>
                    <input type="number" class="form-control" id="sparepartKeluar" name="sparepart_keluar" placeholder="Masukkan Jumlah Sparepart Keluar" value="{{ old('sparepart_keluar') }}" required>
                </div>

                <!-- Sparepart Masuk -->
                <div class="mb-3">
                    <label for="sparepartMasuk" class="form-label">Sparepart Masuk</label>
                    <input type="number" class="form-control" id="sparepartMasuk" name="sparepart_masuk" placeholder="Masukkan Jumlah Sparepart Masuk" value="{{ old('sparepart_masuk') }}" required>
                </div>

                <!-- Harga per PCS -->
                <div class="mb-3">
                    <label for="hargaPerPcs" class="form-label">Harga per PCS</label>
                    <input type="number" class="form-control" id="hargaPerPcs" name="harga_per_pcs" placeholder="Masukkan Harga per PCS" value="{{ old('harga_per_pcs') }}" required>
                </div>
                
                <!-- Bulan Transaksi -->
                <div class="mb-3">
                    <label for="bulanTransaksi" class="form-label">Bulan Transaksi</label>
                    <input type="month" class="form-control" id="bulanTransaksi" name="bulan_transaksi" value="{{ old('bulan_transaksi') }}" required>
                </div>

                <!-- Sisa Stok (Hidden) -->
                <input type="hidden" id="sisaStok" name="sisa_stok" value="{{ old('sisa_stok') }}">

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
            <div class="py-6 px-6 text-center">
                <p class="mb-0 fs-4">Design and Developed by <a href="https://adminmart.com/" target="_blank" class="pe-1 text-primary text-decoration-underline">AdminMart.com</a></p>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function hitungSisaStok() {
            let jumlahStok = parseInt(document.getElementById("jumlahStok").value) || 0;
            let sparepartMasuk = parseInt(document.getElementById("sparepartMasuk").value) || 0;
            let sparepartKeluar = parseInt(document.getElementById("sparepartKeluar").value) || 0;

            let sisaStok = jumlahStok + sparepartMasuk - sparepartKeluar;
            document.getElementById("sisaStok").value = sisaStok;
        }

        document.getElementById("jumlahStok").addEventListener("input", hitungSisaStok);
        document.getElementById("sparepartMasuk").addEventListener("input", hitungSisaStok);
        document.getElementById("sparepartKeluar").addEventListener("input", hitungSisaStok);
    });
</script>
@endsection
