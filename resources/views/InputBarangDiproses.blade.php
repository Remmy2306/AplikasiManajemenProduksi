@extends('template')

@section('halaman')
    <h4 class="text-center">Input Laporan</h4>
@endsection

@section('content')
    <form action="/simpanLaporan" method="POST" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label>Id Laporan</label>
          <input
            style="width: 500px"
            type="text"
            class="form-control"
            name="id_penjualan"
            placeholder="Id laporan"
            required
          />
        </div>
        <div class="form-group" style="width: 500px">
          <label for="id_sales">Nama Sales</label>
          <select class="form-control" id="id_sales" name="id_sales" required>
            <option value="">Nama Sales</option>
            @foreach ($sales as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
          </select>
        </div>
        <div class="form-group" style="width: 500px">
          <label for="id_produk">Nama Produk</label>
          <select class="form-control" id="id_produk" name="id_produk" required>
              <option value="">Pilih Produk</option>
              @foreach ($produk as $p)
                  <option value="{{ $p->id_produk }}">{{ $p->nama_produk }}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group" style="width: 500px">
          <label for="id_pelanggan">Nama Pelanggan</label>
          <select class="form-control" id="id_pelanggan" name="id_pelanggan" required>
              <option value="">Pilih Pelanggan</option>
              @foreach ($pelanggan as $pl)
                  <option value="{{ $pl->id_pelanggan }}">{{ $pl->nama_pelanggan }}</option>
              @endforeach
          </select>
        </div>
        <div class="form-group">
            <label>Tanggal Penjualan</label>
            <input
              style="width: 500px"
              type="date"
              class="form-control"
              name="tanggal_penjualan"
              placeholder="Tanggal Penjualan"
              required
            />
        </div>
        <div class="form-group">
            <label>Jumlah Penjualan</label>
            <input
              style="width: 500px"
              type="text"
              class="form-control"
              name="jumlah_penjualan"
              placeholder="Jumlah Penjualan"
              required
            />
        </div>
        <div class="form-group">
            <label>Total Harga</label>
            <input
              style="width: 500px"
              type="text"
              class="form-control"
              name="total_harga"
              placeholder="Total Harga"
              required
            />
        </div>
        <div class="input-group">
          <label>Bukti Penjualan</label>
          <input 
            style="width: 500px"
            type="file" 
            class="form-control" 
            name="bukti_penjualan" 
            id="inputGroupFile04" 
            aria-describedby="inputGroupFileAddon04" 
            aria-label="Upload" 
            required
            />
        </div>
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="/dataLaporan"><button type="button" class="btn btn-dark">Kembali</button></a>
        </div>                  
    </form>
@endsection
