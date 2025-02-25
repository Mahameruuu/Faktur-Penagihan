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
            'jenis_mesin' => 'required',
            'tipe_mesin' => 'required',
            'nama_sparepart' => 'required',
            'jumlah_stok' => 'required|integer',
            'sparepart_keluar' => 'required|integer',
            'sparepart_masuk' => 'required|integer',
            'sisa_stok' => 'required|integer',
            'harga_per_pcs' => 'required|numeric',
            'bulan_transaksi' => 'required|date_format:Y-m'
        ]);

        Sparepart::create($request->all());

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

    public function update(Request $request, Sparepart $sparepart)
    {
        $request->validate([
            'jenis_mesin' => 'required',
            'tipe_mesin' => 'required',
            'nama_sparepart' => 'required',
            'jumlah_stok' => 'required|integer',
            'sparepart_keluar' => 'required|integer',
            'sparepart_masuk' => 'required|integer',
            'sisa_stok' => 'required|integer',
            'harga_per_pcs' => 'required|numeric',
            'bulan_transaksi' => 'required|date_format:Y-m'
        ]);

        $sparepart->update($request->all());

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

