<?php

namespace App\Http\Controllers;
use App\Models\laporan;
use App\Models\laporan2;
use App\Models\produk;
use App\Models\pelanggan;
use App\Models\pengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ViewController extends Controller
{
    // Memanggil database laporan
    public function tampil_dataLaporan()
    {
        $user = auth()->user();

        if ($user->role == 'admin') {
            $dataLaporan = DB::table('tb_penjualan')
                ->join('users', 'tb_penjualan.id_sales', '=', 'users.id')
                ->join('tb_produk', 'tb_penjualan.id_produk', '=', 'tb_produk.id_produk')
                ->join('tb_pelanggan', 'tb_penjualan.id_pelanggan', '=', 'tb_pelanggan.id_pelanggan')
                ->select('tb_penjualan.*', 'users.name as name', 'tb_produk.nama_produk', 'tb_pelanggan.nama_pelanggan')
                ->get();
        } else if ($user->role == 'sales') {
            $dataLaporan = DB::table('tb_penjualan')
                ->join('users', 'tb_penjualan.id_sales', '=', 'users.id')
                ->join('tb_produk', 'tb_penjualan.id_produk', '=', 'tb_produk.id_produk')
                ->join('tb_pelanggan', 'tb_penjualan.id_pelanggan', '=', 'tb_pelanggan.id_pelanggan')
                ->select('tb_penjualan.*', 'users.name as name', 'tb_produk.nama_produk', 'tb_pelanggan.nama_pelanggan')
                ->where('tb_penjualan.id_sales', $user->id)
                ->get();
        }

        return view('HalamanLaporan', compact('dataLaporan'));
    }



    // Ini untuk melakukan pencarian data laporan
    public function cari_laporan(Request $a)
{
    $user = auth()->user();
    $cari = $a->cari;

    if ($user->role == 'admin') {
        $dataLaporan = DB::table('tb_penjualan')
            ->join('users', 'tb_penjualan.id_sales', '=', 'users.id')
            ->join('tb_produk', 'tb_penjualan.id_produk', '=', 'tb_produk.id_produk')
            ->join('tb_pelanggan', 'tb_penjualan.id_pelanggan', '=', 'tb_pelanggan.id_pelanggan')
            ->select('tb_penjualan.*', 'users.name as name', 'tb_produk.nama_produk', 'tb_pelanggan.nama_pelanggan')
            ->where('users.name', 'like', '%' . $cari . '%')
            ->orWhere('tb_produk.nama_produk', 'like', '%' . $cari . '%')
            ->orWhere('tb_pelanggan.nama_pelanggan', 'like', '%' . $cari . '%')
            ->get();
    } else if ($user->role == 'sales') {
        $dataLaporan = DB::table('tb_penjualan')
            ->join('users', 'tb_penjualan.id_sales', '=', 'users.id')
            ->join('tb_produk', 'tb_penjualan.id_produk', '=', 'tb_produk.id_produk')
            ->join('tb_pelanggan', 'tb_penjualan.id_pelanggan', '=', 'tb_pelanggan.id_pelanggan')
            ->select('tb_penjualan.*', 'users.name as name', 'tb_produk.nama_produk', 'tb_pelanggan.nama_pelanggan')
            ->where('tb_penjualan.id_sales', $user->id)
            ->where(function($query) use ($cari) {
                $query->where('users.name', 'like', '%' . $cari . '%')
                      ->orWhere('tb_produk.nama_produk', 'like', '%' . $cari . '%')
                      ->orWhere('tb_pelanggan.nama_pelanggan', 'like', '%' . $cari . '%');
            })
            ->get();
    }
    return view('halamanLaporan', ['dataLaporan' => $dataLaporan]);
}


    // Ini untuk menambahkan data laporan kedalam database
    public function simpan_laporan(Request $request)
    {
        // Validasi input
    $request->validate([
        'id_penjualan' => 'required|string',
        'id_sales' => 'required|exists:users,id',
        'id_produk' => 'required|exists:tb_produk,id_produk',
        'id_pelanggan' => 'required|exists:tb_pelanggan,id_pelanggan',
        'tanggal_penjualan' => 'required|date',
        'jumlah_penjualan' => 'required|integer',
        'total_harga' => 'required|integer',
        'bukti_penjualan' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048',
    ]);

    // Proses upload file
    if ($request->hasFile('bukti_penjualan')) {
        $file = $request->file('bukti_penjualan');
        $nama_file = time() . "-" . $file->getClientOriginalName();
        $namaFolder = 'bukti_penjualan';
        $file->move($namaFolder, $nama_file);
        $pathPublic = $namaFolder . "/" . $nama_file;
    }

    // Simpan data ke database
    laporan::create([
        'id_penjualan' => $request->id_penjualan,
        'id_sales' => $request->id_sales,
        'id_produk' => $request->id_produk,
        'id_pelanggan' => $request->id_pelanggan,
        'tanggal_penjualan' => $request->tanggal_penjualan,
        'jumlah_penjualan' => $request->jumlah_penjualan,
        'total_harga' => $request->total_harga,
        'bukti_penjualan' => $pathPublic,
    ]);

    return redirect('/dataLaporan')->with('success', 'Laporan berhasil disimpan');
    }
    

    // Ini untuk menampilkan halaman input laporan 
    public function tampil_inputLaporan()
    {
        $sales = DB::table('users')->get();
        $produk = DB::table('tb_produk')->get();
        $pelanggan = DB::table('tb_pelanggan')->get();
        return view('InputLaporan', compact('produk', 'pelanggan','sales'));
    }

    public function delete_laporan($id_penjualan)
    {
        $dataLaporan = laporan::find($id_penjualan);
        $dataLaporan->delete();
        return redirect('/dataLaporan');
    }

    //Ini proses mencari id laporan dan menampilkan halaman edit laporan 
    public function edit_laporan($id_penjualan)
    {
        $dataLaporan = laporan::find($id_penjualan);
        $sales = DB::table('tb_user')->get();
        $produk = DB::table('tb_produk')->get();
        $pelanggan = DB::table('tb_pelanggan')->get();
        return view('EditLaporan', ['dataLaporan' => $dataLaporan ,'sales' => $sales, 'produk' => $produk, 'pelanggan' => $pelanggan]);    
    }

    //Ini proses update data laporan
    public function update_laporan($id_penjualan, Request $a)
    {
        $file = $a->file('bukti_penjualan');
        $nama_file = time() . "-" . $file->getClientOriginalName();
        $ekstensi = $file->getClientOriginalExtension();
        $ukuran = $file->getSize();
        $pathAsli = $file->getRealPath();
        $namaFolder = 'bukti_penjualan';
        $file->move($namaFolder, $nama_file);
        $pathPublic = $namaFolder . "/" . $nama_file;

        laporan::where("id_penjualan", "$id_penjualan") -> update
        ([
            'id_penjualan' => $a -> id_penjualan,
            'id_sales' => $a -> id_sales,
            'id_produk' => $a -> id_produk,
            'id_pelanggan' => $a -> id_pelanggan,
            'tanggal_penjualan' => $a -> tanggal_penjualan,
            'jumlah_penjualan' => $a -> jumlah_penjualan,
            'total_harga' => $a -> total_harga,
            'bukti_penjualan' => $pathPublic,
        ]);
        return redirect('/dataLaporan');
    }
    





    // Memanggil database pelanggan dan menampilkannya kedalam view HalamanPelanggan
    public function tampil_dataPelanggan()        
    {
        $a = pelanggan::all();
        return view ('HalamanPelanggan',['dataPelanggan' => $a]);
    }

    // Ini untuk memanggil view input data pelanggan
    public function tampil_inputPelanggan()
    {
        return view ('InputPelanggan');
    }

    // Ini untuk menampilkan halaman yang telah di input pelanggan baru
    public function simpan_pelanggan(Request $request)
    {
        $request->validate([
            'id_pelanggan' => 'required',
            'nama_pelanggan' => 'required',
            'NoHp_pelanggan' => 'required',
            'alamat' => 'required',
        ]);

        DB::table('tb_pelanggan')->insert([
            'id_pelanggan' => $request->input('id_pelanggan'),
            'nama_pelanggan' => $request->input('nama_pelanggan'),
            'NoHp_pelanggan' => $request->input('NoHp_pelanggan'),
            'alamat' => $request->input('alamat'),
        ]);

        return redirect('/dataPelanggan')->with('success', 'data pelanggan berhasil disimpan');
    }
    // Ini untuk edit data pelanggan
    public function edit_pelanggan($id_pelanggan)
    {
        $dataPelanggan = pelanggan::find($id_pelanggan);
        return view('EditPelanggan', ['dataPelanggan' => $dataPelanggan]);
    }

    //Ini proses update data produk
    public function update_pelanggan($id_pelanggan, Request $a)
    {
        pelanggan::where("id_pelanggan", "$id_pelanggan") -> update
        ([
            'id_pelanggan' => $a -> id_pelanggan,
            'nama_pelanggan' => $a -> nama_pelanggan,
            'NoHp_pelanggan' => $a -> NoHp_pelanggan,
            'alamat' => $a -> alamat,
        ]);
        return redirect('/dataPelanggan');
    }    

    // Ini adalah function untuk menghapus data pelanggan
    public function delete_pelanggan($id_pelanggan)
    {
        $dataPelanggan = pelanggan::find($id_pelanggan);
        $dataPelanggan->delete();
        return redirect('/dataPelanggan');
    }



    // Ini untuk menampilkan daftar produk
    public function tampil_halamanProduk()        
    {
        $a = produk::all();
        return view ('HalamanProduk',['dataProduk' => $a]);
    }

    // Ini untuk menampilkan halaman input produk
    public function tampil_inputProduk()
    {
        return view ('InputProduk');
    }

    // Ini untuk menambahkan data produk kedalam database
    public function simpan_produk(Request $a)
    {
        $a->validate([
            "id_produk" => 'required|string|max:20',
            'nama_produk' => 'required|string|max:255',
            'harga' => 'required|integer',
            'foto_barang' => 'required|file|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $file = $a->file('foto_barang');
        $nama_file = time() . "-" . $file->getClientOriginalName();
        $ekstensi = $file->getClientOriginalExtension();
        $ukuran = $file->getSize();
        $pathAsli = $file->getRealPath();
        $namaFolder = 'foto_barang';
        $file->move($namaFolder, $nama_file);
        $pathPublic = $namaFolder . "/" . $nama_file;

        DB::table('tb_produk')->insert([
            'id_produk' => $a -> id_produk,
            'nama_produk' => $a -> nama_produk,
            'harga' => $a -> harga,
            'foto_barang' => $pathPublic,
        ]);
        return redirect('/dataProduk')->with('success', 'Laporan berhasil disimpan');
    }

    // Ini untuk edit data produk
    public function edit_produk($id_produk)
    {
        $dataProduk = produk::find($id_produk);
        return view('EditProduk', ['dataProduk' => $dataProduk]);
    }

    //Ini proses update data produk
    public function update_produk($id_produk, Request $a)
    {

        $file = $a->file('foto_barang');
        $nama_file = time() . "-" . $file->getClientOriginalName();
        $ekstensi = $file->getClientOriginalExtension();
        $ukuran = $file->getSize();
        $pathAsli = $file->getRealPath();
        $namaFolder = 'foto_barang';
        $file->move($namaFolder, $nama_file);
        $pathPublic = $namaFolder . "/" . $nama_file;

        produk::where("id_produk", "$id_produk") -> update
        ([
            'id_produk' => $a -> id_produk,
            'nama_produk' => $a -> nama_produk,
            'harga' => $a -> harga,
            'foto_barang' => $pathPublic,
        ]);
        return redirect('/dataProduk');
    }

    // Ini adalah function untuk menghapus data produk
    public function delete_produk($id_produk)
    {
        $dataProduk = produk::find($id_produk);
        $dataProduk->delete();
        return redirect('/dataProduk');
    }
}
