<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;

class AnggotaController extends Controller
{
    public function index()
    {
        $anggotas = Anggota::latest()->paginate(10);
        return view('anggota.index', compact('anggotas'));
    }

    public function create()
    {
        return view('anggota.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_anggota' => 'required|unique:anggotas|max:20',
            'nama'          => 'required|string|max:100',
            'alamat'        => 'required|string',
            'telepon'       => 'required|string|max:15',
        ]);

        Anggota::create([
            'user_id'       => auth()->id(),
            'nomor_anggota' => $request->nomor_anggota,
            'nama'          => $request->nama,
            'alamat'        => $request->alamat,
            'telepon'       => $request->telepon,
        ]);

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil ditambahkan.');
    }

    public function show(Anggota $anggota)
    {
        return view('anggota.show', compact('anggota'));
    }

    public function edit(Anggota $anggota)
    {
        return view('anggota.edit', compact('anggota'));
    }

    public function update(Request $request, Anggota $anggota)
    {
        $request->validate([
            'nomor_anggota' => 'required|max:20|unique:anggotas,nomor_anggota,' . $anggota->id,
            'nama'          => 'required|string|max:100',
            'alamat'        => 'required|string',
            'telepon'       => 'required|string|max:15',
        ]);

        $anggota->update($request->all());

        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil diperbarui.');
    }

    public function destroy(Anggota $anggota)
    {
        $anggota->delete();
        return redirect()->route('anggota.index')->with('success', 'Anggota berhasil dihapus.');
    }

    public function cetakPdf(Fpdf $pdf)
    {
        $anggotas = Anggota::all();

        $pdf->AddPage();
        $pdf->SetFont('Arial', 'B', 16);
        $pdf->Cell(0, 10, 'LAPORAN DATA ANGGOTA', 0, 1, 'C');

        $pdf->SetFont('Arial', '', 10);
        $pdf->Cell(0, 8, 'Tanggal Cetak: ' . date('d-m-Y H:i'), 0, 1, 'C');
        $pdf->Ln(3);

        // Header tabel
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->SetFillColor(220, 220, 220);
        $pdf->Cell(10, 10, 'No', 1, 0, 'C', true);
        $pdf->Cell(35, 10, 'No. Anggota', 1, 0, 'C', true);
        $pdf->Cell(50, 10, 'Nama', 1, 0, 'C', true);
        $pdf->Cell(60, 10, 'Alamat', 1, 0, 'C', true);
        $pdf->Cell(30, 10, 'Telepon', 1, 1, 'C', true);

        $pdf->SetFont('Arial', '', 10);
        $no = 1;
        foreach ($anggotas as $a) {
            $pdf->Cell(10, 8, $no++, 1, 0, 'C');
            $pdf->Cell(35, 8, $a->nomor_anggota, 1, 0, 'C');
            $pdf->Cell(50, 8, $a->nama, 1, 0, 'L');
            $pdf->Cell(60, 8, substr($a->alamat, 0, 35), 1, 0, 'L');
            $pdf->Cell(30, 8, $a->telepon, 1, 1, 'C');
        }

        $pdf->Ln(3);
        $pdf->SetFont('Arial', 'B', 10);
        $pdf->Cell(0, 8, 'Total Anggota: ' . $anggotas->count(), 0, 1, 'L');

        $pdf->Output('I', 'laporan_anggota.pdf');
        exit;
    }
}