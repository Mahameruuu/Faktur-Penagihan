<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;
use Barryvdh\DomPDF\Facade\Pdf;

class SparepartController extends Controller
{
    public function index()
    {
        $spareparts = Sparepart::all();
        return view('sparepart.index', compact('spareparts'));
    }

    public function create()
    {
        return view('sparepart.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_partlist' => 'required|unique:spareparts',
            'jenis_mesin' => 'required',
            'tipe_mesin' => 'required',
            'nama_sparepart' => 'required',
            'jumlah_stok' => 'required|integer',
            'sparepart_keluar' => 'required|integer',
            'sparepart_masuk' => 'required|integer',
            'harga_per_pcs' => 'required|numeric',
            'bulan_transaksi' => 'required|date_format:Y-m'
        ]);

        // Hitung sisa stok otomatis
        $sisa_stok = $request->jumlah_stok + $request->sparepart_masuk - $request->sparepart_keluar;

        Sparepart::create([
            'no_partlist' => $request->no_partlist,
            'jenis_mesin' => $request->jenis_mesin,
            'tipe_mesin' => $request->tipe_mesin,
            'nama_sparepart' => $request->nama_sparepart,
            'jumlah_stok' => $request->jumlah_stok,
            'sparepart_keluar' => $request->sparepart_keluar,
            'sparepart_masuk' => $request->sparepart_masuk,
            'sisa_stok' => $sisa_stok, 
            'harga_per_pcs' => $request->harga_per_pcs,
            'bulan_transaksi' => $request->bulan_transaksi,
            'status_verifikasi' => 'pending',
        ]);
    
        return redirect()->route('sparepart.index')->with('success', 'Sparepart berhasil ditambahkan.');
    }

    public function show(Sparepart $sparepart)
    {
        return view('sparepart.show', compact('sparepart'));
    }

    public function edit(Sparepart $sparepart)
    {
        return view('sparepart.edit', compact('sparepart'));
    }

    public function update(Request $request, $id)
{
    $sparepart = Sparepart::findOrFail($id);

    // Cek jika status sudah "approved" atau "rejected", maka tidak bisa diupdate
    if (in_array($sparepart->status_verifikasi, ['approved', 'rejected'])) {
        return redirect()->route('sparepart.index')->with('error', 'Data tidak dapat diperbarui karena sudah diverifikasi.');
    }

    // Validasi data yang diperbolehkan untuk diupdate
    $request->validate([
        'no_partlist' => 'required|string',
        'jenis_mesin' => 'required|string',
        'tipe_mesin' => 'required|string',
        'nama_sparepart' => 'required|string',
        'jumlah_stok' => 'required|integer',
        'sparepart_keluar' => 'required|integer',
        'sparepart_masuk' => 'required|integer',
        'harga_per_pcs' => 'required|numeric',
        'bulan_transaksi' => 'required|date_format:Y-m',
    ]);

    // Update data sparepart
    $sparepart->update($request->except('status_verifikasi')); // Status tidak boleh diubah

    return redirect()->route('sparepart.index')->with('success', 'Sparepart berhasil diperbarui.');
}



    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();
        return redirect()->route('sparepart.index')->with('success', 'Sparepart berhasil dihapus.');
    }

    public function rekapKuitansi(Request $request)
    {
        $bulan = $request->input('bulan', date('Y-m'));
        $spareparts = Sparepart::where('bulan_transaksi', $bulan)->get();
        
        if ($spareparts->isEmpty()) {
            return dd("Data kosong untuk bulan " . $bulan);
        }

        $pdf = Pdf::loadView('sparepart.rekap-kuitansi', compact('spareparts', 'bulan'));
        return $pdf->download('rekap-kuitansi_' . $bulan . '.pdf');
    }
}
