<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use setasign\Fpdi\Fpdi; 
use Storage;


class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');
    
        $query = Penjualan::query();
    
        if ($start_date) {
            $query->where('transaction_date', '>=', $start_date);
        }
    
        if ($end_date) {
            $query->where('transaction_date', '<=', $end_date);
        }
    
        if ($start_date && $end_date) {
            $query->whereBetween('due_date', [$start_date, $end_date]);
        }
    
        $penjualans = $query->get();
    
        return view('penjualan.index', compact('penjualans'));
    }
    

    public function create()
    {
        return view('penjualan.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'billing_address' => 'required|string|max:500',
            'transaction_date' => 'required|date',
            'due_date' => 'nullable|date',
            'transaction_number' => 'required|unique:penjualans,transaction_number',
            'customer_reference_number' => 'nullable|string|max:255',
            'tag' => 'nullable|string|max:255',
            'payment_terms' => 'nullable|string|max:255',
            'warehouse' => 'nullable|string|max:255',
            'product' => 'nullable|string|max:255',
            'message' => 'nullable|string',
            'memo' => 'nullable|string',
            'attachment' => 'nullable|file|max:2048',
            'sub_total' => 'required|numeric',
            'remaining_balance' => 'nullable|numeric',
        ]);

        // Proses upload file jika ada
        if ($request->hasFile('attachment')) {
            $path = $request->file('attachment')->store('attachments', 'public');
            $validated['attachment'] = $path; 
        }

        // Menyimpan data penjualan
        try {
            Penjualan::create($validated);
            return redirect()->route('penjualan.index')->with([
                'status' => 'success', 
                'message' => 'Penjualan berhasil ditambahkan!'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('penjualan.index')->with([
                'status' => 'error', 
                'message' => 'Penjualan gagal ditambahkan! Error: ' . $e->getMessage()
            ]);
        }
    }

    public function edit($id)
    {
        $penjualan = Penjualan::findOrFail($id);
        return view('penjualan.edit', compact('penjualan'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'email' => 'required|email',
            'billing_address' => 'required|string|max:500',
            'transaction_date' => 'required|date',
            'due_date' => 'nullable|date',
            'transaction_number' => 'required|unique:penjualans,transaction_number,' . $id,
            'product' => 'nullable|string|max:255',
            'sub_total' => 'required|numeric',
            'remaining_balance' => 'nullable|numeric',
            'attachment' => 'nullable|file|max:2048',
        ]);

        $penjualan = Penjualan::findOrFail($id);
        if ($request->hasFile('attachment')) {
            if ($penjualan->attachment) {
                Storage::delete('public/' . $penjualan->attachment);
            }

            $path = $request->file('attachment')->store('attachments', 'public');
            $validated['attachment'] = $path;
        }

        try {
            $penjualan->update($validated);

            return redirect()->route('penjualan.index')->with([
                'status' => 'success',
                'message' => 'Penjualan berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('penjualan.index')->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat memperbarui penjualan. Error: ' . $e->getMessage()
            ]);
        }
    }

    public function destroy($id)
    {
        $penjualan = Penjualan::find($id);

        if (!$penjualan) {
            return redirect()->route('penjualan.index')->with([
                'status' => 'error',
                'message' => 'Penjualan tidak ditemukan.'
            ]);
        }

        try {
            $penjualan->delete();

            return redirect()->route('penjualan.index')->with([
                'status' => 'success', 
                'message' => 'Penjualan berhasil dihapus.'
            ]);
        } catch (\Exception $e) {
            return redirect()->route('penjualan.index')->with([
                'status' => 'error',
                'message' => 'Terjadi kesalahan saat menghapus penjualan. Error: ' . $e->getMessage()
            ]);
        }
    }
    public function downloadPDF($id)
    {
        $penjualan = Penjualan::findOrFail($id);

        $pdf = new \FPDF();

        // Tambah halaman
        $pdf->AddPage();

        // Set margin
        $pdf->SetMargins(10, 10, 10);

        // Set font
        $pdf->SetFont('Arial', 'B', 14);

        // Header
        $pdf->Cell(0, 10, 'CV. JUAN MANGUN JAYA', 0, 1, 'C');
        $pdf->Ln(5);

        $pdf->SetFont('Arial', '', 12);
        
        // Menampilkan informasi penjualan di sebelah kanan
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetX(120); 
        $pdf->Cell(0, 8, 'Faktur #: ' . $penjualan->transaction_number, 0, 1, 'R');
        $pdf->SetX(120); 
        $pdf->Cell(0, 8, 'Tanggal: ' . $penjualan->transaction_date, 0, 1, 'R');        
        $pdf->SetX(120);
        $pdf->Cell(0, 8, 'Referensi Pelanggan: ' . ($penjualan->customer_reference ?? '-'), 0, 1, 'R');        
        $pdf->Ln(10);

        // Menampilkan alamat penagihan di kiri
        $pdf->SetFillColor(0, 0, 139);
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(50, 8, 'ALAMAT PENAGIHAN', 0, 1, 'L', true);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Cell(0, 8, 'PT. USAHA GARDA ARTA', 0, 1, 'L');
        $pdf->Cell(0, 8, 'WISMA STACO LANTAI 2, JL. CASABLANCA KAV. 18', 0, 1, 'L');
        $pdf->Cell(0, 8, 'TEBET - JAKARTA SELATAN', 0, 1, 'L');
        $pdf->Ln(10);
        

        // Header tabel dengan latar belakang biru dan teks putih
        $pdf->SetFont('Arial', 'B', 10);

        // Set warna latar belakang biru
        $pdf->SetFillColor(0, 0, 139); 
        $pdf->SetTextColor(255, 255, 255);
        
        // Menampilkan header tabel
        $pdf->Cell(10, 8, 'TAGS', 1, 0, 'C', true); 
        $pdf->Cell(80, 8, 'CARA PENGIRIMAN', 1, 0, 'C', true); 
        $pdf->Cell(30, 8, 'TERMS', 1, 0, 'C', true); 
        $pdf->Cell(30, 8, 'JATUH TEMPO', 1, 0, 'C', true); 
        $pdf->Cell(40, 8, 'TGL PENGIRIMAN', 1, 1, 'C', true); 
        
        $pdf->SetTextColor(0, 0, 0); 
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 8, $penjualan->tag ?? '-', 1, 0, 'C'); 
        $pdf->Cell(80, 8, $penjualan->shipping_method ?? '-', 1, 0, 'L'); 
        $pdf->Cell(30, 8, $penjualan->payment_terms ?? '-', 1, 0, 'C'); 
        $pdf->Cell(30, 8, $penjualan->due_date ?? '-', 1, 0, 'C');
        $pdf->Cell(40, 8, $penjualan->shipping_date ?? '-', 1, 1, 'C'); 
        $pdf->Ln(5);
        
        // Tabel Barang
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(10, 8, 'QTY', 1, 0, 'C', true);
        $pdf->Cell(80, 8, 'KETERANGAN', 1, 0, 'C', true);
        $pdf->Cell(30, 8, 'HARGA SATUAN', 1, 0, 'C', true);
        $pdf->Cell(30, 8, 'JUMLAH', 1, 1, 'C', true);
        
        $pdf->SetTextColor(0, 0, 0);
        
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(10, 8, '1', 1, 0, 'C');
        $pdf->Cell(80, 8, $penjualan->message, 1, 0);
        $pdf->Cell(30, 8, number_format($penjualan->sub_total, 2), 1, 0, 'R');
        $pdf->Cell(30, 8, number_format($penjualan->sub_total, 2), 1, 1, 'R');
        $pdf->Ln(5);

        // Footer
        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, 'BANK', 0, 1);
        $pdf->Cell(0, 8, 'NAMA BANK: BANK BRI', 0, 1);
        $pdf->Cell(0, 8, 'CABANG BANK: GATOT SUBROTO', 0, 1);
        $pdf->Cell(0, 8, 'NOMOR AKUN: 0404 01 001496 305', 0, 1);
        $pdf->Cell(0, 8, 'ATAS NAMA: CV. JUAN MANGUN JAYA', 0, 1);
        $pdf->Ln(5);

        // Subtotal dan Total
        $pdf->Cell(160, 8, 'Subtotal', 0, 0, 'R');
        $pdf->Cell(30, 8, number_format($penjualan->sub_total, 2), 0, 1, 'R');
        $pdf->Cell(160, 8, 'Total', 0, 0, 'R');
        $pdf->Cell(30, 8, number_format($penjualan->sub_total, 2), 0, 1, 'R');
        $pdf->SetFillColor(0, 0, 139); 
        $pdf->SetTextColor(255, 255, 255);
        $pdf->Cell(140, 8, '', 0, 0, 'R');
        $pdf->Cell(30, 8, 'Sisa Tagihan', 0, 0, 'R', true);
        $pdf->Cell(20, 8, number_format($penjualan->remaining_balance, 2), 0, 1, 'R', true);
        $pdf->Ln(40);
        
        $pdf->SetTextColor(0, 0, 0);
        // Tanda tangan
        $pdf->Cell(150, 8, '', 0, 0, 'R');
        $pdf->Cell(0, 8, 'CV. JUAN MANGUN JAYA', 0, 1, 'R');
        $pdf->Cell(0, 8, 'Juanto Simangunsong', 0, 1, 'R');

        // Unduh file PDF
        $pdf->Output('D', 'penjualan_' . $penjualan->transaction_number . '.pdf');
    }

        
}
