@extends('template')

@section('content')
<div class="content">
    <form action="/cariBarangKeluar" method="GET" style="width: 500px">
        <div class="input-group no-border">
            <input type="text" name="search" class="form-control" placeholder="Cari data barang keluar...">
            <div class="input-group-append">
                <button type="submit" class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                </button>
            </div>
        </div>  
    </form>

    <div class="table-responsive">
        <a href="/inputBarangKeluar" type="button" class="btn btn-success">Input Data</a>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Nama Barang</th>
                    <th>Jumlah Keluar</th>
                    <th>Tanggal Keluar</th>
                    <th>Penerima</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($barangKeluar as $x)
                <tbody>
                   <tr>
                        <td class="py-1">
                            {{$x->id_barang_keluar}}
                        </td>
                        <td>
                            {{$x->nama_barang}}
                        </td>
                        <td>
                            {{$x->jumlah_keluar}}
                        </td> 
                        <td>              
                            {{$x->tanggal_keluar}}
                        </td>
                        <td>
                            {{$x->tujuan}}
                        </td>
                        <td>
                            <a href="/ubahBarangKeluar/{{ $x->id_barang_keluar }}" type="button" class="btn btn-primary">Edit</a>
                            <a href="/hapusBarangKeluar/{{ $x->id_barang_keluar }}" type="button" class="btn btn-danger">Hapus</a>
                        </td>
                   </tr> 
                </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection
