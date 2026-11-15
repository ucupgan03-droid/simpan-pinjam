<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class TransaksiController extends Controller
{
    public function index()
    {
        $transaksis = Transaksi::with('anggota')->latest()->paginate(10);
        return view('transaksi.index', compact('transaksis'));
    }

    public function create()
    {
        $anggotas = Anggota::all();
        return view('transaksi.create', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis'      => 'required|in:simpanan,pinjaman',
            'jumlah'     => 'required|numeric|min:1000',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        Transaksi::create($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil ditambahkan.');
    }

    public function edit(Transaksi $transaksi)
    {
        $anggotas = Anggota::all();
        return view('transaksi.edit', compact('transaksi', 'anggotas'));
    }

    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'anggota_id' => 'required|exists:anggotas,id',
            'jenis'      => 'required|in:simpanan,pinjaman',
            'jumlah'     => 'required|numeric|min:1000',
            'tanggal'    => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $transaksi->update($request->all());

        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil diperbarui.');
    }

    public function destroy(Transaksi $transaksi)
    {
        $transaksi->delete();
        return redirect()->route('transaksi.index')->with('success', 'Transaksi berhasil dihapus.');
    }

    public function cetakPdf(Fpdf $pdf)
    {
        $transaksis = Transaksi::with('anggota')->get();

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'LAPORAN TRANSAKSI SIMPAN PINJAM', 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, 'Tanggal Cetak: ' . date('d-m-Y H:i'), 0, 1, 'C');
        $pdf->Ln(3);

        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(220, 220, 220);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Tanggal', 1, 0, 'C', true);
        $pdf->Cell(50, 10, 'Nama Anggota', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Jenis', 1, 0, 'C', true);
        $pdf->Cell(40, 10, 'Jumlah (Rp)', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Keterangan', 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 10);
        $no = 1;
        $totalSimpanan = 0;
        $totalPinjaman = 0;
        foreach ($transaksis as $t) {
            $pdf->Cell(10, 8, $no++, 1, 0, 'C');
            $pdf->Cell(30, 8, date('d-m-Y', strtotime($t->tanggal)), 1, 0, 'C');
            $pdf->Cell(50, 8, $t->anggota->nama ?? '-', 1, 0, 'L');
            $pdf->Cell(30, 8, ucfirst($t->jenis), 1, 0, 'C');
            $pdf->Cell(40, 8, number_format($t->jumlah, 0, ',', '.'), 1, 0, 'R');
            $pdf->Cell(30, 8, substr($t->keterangan ?? '-', 0, 15), 1, 1, 'L');

            if ($t->jenis === 'simpanan') $totalSimpanan += $t->jumlah;
            else $totalPinjaman += $t->jumlah;
        }

        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 8, 'Total Transaksi: ' . $transaksis->count(), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Total Simpanan: Rp ' . number_format($totalSimpanan, 0, ',', '.'), 0, 1, 'L');
        $pdf->Cell(0, 8, 'Total Pinjaman: Rp ' . number_format($totalPinjaman, 0, ',', '.'), 0, 1, 'L');

        $pdf->Output('I', 'laporan_transaksi.pdf');
        exit;
    }
}