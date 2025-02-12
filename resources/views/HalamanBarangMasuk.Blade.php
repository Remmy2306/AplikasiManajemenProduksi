@extends('template')

@section('content')
<div class="content">
    <form action="/cariBarangMasuk" method="GET" style="width: 500px">
        <div class="input-group no-border">
            <input type="text" name="search" class="form-control" placeholder="Cari data barang masuk...">
            <div class="input-group-append">
                <button type="submit" class="input-group-text">
                    <i class="nc-icon nc-zoom-split"></i>
                </button>
            </div>
        </div>  
    </form>

    <div class="table-responsive">
        <a href="/inputBarangMasuk" type="button" class="btn btn-success">Input Data</a>
        <table class="table table-dark table-striped">
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Tanggal Masuk</th>
                    <th>Nama Barang</th>
                    <th>Jumlah</th>
                    <th>Supplier</th>
                    <th>Action</th>
                </tr>
            </thead>
            @foreach ($barangMasuk as $x)
                <tbody>
                   <tr>
                        <td class="py-1">
                            {{$x->id_barang_masuk}}
                        </td>
                        <td>
                            {{$x->tanggal_masuk}}
                        </td>
                        <td>
                            {{$x->nama_barang}}
                        </td> 
                        <td>
                            {{$x->jumlah}}
                        </td> 
                        <td>              
                            {{$x->supplier}}
                        </td>
                        <td>
                            <a href="/editBarangMasuk/{{ $x->id_barang_masuk }}" type="button" class="btn btn-primary">Edit Data</a>
                            <a href="/hapusBarangMasuk/{{ $x->id_barang_masuk }}" type="button" class="btn btn-danger">Hapus Data</a>
                        </td>
                   </tr> 
                </tbody>
            @endforeach
        </table>
    </div>
</div>
@endsection
