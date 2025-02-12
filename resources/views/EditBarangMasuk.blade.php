@extends('template')

@section('halaman')
    <h4 class="text-center">Edit Barang Masuk</h4>
@endsection

@section('content')
    <form action="/updateBarangMasuk/{{ $barangMasuk->id_barang_masuk }}" method="POST">
        {{ csrf_field() }}

        <div class="form-group">
            <label for="tanggal_masuk">Tanggal Masuk</label>
            <input
                type="date"
                class="form-control"
                name="tanggal_masuk"
                value="{{ old('tanggal_masuk', $barangMasuk->tanggal_masuk) }}"
                required
            />
        </div>

        <div class="form-group">
            <label>Nama Barang</label>
            <input
                type="text"
                class="form-control"
                name="nama_barang"
                value="{{ old('nama_barang', $barangMasuk->nama_barang) }}"
                required
            />
        </div>

        <div class="form-group">
            <label>Jumlah</label>
            <input
                type="number"
                class="form-control"
                name="jumlah"
                value="{{ old('jumlah', $barangMasuk->jumlah) }}"
                required
            />
        </div>

        <div class="form-group">
            <label>Supplier</label>
            <input
                type="text"
                class="form-control"
                name="supplier"
                value="{{ old('supplier', $barangMasuk->supplier) }}"
                required
            />
        </div>

        <div class="mt-4">
            <button class="btn btn-info" type="submit">Simpan</button>
            <a href="/barangMasuk" class="btn btn-light">Kembali</a>
        </div>
    </form>
@endsection
