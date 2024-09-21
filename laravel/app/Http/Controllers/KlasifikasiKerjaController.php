<?php

namespace App\Http\Controllers;

use App\Models\KlasifikasiKerja; // Pastikan model diimpor dengan benar
use Illuminate\Http\Request;

class KlasifikasiKerjaController extends Controller
{
    // Menampilkan halaman utama Klasifikasi Kerja
    public function index()
    {
        $title = "klasifikasi_kerja";
        $klasifikasiKerja = KlasifikasiKerja::all();

        return view('klasifikasi_kerja.index', [
            'klasifikasiKerja' => $klasifikasiKerja,
            'title' => $title,
        ]);
    }

    // Menampilkan form untuk membuat klasifikasi kerja baru
    public function create()
    {
        $title = "klasifikasi_kerja";
        return view('klasifikasi_kerja.create', [
            'title' => $title,
        ]);
    }

    // Menyimpan data klasifikasi kerja baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'status' => 'required|string|max:50',
        ]);

        // Simpan data ke database
        KlasifikasiKerja::create([
            'nama' => $request->nama,
            'status' => $request->status,
        ]);

        // Redirect ke halaman daftar klasifikasi kerja dengan pesan sukses
        return redirect()->route('klasifikasi_kerja')->with('success', 'Data berhasil disimpan');

    }

    // Menampilkan halaman edit
    public function edit($id)
    {
        $title = "klasifikasi_kerja";
        $klasifikasi = KlasifikasiKerja::findOrFail($id);

        return view('klasifikasi_kerja.edit', [
            'klasifikasi' => $klasifikasi,
            'title' => $title,
        ]);
    }

    // Memperbarui data yang sudah ada
    public function update(Request $request, $id)
{
    $klasifikasi = KlasifikasiKerja::findOrFail($id);
    $klasifikasi->nama = $request->nama;
    $klasifikasi->status = $request->status;
    $klasifikasi->save();

    // Redirect ke route 'klasifikasi_kerja' (tanpa '.index')
    return redirect()->route('klasifikasi_kerja')->with('success', 'Data berhasil diperbarui');
}


    // Menghapus data klasifikasi
    public function destroy($id)
{
    $klasifikasi = KlasifikasiKerja::findOrFail($id);
    $klasifikasi->delete();

    // Redirect ke route 'klasifikasi_kerja' setelah penghapusan berhasil
    return redirect()->route('klasifikasi_kerja')->with('success', 'Data berhasil dihapus');
}

}
