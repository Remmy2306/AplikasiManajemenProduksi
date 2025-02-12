<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\barangmasuk;
use App\Models\barangdiproses;
use App\Models\barangkeluar;

class ControllerDTY extends Controller
{
    // ✅ Menampilkan daftar barang masuk
    public function tampil_barang_masuk()
    {
        $barangMasuk = barangmasuk::all();
        return view('HalamanBarangMasuk', compact('barangMasuk'));
    }

    // ✅ Menampilkan daftar barang diproses
    public function tampil_barang_diproses()
    {
        $barangDiproses = DB::table('tb_barang_diproses')
            ->join('tb_barang_masuk', 'tb_barang_diproses.id_barang_masuk', '=', 'tb_barang_masuk.id_barang_masuk')
            ->select('tb_barang_diproses.*', 'tb_barang_masuk.nama_barang')
            ->get();
        return view('HalamanBarangDiproses', compact('barangDiproses'));
    }

    // ✅ Menampilkan daftar barang keluar
    public function tampil_barang_keluar()
    {
        $barangKeluar = DB::table('tb_barang_keluar')
            ->join('tb_barang_diproses', 'tb_barang_keluar.id_proses', '=', 'tb_barang_diproses.id_proses')
            ->join('tb_barang_masuk', 'tb_barang_diproses.id_barang_masuk', '=', 'tb_barang_masuk.id_barang_masuk')
            ->select('tb_barang_keluar.*', 'tb_barang_masuk.nama_barang')
            ->get();
        return view('HalamanBarangKeluar', compact('barangKeluar'));
    }

    // ✅ Menampilkan form input barang masuk
    public function form_barang_masuk()
    {
        return view('InputBarangMasuk');
    }

    // ✅ Menyimpan barang masuk
    public function simpan_barang_masuk(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'id_barang_masuk' => 'required',
            'tanggal_masuk' => 'required|date',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer|min:1',
            'supplier' => 'required|string|max:255',
        ]);

        // Simpan data ke database menggunakan Query Builder
        DB::table('tb_barang_masuk')->insert([
            'id_barang_masuk' => $request->input('id_barang_masuk'),
            'tanggal_masuk' => $request->input('tanggal_masuk'),
            'nama_barang' => $request->input('nama_barang'),
            'jumlah' => $request->input('jumlah'),
            'supplier' => $request->input('supplier'),
        ]);

        // Redirect kembali ke halaman barang masuk dengan pesan sukses
        return redirect('/barangMasuk')->with('success', 'Data barang masuk berhasil disimpan!');
    }



    // ✅ Menampilkan form edit barang masuk
    public function edit_barang_masuk($id_barang_masuk)
    {
        $dataBarang = barangmasuk::find($id_barang_masuk);
        return view('editBarangMasuk', ['barangMasuk' => $dataBarang]);
    }

    // ✅ Update barang masuk
    public function update_barang_masuk(Request $request, $id)
    {
        $request->validate([
            'tanggal_masuk' => 'required|date',
            'nama_barang' => 'required|string|max:255',
            'jumlah' => 'required|integer',
            'supplier' => 'required|string|max:255',
        ]);

        // Update data di database
        DB::table('tb_barang_masuk')
            ->where('id_barang_masuk', $id)
            ->update([
                'tanggal_masuk' => $request->input('tanggal_masuk'),
                'nama_barang' => $request->input('nama_barang'),
                'jumlah' => $request->input('jumlah'),
                'supplier' => $request->input('supplier'),
            ]);

        return redirect('/barangMasuk')->with('success', 'Data berhasil diperbarui!');
    }


    // ✅ Hapus barang masuk
    public function delete_barang_masuk($id)
    {
        barangmasuk::destroy($id);
        return redirect('/barangMasuk')->with('success', 'Barang masuk berhasil dihapus!');
    }

    // ✅ Menampilkan form input barang diproses
    public function form_barang_diproses()
    {
        $barangMasuk = barangmasuk::all();
        return view('InputBarangDiproses', compact('barangMasuk'));
    }

    // ✅ Menyimpan barang diproses
    public function simpan_barang_diproses(Request $request)
    {
        barangdiproses::create([
            'id_barang_masuk' => $request->id_barang_masuk,
            'jumlah_diproses' => $request->jumlah_diproses,
        ]);

        return redirect('/barangDiproses')->with('success', 'Barang diproses berhasil disimpan!');
    }

    // ✅ Menampilkan form edit barang diproses
    public function edit_barang_diproses($id)
    {
        $barangDiproses = barangdiproses::findOrFail($id);
        $barangMasuk = barangmasuk::all();
        return view('EditBarangDiproses', compact('barangDiproses', 'barangMasuk'));
    }

    // ✅ Update barang diproses
    public function update_barang_diproses(Request $request, $id)
    {
        $barangDiproses = barangdiproses::findOrFail($id);
        $barangDiproses->update([
            'id_barang_masuk' => $request->id_barang_masuk,
            'jumlah_diproses' => $request->jumlah_diproses,
        ]);

        return redirect('/barangDiproses')->with('success', 'Barang diproses berhasil diperbarui!');
    }

    // ✅ Hapus barang diproses
    public function delete_barang_diproses($id)
    {
        barangdiproses::destroy($id);
        return redirect('/barangDiproses')->with('success', 'Barang diproses berhasil dihapus!');
    }

    // ✅ Menampilkan form input barang keluar
    public function form_barang_keluar()
    {
        $barangDiproses = barangdiproses::all();
        return view('InputBarangKeluar', compact('barangDiproses'));
    }

    // ✅ Menyimpan barang keluar
    public function simpan_barang_keluar(Request $request)
    {
        barangkeluar::create([
            'id_proses' => $request->id_proses,
            'jumlah_keluar' => $request->jumlah_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
        ]);

        return redirect('/barangKeluar')->with('success', 'Barang keluar berhasil disimpan!');
    }

    // ✅ Menampilkan form edit barang keluar
    public function edit_barang_keluar($id)
    {
        $barangKeluar = barangkeluar::findOrFail($id);
        $barangDiproses = barangdiproses::all();
        return view('EditBarangKeluar', compact('barangKeluar', 'barangDiproses'));
    }

    // ✅ Update barang keluar
    public function update_barang_keluar(Request $request, $id)
    {
        $barangKeluar = barangkeluar::findOrFail($id);
        $barangKeluar->update([
            'id_proses' => $request->id_proses,
            'jumlah_keluar' => $request->jumlah_keluar,
            'tanggal_keluar' => $request->tanggal_keluar,
        ]);

        return redirect('/barangKeluar')->with('success', 'Barang keluar berhasil diperbarui!');
    }

    // ✅ Hapus barang keluar
    public function delete_barang_keluar($id)
    {
        barangkeluar::destroy($id);
        return redirect('/barangKeluar')->with('success', 'Barang keluar berhasil dihapus!');
    }
}
