<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sparepart;

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
            'harga_per_pcs' => 'required|numeric'
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
            'harga_per_pcs' => 'required|numeric'
        ]);

        $sparepart->update($request->all());

        return redirect()->route('sparepart.index')->with('success', 'Sparepart berhasil diperbarui.');
    }

    public function destroy(Sparepart $sparepart)
    {
        $sparepart->delete();
        return redirect()->route('sparepart.index')->with('success', 'Sparepart berhasil dihapus.');
    }
}

