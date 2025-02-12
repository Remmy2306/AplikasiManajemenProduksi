@extends('template')

@section('halaman')
    <h4 class="text-center">Input Barang Masuk</h4>
@endsection

@section('content')
    <form action="/simpanBarangMasuk" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label>ID Barang Masuk</label>
            <input
                style="width: 500px"
                type="text"
                class="form-control"
                name="id_barang_masuk"
                placeholder="ID Barang Masuk"
                required
            />
        </div>

        <div class="form-group">
            <label>Tanggal Masuk</label>
            <input
                style="width: 500px"
                type="date"
                class="form-control"
                name="tanggal_masuk"
                required
            />
        </div>

        <div class="form-group">
            <label>Nama Barang</label>
            <input
                style="width: 500px"
                type="text"
                class="form-control"
                name="nama_barang"
                placeholder="Nama Barang"
                required
            />
        </div>

        <div class="form-group">
            <label>Jumlah</label>
            <input
                style="width: 500px"
                type="number"
                class="form-control"
                name="jumlah"
                placeholder="Jumlah Barang"
                required
            />
        </div>

        <div class="form-group">
            <label>Supplier</label>
            <input
                style="width: 500px"
                type="text"
                class="form-control"
                name="supplier"
                placeholder="Nama Supplier"
                required
            />
        </div>

        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/barangMasuk" class="btn btn-dark">Kembali</a>
        </div>
    </form>
@endsection
