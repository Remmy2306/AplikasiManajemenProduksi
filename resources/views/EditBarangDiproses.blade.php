@extends('template')

@section('halaman')
    <h4 class="text-center">Input Laporan</h4>
@endsection
@section('subhalaman')
@endsection

@section('content')
    <form action="/updateLaporan/{{ $dataLaporan->id_penjualan }}" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="id_produk">Nama Produk</label>
            <select class="form-control" id="id_sales" name="id_sales" required value="{{ $dataLaporan -> id_sales }}>
                <option value="">Pilih Produk</option>
                @foreach ($sales as $p)
                    <option value="{{ $p->id_user }}">{{ $p->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_produk">Nama Produk</label>
            <select class="form-control" id="id_produk" name="id_produk" required value="{{ $dataLaporan -> id_produk }}>
                <option value="">Pilih Produk</option>
                @foreach ($produk as $p)
                    <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="id_pelanggan">Nama Pelanggan</label>
            <select class="form-control" id="id_pelanggan" name="id_pelanggan" required value="{{ $dataLaporan->id_pelanggan }}>
                <option value="">Pilih Pelanggan</option>
                @foreach ($pelanggan as $pl)
                    <option value="{{ $pl->id_pelanggan }}">{{ $pl->nama_pelanggan }}</option>
                @endforeach
            </select>
        </div>
          <div class="form-group">
              <label>Tanggal Penjualan</label>
              <input
                type="date"
                class="form-control"
                name="tanggal_penjualan"
                value="{{ $dataLaporan -> tanggal_penjualan }}"
              />
          </div>
          <div class="form-group">
              <label>Jumlah Penjualan</label>
              <input
                type="text"
                class="form-control"
                name="jumlah_penjualan"
                value="{{ $dataLaporan -> jumlah_penjualan }}"
              />
          </div>
          <div class="form-group">
              <label>Total Harga</label>
              <input
                type="text"
                class="form-control"
                name="total_harga"
                value="{{ $dataLaporan -> total_harga }}"
              />
          </div>
          <div class="input-group">
            <label>Bukti Penjualan</label>
            <input 
              type="file" 
              class="form-control" 
              name="bukti_penjualan" 
              id="inputGroupFile04" 
              aria-describedby="inputGroupFileAddon04" 
              aria-label="Upload" 
              />
          </div>
      <div class="mt-4">
          <button class="btn btn-info" type="submit" value="SimpanLaporan">Simpan</button>
          <a href="/dataLaporan"><button class="btn btn-light">Kembali</button></a>         
        </div>
    </form>
@endsection