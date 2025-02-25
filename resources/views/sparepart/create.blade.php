@extends('layouts.Main')

@section('content')
<div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
    data-sidebar-position="fixed" data-header-position="fixed">
    <div class="body-wrapper">
        <div class="container-fluid">
            <form action="{{route('sparepart.store')}}" method="POST">
                @csrf

                <!-- Jenis Mesin -->
                <div class="mb-3">
                    <label for="jenisMesin" class="form-label">Jenis Mesin</label>
                    <input type="text" class="form-control" id="jenisMesin" name="jenis_mesin" placeholder="Masukkan Jenis Mesin">
                </div>

                <!-- Tipe Mesin -->
                <div class="mb-3">
                    <label for="tipeMesin" class="form-label">Tipe Mesin</label>
                    <input type="text" class="form-control" id="tipeMesin" name="tipe_mesin" placeholder="Masukkan Tipe Mesin">
                </div>

                <!-- Nama Sparepart -->
                <div class="mb-3">
                    <label for="namaSparepart" class="form-label">Nama Sparepart</label>
                    <input type="text" class="form-control" id="namaSparepart" name="nama_sparepart" placeholder="Masukkan Nama Sparepart">
                </div>

                <!-- Jumlah Stok -->
                <div class="mb-3">
                    <label for="jumlahStok" class="form-label">Jumlah Stok</label>
                    <input type="number" class="form-control" id="jumlahStok" name="jumlah_stok" placeholder="Masukkan Jumlah Stok">
                </div>

                <!-- Sparepart Keluar -->
                <div class="mb-3">
                    <label for="sparepartKeluar" class="form-label">Sparepart Keluar</label>
                    <input type="number" class="form-control" id="sparepartKeluar" name="sparepart_keluar" placeholder="Masukkan Jumlah Sparepart Keluar">
                </div>

                <!-- Sparepart Masuk -->
                <div class="mb-3">
                    <label for="sparepartMasuk" class="form-label">Sparepart Masuk</label>
                    <input type="number" class="form-control" id="sparepartMasuk" name="sparepart_masuk" placeholder="Masukkan Jumlah Sparepart Masuk">
                </div>

                <!-- Sisa Stok -->
                <div class="mb-3">
                    <label for="sisaStok" class="form-label">Sisa Stok</label>
                    <input type="number" class="form-control" id="sisaStok" name="sisa_stok" placeholder="Masukkan Sisa Stok">
                </div>

                <!-- Harga per PCS -->
                <div class="mb-3">
                    <label for="hargaPerPcs" class="form-label">Harga per PCS</label>
                    <input type="text" class="form-control" id="hargaPerPcs" name="harga_per_pcs" placeholder="Masukkan Harga per PCS">
                </div>
                
                <!-- Bulan Transaksi -->
                <div class="mb-3">
                    <label for="bulanTransaksi" class="form-label">Bulan Transaksi</label>
                    <input type="month" class="form-control" id="bulanTransaksi" name="bulan_transaksi">
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
